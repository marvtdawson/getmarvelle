<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/15/16
 * Time: 12:00 AM
 */

namespace library\Sessions;

class Sessions
{

    public $temp_session_name;

    /**
     * @param $name
     * @return bool
     */
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    /**
     * @param $name
     */
    public static function delete($name)
    {
        if(self::exists($name)){
            unset($_SESSION[$name]);
            //session_destroy();
        }

    }

    /**
     * @param $name
     * @return mixed
     */
    public static function get($name)
    {
        return $_SESSION[$name];
    }

    /**
     * @param $name
     * @param $value
     * check if session isset after login
     */
    public static function set($name, $value)
    {
        $_SESSION[$name] =  $value;
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     * return the value of the session name
     */
    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    /**
     * @param $name
     * @param string $string
     * @return mixed
     */
    public static function flash($name, $string = '')
    {
        if(self::exists($name)){ // check if session exists
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
    }


}