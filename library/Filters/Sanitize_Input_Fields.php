<?php

namespace library\Filters;

/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 11/27/16
 * Time: 12:17 PM
 */
class Sanitize_Input_Fields
{

    public function __construct(){}

    public function sanitize($fieldVar)
    {
        $fieldVar = trim($fieldVar);
        $fieldVar = stripslashes($fieldVar);
        $fieldVar = strip_tags($fieldVar);
        $fieldVar = htmlentities($fieldVar, ENT_QUOTES, 'UTF-8');  // escape both single and double quotes
        $fieldVar = htmlspecialchars($fieldVar);
        $fieldVar = preg_replace('#[^A-Za-z0-9.-_" "@]#', '', $fieldVar);
        return ($fieldVar);
    }

}