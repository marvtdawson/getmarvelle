<?php
/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/7/16
 * Time: 11:07 PM
 */

namespace App\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\Cookies\Cookies;
use library\Form\Validation;
use library\Form\Input;
use library\CSRF\CSRF;
use library\Sessions\Sessions;
use library\User\User;
use library\Controller\Redirect;
use Library\Models\Model;
//use AppCMS\Controller\Permissions;
use AppCMS\Controller\Userprofile;
use Library\Models\CorePagesModel;
use Library\Models\SiteKeyWordsModel;

class Login extends Controller {

    public $validator,
        $error,
        $formName,
        $pageTitle,
        $processForm,
        $submitButton,
        $token,
        $_sess_id_exist,
        $_sess_email_exist,
        $user,
        $userLogin,
        $username,
        $getMemberActivationStatus,
        $siteContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1119,
        $keyword_type = Config::CORE_PAGES_KEYWORDS;

    public function __construct(array $route_params){

        parent::__construct($route_params);

        if(Cookies::exists(Config::COOKIE_HASH_NAME) && !Sessions::exists(Config::getLoggedInUserSessionName())){
           $hash = Cookies::get(Config::COOKIE_HASH_NAME);
           $hashCheck = Model::getInstance()->get('us3rz_S3ssIoN', array('hash', '=', $hash));

           if($hashCheck->count()){
               $user = new User($hashCheck->first()->user_id);
               $user->login();
           }
        }
    }

    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before()
    {
        $this->siteName = parent::getSiteName();

        $this->getSiteKeywords = new SiteKeyWordsModel();
        $this->getSiteKeywords->find($this->keyword_type);
        $this->siteKeywords = $this->getSiteKeywords->data()->pages_Keywords;

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->userName;
        $this->userLogin = $loggedInUserName->checkLoggedInUser();
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {        //echo " (after)";
    }

    public function indexAction()
    {
        //render variable values to Twig template variables
        View::renderTemplate('login.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => Config::LOGIN_FORM_PAGE_TITLE,
            'pageTitle' => Config::LOGIN_FORM_PAGE_TITLE,
            'formName' => Config::LOGIN_FORM_NAME,
            'processForm' => Config::LOGIN_FORM_PROCESS,
            'submitbutton' => Config::LOGIN_FORM_SUBMIT_BUTTON,
            'forgotpassword' => Config::FORGOT_PASSWORD_FORM_PRETTY_URI,
            'siteName' => $this->siteName,
            'username' =>  $this->username,
            //'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
            'siteKeywords' => $this->siteKeywords,
        ]);
    }

    /**
     *
     */
    public function processAction()
    {
        /**
         *  if incoming form action does not equal post method
         *  then kill page
         */

        // 1. check if the input data via post or get method exist
        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            if(CSRF::check(Input::get('csrf_token'))) {

                $validate = new Validation();

                //echo "Validation is good<br>";

                $validation = $validate->check($_POST, array(
                    'regMem_E1' => array(
                        'required' => true,
                        'min' => 10,
                        'max' => 35
                    ),
                    'regMem_Pw' => array(
                        'required' => true,
                        'min' => 6,
                        'max' => 35,
                    )
                ));

                //echo 'Data from form is present<br>';

                if ($validation->passed()) {

                    $this->user = new User();

                    $remember = (Input::get('regRemember') === 'on') ? true : false;

                    //echo 'Sending Data to User class<br>';

                    $login = $this->user->login(Input::get('regMem_E1'), Input::get('regMem_Pw'), $remember);

                    if($login){

                        //echo 'Found login data<br>';

                        $this->getMemberActivationStatus = $this->user->data()->regMem_Account;

                        // check if account has been set to active
                        if($this->getMemberActivationStatus === 'A') {

                           // Redirect::to(Config::APP_CMS_CPANEL_INDEX_PRETTY_URI);

                            Redirect::to('/appcms/profile/index');

                        }else{  // user has not completed activation process
                            Redirect::to(Config::APP_CONFIRM_ACTIVATION_ACCOUNT_PAGE_PRETTY_URI);
                        }

                       /* if($user->hasPermission('member') || $user->hasPermission('admin') ) { // if permissions is for a regular member
                            // redirect to cpanel page
                            Redirect::to(Config::APP_CMS_CPANEL_INDEX_PRETTY_URI);
                        }else{
                            Redirect::to(Config::APP_CONFIRM_MESSAGES_PAGE_PRETTY_URI);
                        }*/

                   }else {
                        // redirect user to register page
                        //Redirect::to(Config::REGISTER_FORM_PRETTY_URI);

                        echo 'You got a problem Marvo, it is not working';
                    }
                }
                 else{
                         foreach ($validation->errors() as $error) {
                             echo $error, "<br>";
                         }
                    }
            }
        }
    }
}