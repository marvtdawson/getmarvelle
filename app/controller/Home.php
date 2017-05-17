<?php
namespace App\Controller;
use AppCMS\Controller\Slideshow;
use core\Config;
use core\Controller;
use core\View;
use library\Sessions\Sessions;
use library\CSRF\CSRF;

class Home extends Controller  {

    public $regSuccess,
        $username,
        $userLogin,
        $siteName,
        $getImages;

    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before()
    {
        $this->siteName = parent::getSiteName();

        /*$loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->userName;
        $this->userLogin = $loggedInUserName->checkLoggedInUser();*/
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        //echo " (after)";
    }


    public function indexAction()
    {

        if(Sessions::exists('success')){
            $this->regSuccess = Sessions::flash('success');
        }

        View::renderTemplate('index.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => Config::SITE_NAME,
            'formName' => Config::REGISTER_FORM_NAME,
            'processLoginForm' => Config::LOGIN_FORM_PROCESS,
            'processform' => Config::REGISTER_FORM_PROCESS,
            'submitbutton' =>  Config::REGISTER_FORM_SUBMIT_BUTTON,
            'userReg' => $this->regSuccess,
            'siteName' => $this->siteName,
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
        ]);
    }

    public function getSlideShowImages(){

        $this->getImages = new Slideshow();



    }


}