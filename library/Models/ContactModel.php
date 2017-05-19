<?php
/**
 * Created by PhpStorm.
 * User: Marvin Dawson
 * Date: 9/8/16
 * Time: 12:18 AM
 */

namespace library\Models;
use core\Config;
use Exception;

class ContactModel extends Model
{
    public $fields,
       $_db,
       $_data,
       $_pdo,
       $contact_entries,
       $_tableName = 'conTactForm';

    public static $handler,
        $entries = null;

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
     * @param null $pageInfoNumber
     * @return bool
     *
     * Find user data in table
     *
     */
    public function find($contact_entries = null){  // search for user provided info
        if($contact_entries){ // if userInfo not equal to null, proceed

            // set field var to get either table id via potential member number
            $field = (is_numeric($contact_entries)) ? 'id' : '';

            $data = $this->_db->get($this->_tableName, array($field,'=', $contact_entries));

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
     * @return mixed
     * return all of this page data in table as string
     */
    public function data(){
        return $this->_data;
    }

    public function checkTableInfo(){

        // get const name from config file
        $checkConfigTableName = Config::CONTACT_FORM_TABLE_NAME;

        // get table name from db
        $checkDbTableName = Model::checkTableName(self::$_tableName);

        // check if table name is empty
        if ($checkDbTableName == ''){

            // add call to jquery dialog error message box here and remove echo
            echo 'Table Name Not Found';

        } // check if config table name is equal to database name before continue
        else if($checkDbTableName != $checkConfigTableName) {

            // add call to jquery dialog error message box here and remove echo
            echo 'Table Name Does Match';
        }

    }

    /**
     *
     */
    public function create($fields = array()){

        if(!$this->_db->insert($this->_tableName, $fields)){
            throw new Exception('There was a problem creating a new account.');
        }
    }

    public function last()
    {
        $getLastIdInserted = $this->_pdo->lastInsertId();
        return $getLastIdInserted;
    }

    public function lastId()
    {
        $getLastId = $this->_db->last();
        return $getLastId;
    }


    /**
     * run query to get all contact requests from table
     */
    public function retrieveAllEntries()
    {
        $entry = Model::getInstance()->query('SELECT * FROM conTactForm');

        if(!$entry->count()) {
            echo 'No user with that Name found.';
        }else {
            foreach ($entry->results() as $entry) {
                echo $entry->contact_Message, '<br>';
            }
        }
    }

    /**
     * get last saved entry
     */
    /*public static function retrieveLastEntry()
    {
        //$sql = $this->handler->query('SELECT * FROM $this->_tableName');

    }*/

    /**
     * get first saved entry by email
     */
    public static function retrieveFirstEntry()
    {
        $entry = Model::getInstance()->get('conTactForm', array('id', '=', '1'));

        if(!$entry->count()) {
            echo 'No entry found.';
        }else {
                echo $entry->first()->id, '<br>';
        }
    }

    /**
     * get entry by state
     */
    public static function retrieveEntryByState($state)
    {
        $entry = Model::getInstance()->get('conTactForm', array('contact_State', '=', $state));

        if(!$entry->count()) {
            echo 'No contacts found in that state.';
        }else {
            foreach ($entry->results() as $entry) {
                echo $entry->contact_State, '<br>';
            }
        }
    }

}