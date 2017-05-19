<?php

/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/11/16
 * Time: 10:08 PM
 */

namespace library\Controller;
use App\Config\Errors;

class Redirect
{

    public static function to($location = null){
        if($location){
           if(is_numeric($location)){
                switch($location){
                    case 300:
                        header('HTTP/1.0 303 Not Found');
                        include('../../app/views/include/errors/e303.phtml');
                    break;
                    case 400:
                        header('HTTP/1.0 404 Not Found');
                        include('../../app/views/include/errors/e404.phtml');
                    break;
                    case 500:
                        header('HTTP/1.0 500 Not Found');
                        include('../../app/views/include/errors/e505.phtml');
                    break;
                }
            }
            else{
                header('Location: http://' . $_SERVER['HTTP_HOST'] . $location);
                exit();
            }
        }
    }

}