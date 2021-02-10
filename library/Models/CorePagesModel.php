<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 4/23/17
 * Time: 6:04 AM
 */

namespace library\Models;
use library\User\User;
use Exception;
use library\Sessions\Sessions;


class CorePagesModel extends Model
{

    public $fields,
        $_pdo,
        $edit_page_content,
        $_tableName = 'cor3Pag3s';

    public static $handler,
        $entries = null,
        $corePagesName;

    private $_db,
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn;

    /**
     * connect to db and table
     *
     */
    public function __construct()
    {
        //parent::__construct(); // connect to db via parent class

        // connect to db
        $this->_db = Model::getInstance();
    }

    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before(){}

    /**
     * After filter which could potentially be good for destroying sessions
     *
     * @return void
     */
    protected function after(){}


    public static function corePagesName()
    {
        self::$corePagesName = array(
            '1115' => 'ABOUT',
            '1126' => 'BLOG',
            '1118' => 'CONTACT',
            '1123' => 'FIND US',
            '1133' => 'FORGOT PASSWORD',
            '1119' => 'LOGIN',
            '1121' => 'PRIVACY',
            '1117' => 'PRODUCTS',
            '1120' => 'REGISTER',
            '1116' => 'SERVICES',
            '1135' => 'SUBSCRIBE',
            '1122' => 'TERMS',
            '1127' => 'VLOG',
            '1134' => 'RADIO'
        );
        return self::$corePagesName;
    }

    /**
     * @param null $pageInfoNumber
     * @return bool
     *
     * Find user data in table
     *
     */
    public function find($pageInfoNumber = null): bool
    {  // search for user provided info
        if($pageInfoNumber){ // if userInfo not equal to null, proceed

            // set field var to get either table id via potential member number
            $field = (is_numeric($pageInfoNumber)) ? 'id' : '';

            $data = $this->_db->get($this->_tableName, array($field,'=', $pageInfoNumber));

            // data is equivalent to rows, count() = 0 on Model class
            if($data->count()){
                // take first and only result found in table
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }


    public function update($_tableName, $fields = array(), $id = null)
    {
        // the following block updates where the $id is the logged in user's id in a table
        if(!$id && $this->isLoggedIn()){
            $id = $this->data()->id;
        }

        // if you specify the id as the third parameter in the update function,
        // then the update function will use that specified id as the column id to be updated
        if(!$this->_db->update($_tableName, $id, $fields)){
            throw new Exception('There was a problem updating this page.');
        }
    }

    /**
     * @return mixed
     * return all of this page data in table as string
     */
    public function data(){
        return $this->_data;
    }

    /**
     * @return mixed
     */
    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }


}