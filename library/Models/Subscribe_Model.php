<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/6/16
 * Time: 11:05 PM
 */

namespace library\Models;
use library\Models\Model;
use core\Config;
use Exception;


class Subscribe_Model extends Model
{
    public $fields,
        $_db,
        $_tableName = 'su6scri63';
    public static $handler;
    public static $entries = null;

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

    public function create($fields = array()){

        if(!$this->_db->insert($this->_tableName, $fields)){
            throw new Exception('There was a problem creating a new account.');
        }
    }

}