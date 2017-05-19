<?php

/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/11/16
 * Time: 10:08 PM
 *
 * MVC From Scratch - Udemy Example
 *
 */

namespace Library\Controller;

use Library\Response;
use Library\Request;

class AbstractController
{

/*    protected $view;
    protected $req;
    protected $resp;

    public function __construct(Request $req, Response $resp)
    {
        $this->req = $req;
        $this->resp = $resp;
    }

    public function exec()
    {
        $action = $this->req->getAction();
        $this->view = new View();

        $action .= "Action";
        $this->action();

        $this->dispatch();
    }

    public function setView($view){
        $this->view = $view;
    }

    public function dispatch(){
        $this->resp->setContent($this->view->render());
        echo $this->resp;
    }

    public function setData(){
        $this->view->setData($key,$value);
    }*/

}