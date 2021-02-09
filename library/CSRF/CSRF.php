<?php
namespace Library\CSRF;
use library\Sessions\Sessions;
use core\Config;

class CSRF
{

    public static function generatetoken()
    {
        return Sessions::put(Config::getTokenName(), md5(uniqid())); // return session token name and session value
    }

    public static function check($token)  // input value
    {
        $tokenName = Config::getTokenName();  // returns 'csrf_token' name

        if (Sessions::exists($tokenName) && $token === Sessions::get($tokenName))
        {
            Sessions::delete($tokenName);
            return true;
        }

        return false;
    }

}