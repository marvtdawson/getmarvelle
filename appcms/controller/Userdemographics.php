<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/25/17
 * Time: 11:01 PM
 */

namespace appcms\controller;
use library\Models\Model;
use Exception;

class Userdemographics
{
    private $_db,
    $_data,
    $_sessionName,
    $_cookieName,
    $_isLoggedIn;

    public  $fields,
            $_tableName = 'regMemDemographics';

    public function __construct($user = null)
    {
        // connect to db
        $this->_db = Model::getInstance();

    }

    /**
     * @param null $userDemoInfo
     * @return bool
     *
     * Find user data in table
     *
     */
    public function find($userDemoInfo = null){  // search for user provided info with user id
        if($userDemoInfo){ // if userInfo not equal to null, proceed

            // set field var to get either table id via potential member number
            $field = (is_numeric($userDemoInfo)) ? 'id' : '';


            $data = $this->_db->get($this->_tableName, array($field,'=', $userDemoInfo));

            // data is equivalent to rows, count() = 0 on Model class
            if($data->count()){

                // take first and only result found in table
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
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
     * @return mixed
     * return all of this user's data in table as an array
     */
    public function data(){
        return $this->_data;
    }

        public function isLoggedIn(){
        return $this->_isLoggedIn;
    }

}