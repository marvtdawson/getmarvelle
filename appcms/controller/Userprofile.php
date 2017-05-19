<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/21/17
 * Time: 3:43 PM
 */

namespace appcms\controller;
use core\Controller;
use library\User\User;
use library\Controller\Redirect;
use Core\Config;
use library\Sessions\Sessions;


class Userprofile extends Controller
{
    public $userName,
        $userLogin,
        $checkLoggedInUser;

    public function __construct()
    {
        $this->checkLoggedInUser = $this->checkLoggedInUser();

    }

    public function checkLoggedInUser()
    {
        if(Sessions::exists(Config::getLoggedInUserSessionName())) {
            $this->userLogin = true ;
        } else {
            $this->userLogin = false ;
        }

        return $this->userLogin;
    }

    public function getLoggedInUserInfo(){

        $user = new User();

        if($user->isLoggedIn()){ // if user log in status is true

            // get first user name and escape data before sending to view
            //$this->userName = $user->data()->regMem_Name;
            $this->userName = $user->data();

            return $this->userName; // return user name

        }else{
            Redirect::to(Config::LOGIN_FORM_PRETTY_URI);
        }
    }

}