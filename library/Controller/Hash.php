<?php

/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/11/16
 * Time: 10:08 PM
 */

namespace library\Controller;

class Hash
{
    /**
     * @param $string
     * @param string $salt
     * @return string
     * make hash with a sha256 algorithm
     * and concatenate the salt to the end of the string
     *
     */
    public static function make($string, $salt = ''){
        return hash('sha256', $string . $salt);
    }

    /**
     * @param $length
     * @return string
     * salt hash
     */
    public static function salt($length){
        //return random_bytes($length); // alternative to mcrypt_create_iv() which is deprecated
        return bin2hex(openssl_random_pseudo_bytes($length));
    }

    /**
     * @return string
     * make unique hash id
     */
    public static function unique(){
        return self::make(uniqid());
    }


}