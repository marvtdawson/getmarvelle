<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 4/23/17
 * Time: 7:12 AM
 */

namespace library\Models;


class SiteKeyWordsModel extends Model
{
    public $fields,
        $_pdo,
        $_data,
        $pageType,
        $_tableName = 'k3yW0rdz';

    private $_db;


    /**
     * connect to db and table
     *
     */
    public function __construct(){

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
    

    /**
     * @param null $keywordType
     * @return bool
     *
     * Find user data in table
     *
     */
    public function find($keywordType = null){  // search for user provided info

        if($keywordType){ // if userInfo not equal to null, proceed

            // set field var to get either table id via potential customer account number or email values
            $field = ($keywordType) ? 'keywords_Type' : '';

            // select user info from table where field equals $keywordType value using Model's get($table, $where)
            $data = $this->_db->get($this->_tableName, array($field,'=',$keywordType));

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
    
    

    public function retrieveKeyWords($pageType){

       //$this->pageType = $this->find($pageType);

        $this->pageType = "This is a keyword test from inside of the SiteKeyWordsModel class";

        // get keywords via page type from table

        return $this->pageType;

    }
}