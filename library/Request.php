<?php

/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/12/16
 * Time: 12:48 AM
 */

namespace Library;

class Request
{
    protected $params;
    protected $action;

    public function __construct()
    {
        $this->params = $params;

        if(isset($params["action"])){
            $this->action = $params['action'];
        }else {
            $this->action = "index";
        }

    }

    public function getParams(){
        return $this->params;
    }

    public function getAction(){
        return $this->action;
    }

}