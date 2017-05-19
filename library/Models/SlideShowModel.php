<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 5/10/17
 * Time: 7:32 PM
 */

namespace library\Models;


class SlideShowModel extends Model
{
    public $fields,
        $_pdo,
        $slider_images,
        $_tableName = 'syst3mSlid3sz';

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

}