<?php
/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/7/16
 * Time: 11:07 PM
 *
 *
 *
 */

namespace App\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\Models\ContactModel;
//use library\Error;
use library\Form\Validation;
use library\Form\Input;
use library\CSRF\CSRF;
use library\Controller\United_States;
use library\Controller\Redirect;
use Exception;
use appcms\controller\Userprofile;
use library\Models\CorePagesModel;
use library\Models\SiteKeyWordsModel;

class Contact extends Controller
{

    public $validator,
        $error,
        $formName,
        $pageTitle,
        $processForm,
        $submitButton,
        $token,
        $states,
        $abbrvkey,
        $selectedstate,
        $userLogin,
        $username,
        $getpagecontent,
        $corepagenumber,
        $contactentry,
        $getLastMessageId,
        $siteContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1118,
        $keyword_type = Config::CORE_PAGES_KEYWORDS;


    public function __construct(array $route_params)
    {
        parent::__construct($route_params);

    }


    /**
     * Before filter which is useful for login authentication
     * session control and cookies
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
     * After filter which could potentially be good for destroying sessions etc
     *
     * @return void
     */
    protected function after()
    {
    }

    /**
     * show contact page view
     */
    public function indexAction()
    {
        //render variable values to Twig template variables
        View::renderTemplate('contact.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' =>  Config::CONTACT_FORM_PAGE_TITLE,
            'pageTitle' =>  Config::CONTACT_FORM_PAGE_TITLE,
            'formName' => Config::CONTACT_FORM_NAME,
            'processform' => Config::CONTACT_FORM_PROCESS,
            'submitbutton' => Config::CONTACT_FORM_SUBMIT_BUTTON,
            'states' => United_States::us_abbr(),// added states to form
            'siteName' => $this->siteName,
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
            'siteKeywords' => $this->siteKeywords,
        ]);
    }

    /**
     *  process contact form for proper
     *  validation and filtering before saving
     */
    public function processAction()
    {
        // 1. check if the Input values exist
        if (Input::exists()) {

            // 2. check token value

            // 3. get input fields
            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'contact_Name' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 25
                ),
                'contact_State' => array(
                    'required' => true,
                    'max' => 25
                ),
                'contact_City' => array(
                    'required' => true,
                    'min' => 5,
                    'max' => 35
                ),
                'contact_Email' => array(
                    'required' => true,
                    'min' => 10,
                    'max' => 35
                ),
                'contact_Message' => array(
                    'required' => true,
                    'max' => 255
                ),
                'contact_Month' => array('max' => 25),
                'contact_Day' => array('max' => 25),
                'contact_Year' => array('max' => 25),
            ));

            if ($validate->passed()) {

                $this->contactentry = new ContactModel();

                try {
                    $this->contactentry->create(array(  // create user memberprofile in table
                        'contact_Name' => Input::get('contact_Name'),
                        'contact_State' => Input::get('contact_State'),
                        'contact_City' => Input::get('contact_City'),
                        'contact_Email' => Input::get('contact_Email'),
                        'contact_Message' => Input::get('contact_Message'),
                        'contact_Month' => date('M'),
                        'contact_Day' => date('d'),
                        'contact_Year' => date('Y')
                    ));

                    $this->getLastMessageId = $this->contactentry->lastId();

                    Redirect::to(Config::APP_CONFIRM_CONTACT_MESSAGES_PAGE_PRETTY_URI);

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
        }
    }
}