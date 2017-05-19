<?php
/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/12/16
 * Time: 12:48 AM
 */

namespace Library;


class Response
{
    protected $output;

    public function setContent($content){
        $this->output = $content;
    }

    public function _toString(){
        return $this->output;
    }

}