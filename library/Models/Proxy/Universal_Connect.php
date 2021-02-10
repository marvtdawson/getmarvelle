<?php
namespace Library;
use Library\Iscriptz\IConnect2Db;

/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 11/16/16
 * Time: 11:41 PM
 * this file serve as universal connection to the database
 *
 */

class Universal_Connect implements IConnect2Db
{
    private static $server=IConnect2Db::CLIENTHOST;
    private static $db=IConnect2Db::CLIENTDB;
    private static $user=IConnect2Db::CLIENTUSER;
    private static $pw=IConnect2Db::CLIENTPW;
    private static $system_hookup;

    public function clientDoConnect()
    {
        self::$system_hookup=mysqli_connect(self::$server, self::$db, self::$user, self::$pw);

        if(self::$system_hookup)
        {
            echo 'System Did Hook Up';
        }
        elseif(mysqli_connect_error())
        {
            echo 'System Did Not Hook Up: <br>' . mysqli_connect_error();
        }
        return self::$system_hookup;
    }
}