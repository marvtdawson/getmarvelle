<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/17/16
 * Time: 2:35 PM
 */

namespace library\Form;

use library\Error\ErrorHandler;
use Library\Models\Model;


class Validation
{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    protected $errorHandler;
    protected $validator;

    //public function __construct($error){
    public function __construct(){
       // get instance of db connection
       $this->_db = Model::getInstance();
    }

    public function check($source, $items = array()){

        // loop through each input field as items array
        foreach($items as $item => $rules){

            // loop through each defined rule on input field validation rules array
            foreach($rules as $rule => $rule_value){

                //echo "{$item} {$rule} must be {$rule_value}<br>";

                // source is the form method get or post of each element
                $value = trim($source[$item]);
                //$item = escape($item);

                // check if field is required
                if($rule === 'required' && empty($value)){
                    $this->addError("{$item} is required");
                }
                else
                {
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value]){ // value does match another field value, so good
                                $this->addError("{$rule_value} must match {$item}.");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                               if($check->count()){
                                    $this->addError("{$item} not found.");
                                }
                            break;
                    }
                }

            }

        }
        // after checking for empty fields
        // if empty input fields exist return true to controller
        if(empty($this->_errors)){
            $this->_passed = true;
        }
            return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }

}