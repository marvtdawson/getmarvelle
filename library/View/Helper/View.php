<?php
/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/12/16
 * Time: 1:10 AM
 */

namespace View;


class View
{
    protected $data;
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
        $this->data = array();
    }

    public function setData($key, $val){
        $this->data[$key] = $val;
    }

    function render(){
        $data = $this->data;
        extract($data);

        ob_start();
        require($this->path);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}