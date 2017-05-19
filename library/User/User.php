<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 2/12/17
 * Time: 10:25 PM
 */

namespace library\User;
use library\Models\Model;
use library\Sessions\Sessions;
use library\Controller\Hash;
use core\Config;
use Exception;
use library\Cookies\Cookies;


class User
{

    private $_db,
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn;

    public  $fields,
        $_tableName = 'r3gM3mb3rs';

    public function __construct($user = null)
    {
        // connect to db
        $this->_db = Model::getInstance();

        $this->_sessionName = Config::getLoggedInUserSessionName();
        $this->_cookieName = Config::COOKIE_HASH_NAME;

        if(!$user){
            if(Sessions::exists($this->_sessionName)){
                $user = Sessions::get($this->_sessionName);

                // get user data
                if($this->find($user)){
                    $this->_isLoggedIn = true;
                }else{
                    // process and redirect to logout
                    echo "User info not found!";
                }
            }else{
                $this->find($user);
            }
        }
    }

    public function update($tableName, $fields = array(), $id =  null)
    {
        if(!$id && $this->isLoggedIn()){
            $id = $this->data()->id;
        }

        if(!$this->_db->update($tableName, $id, $fields)){
            throw new Exception('There was a problem updating your account.');
        }
    }


    /**
     * @param array $fields
     * @throws Exception
     * create user account
     */
    public function create($fields = array()){
        if(!$this->_db->insert($this->_tableName, $fields)){
            throw new Exception('There was a problem creating a new account.');
        }
    }


    /**
     * @param null $userInfo
     * @return bool
     *
     * Find user data in table
     *
     */
    public function find($userInfo = null){  // search for user provided info

        if($userInfo){ // if userInfo not equal to null, proceed

            // set field var to get either table id via potential customer account number or email values
            $field = (is_numeric($userInfo)) ? 'id' : 'regMem_E1';

            // select user info from table where field equals $userInfo value using Model's get($table, $where)
            $data = $this->_db->get($this->_tableName, array($field,'=',$userInfo));

            // data is equivalent to rows, count() = 0 on Model class
            if($data->count()){

                // take first and only result found in table
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    /**
     * @param null $userEmail
     * @param null $userPassword
     * @return bool
     * log user in
     */
    public function login($userEmail = null, $userPassword = null, $remember = false){

        if(!$userEmail && !$userPassword && $this->exists()){
            Sessions::put($this->_sessionName, $this->data()->id );
        }else {

            $userInfo = $this->find($userEmail);

            if ($userInfo) {

                if ($this->data()->regMem_Pw === Hash::make($userPassword, $this->data()->regMem_Salt)) {

                    Sessions::put($this->_sessionName, $this->data()->id);

                    // if user has clicked Remember Me
                    if ($remember) {
                        $hash = Hash::unique();

                        // check inside db for user id exists in table
                        $hashCheck = $this->_db->get('us3rz_S3ssIoN', array('user_id', '=', $this->data()->id));

                        // if hash doesn't exist, insert hash into table
                        if (!$hashCheck->count()) {
                            $this->_db->insert('us3rz_S3ssIoN', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash
                            ));
                        } else {
                            // if hash exist then we set the hash to existing hash
                            $hash = $hashCheck->first()->hash;
                        }

                        Cookies::put($this->_cookieName, $hash, Config::COOKIE_EXPIRY);
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function isActiveMember()
    {

    }

    public function hasPermission($key)
    {
        // get register member group value from permission table where logged in reg member group is a match
        $group = $this->_db->get('grOup_P3rmi55iOnsz', array('id', '=', $this->data()->regMem_Group));

        if($group->count()){

            // use json_decode to return key value pair
            $permissions = json_decode($group->first()->permissions, true);

            //check if permission key value was found based on register member group value
            if($permissions[$key] == true){
                return true;
            }
        }
        return false;
    }

    public function exists()
    {
        return(!empty($this->_data)) ? true : false;
    }

    public function logout(){

        $this->_db->delete('us3rz_S3ssIoN', array('user_id', '=', $this->data()->id ));
        Sessions::delete($this->_sessionName);
        Cookies::delete($this->_cookieName);
    }


    /**
     * @return mixed
     * return all of this user's data in table as an array
     */
    public function data(){
        return $this->_data;
    }

    /**
     * @return bool
     * return data, if user is logged in return _isLoggedIn value of true
     */
    public function isLoggedIn(){
        return $this->_isLoggedIn; // if true
    }

    public function lastId()
    {
        $getLastId = $this->_db->last();
        return $getLastId;
    }

}