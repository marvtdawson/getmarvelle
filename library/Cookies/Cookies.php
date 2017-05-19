<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/15/16
 * Time: 12:00 AM
 */

namespace library\Cookies;


use core\Controller;

class Cookies extends Controller
{
    public function __construct()
    {

    }

    /**
     * @param $name
     * @return bool
     * check if cookie exist
     */
    public static function exists($name)
    {
        return(isset($_COOKIE[$name])) ? true : false;
    }

    /**
     * @param $name
     * @return mixed
     * get cookie value
     */
    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    /**
     * @param $name
     * @param $value
     * @param $expiry
     * @return bool
     *
     */
    public static function put($name, $value, $expiry)
    {
        if(setcookie($name, $value, time() + $expiry, '/')){
            return true;
        }
        return false;
    }

    /**
     * @param $name
     * to delete cookie, you must reset it with a
     * negative value
     */
    public static function delete($name)
    {
        // delete
        self::put($name, '', time() - 1);
    }

}