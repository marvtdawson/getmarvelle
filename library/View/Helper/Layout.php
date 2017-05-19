<?php

/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/11/16
 * Time: 10:55 PM
 *
 * this file should have http and url routing for the files and classes in the App/View/Core folder
 * this file will serve as the template for all front end facing core corepages.
 */

namespace Library\View;

class Layout
{

    private $title, $stylesheets=array(), $javascripts=array(), $body;

    public function Layout(){
        $this->addCSS('/theme/css/main_content.css');
    }

    function setTitle($title){
        $this->title = $title;
    }

    function addCSS($path){
        $this->stylesheets[] = $path;
    }

    function addJavascript($path){
        $this->javascripts[] = $path;
    }

    function startBody(){
        ob_start();
    }

    function endBody(){
        $this->body = ob_get_clean();
    }

    function render(){
        ob_start();
        include($path);
        return ob_get_clean();
    }

    public function getHeader()
    {

    }

    public function getMainContent()
    {

    }

    public function getFooter()
    {

    }

    public function getSubFooter()
    {

    }

}