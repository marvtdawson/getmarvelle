<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/29/16
 * Time: 6:01 PM
 */

namespace App\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\Form\Validation;
use library\Form\Input;
use library\CSRF\CSRF;
use appcms\controller\Userprofile;
use Library\Models\CorePagesModel;
use Library\Models\SiteKeyWordsModel;


class Forgotpassword extends Controller
{
    public $validator,
        $validation,
        $error,
        $formName,
        $pageTitle,
        $processForm,
        $submitButton,
        $token,
        $userLogin,
        $username,
        $siteContent,
        $getPageContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1133,
        $keyword_type = Config::CORE_PAGES_KEYWORDS;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);

        $this->formName = Config::FORGOT_PASSWORD_FORM_NAME;
        $this->processForm = Config::FORGOT_PASSWORD_FORM_PROCESS;
        $this->submitButton = Config::FORGOT_PASSWORD_FORM_SUBMIT_BUTTON;
        $this->pageTitle = Config::FORGOT_PASSWORD_FORM_PAGE_TITLE;

        $this->token = CSRF::generatetoken();

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
    {
        //echo " (after)";
    }

    public function indexAction()
    {

        View::renderTemplate('forgotpassword.phtml', [
            'csrftoken' => $this->token,
            'tabTitle' => $this->pageTitle,
            'pageTitle' => $this->pageTitle,
            'formName' => $this->formName,
            'processform' => $this->processForm,
            'submitbutton' => $this->submitButton,
            'siteName' => Config::SITE_NAME,
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
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

        // 1. check if the Input class exist
        if(Input::exists()){

            $validate = new Validation();

            $this->validation = $validate->check($_POST, array(
                    'regEmail_1' => array(
                    'required' => true,
                    'min' => 10,
                    'max' => 35,
                ),

            ));

            if($validate->passed())
            {
                echo 'Passed';
            }else{
                print_r($validate->errors());
            }
        }
    }

}