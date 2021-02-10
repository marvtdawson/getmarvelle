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
use library\Controller\Redirect;
use Exception;
use Library\Models\Subscribe_Model;
use appcms\controller\Userprofile;
use Library\Models\CorePagesModel;
use Library\Models\SiteKeyWordsModel;

class Subscribe extends Controller
{
    public $userLogin,
        $username,
        $getpagecontent,
        $siteContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1116,
        $keyword_type = Config::CORE_PAGES_KEYWORDS;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);
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
        View::renderTemplate('subscribe.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => Config::SUBSCRIBE_FORM_PAGE_TITLE,
            'pageTitle' => Config::SUBSCRIBE_FORM_PAGE_TITLE,
            'formName' => Config::SUBSCRIBE_FORM_NAME,
            'processForm' => Config::SUBSCRIBE_FORM_PROCESS,
            'submitbutton' => Config::SUBSCRIBE_FORM_SUBMIT_BUTTON,
            'siteName' => $this->siteName,
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
        // 1. check if the Input class exist
        if (Input::exists()) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'memName' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 35,
                ),
                'memEmail' => array(
                    'required' => true,
                    'min' => 10,
                    'max' => 35,
                ),

            ));

            if ($validate->passed()) {

                $subscribe = new Subscribe_Model();

                try {
                    $subscribe->create(array(  // create user memberprofile in table
                        'memName' => Input::get('memName'),
                        'memEmail' => Input::get('memEmail'),
                        'subscriptionStatus' => ('S'),
                        'signupMonth' => date('M'),
                        'signupDay' => date('d'),
                        'signupYear' => date('Y')
                    ));

                    Redirect::to('/confirmMessages/index');

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