<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 2/26/17
 * Time: 6:45 PM
 */

namespace library\Theme;
use Library\Models\Model;

class Sitetheme
{

    public $username,
        $curruserInfo,
        $validate,
        $userId,
        $fields,
        $siteStyles,
        $getSiteStyleInfo,
        $_tableName = 'syst3mTh3m3';

    private $_db,
        $_data;

    public function __construct()
    {

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
     * @param null $getSiteStyleInfo
     * @return bool
     *
     * Find user data in table
     *
     */
    public function find($getSiteStyleInfo = null){  // search for user provided info
        if($getSiteStyleInfo){ // if userInfo not equal to null, proceed

            // set field var to get either table id via potential customer account number or email values
            $field = (is_numeric($getSiteStyleInfo)) ? 'id' : '';

            $data = $this->_db->get($this->_tableName, array($field,'=',$getSiteStyleInfo));

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
     * return all of this user's data in table as an array
     */
    public function data(){
        return $this->_data;
    }






}