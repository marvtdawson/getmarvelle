<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/17/16
 * Time: 2:37 PM
 */

namespace library\Form;
use library\Filters\Sanitize_Input_Fields;

class Input
{
    /**
     * @param string $type
     * @return bool
     */
    public static function exists($type = 'post'){

        switch($type){
            case 'post' :
                return (!empty($_POST)) ? true : false;
                break;

            case 'get':
                return (!empty($_GET)) ? true : false;
                break;

            default:
                return false;
                break;

        } // close switch

    } // close exist()

    /**
     * @param $item
     * @return string
     * this get function defines which input field element value
     * to get from the form
     */
    public static function get($item){

        // check for post data first
        if(isset($_POST[$item])){

            // Sanitize fields of tags, slashes, quotes etc etc
            $filterRegularFields = new Sanitize_Input_Fields();
            return $filterRegularFields->sanitize($_POST[$item]);

        }
        else if(isset($_GET[$item])){ // else check for get data in uri
            return $_GET[$item];
        }
        return '';  // return empty string if data does not exist
    }

}