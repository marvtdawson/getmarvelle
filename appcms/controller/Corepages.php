<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/16/17
 * Time: 12:26 AM
 */

namespace AppCMS\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\Controller\Redirect;
use library\CSRF\CSRF;
use library\Form\Validation;
use library\Form\Input;
use Exception;
use library\Models\CorePagesModel;
use library\Models\SiteKeyWordsModel;
use Library\User\User;


class Corepages extends Controller
{
    public $username,
        $userId,
        $curruserInfo,
        $fields,
        $displaypagecontent,
        $editpagecontent,
        $selectedpagenumber,
        $_tableName = 'cor3Pag3s',
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteName,
        $getPageContent,
        $siteContent,
        $core_page_number,
        $pageContent,
        $pageSelection;

    public static $corePagesName;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);

        $this->curruserInfo = new User();
        $this->userId =  $this->curruserInfo->data()->id;
    }
    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before(){


        $this->siteName = parent::getSiteName();

        $this->getSiteKeywords = new SiteKeyWordsModel();
        $this->getSiteKeywords->find($this->keyword_type);
        $this->siteKeywords = $this->getSiteKeywords->data()->pages_Keywords;

        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->getLoggedInUserInfo()->regMem_Name;
        $this->userId =  $loggedInUserName->getLoggedInUserInfo()->id;

    }

    /**
     * After filter which could potentially be good for destroying sessions
     *
     * @return void
     */
    protected function after(){}

    public function getSelectedValue()
    {
        if (isset($_GET['corepagenumber']) &&  !empty($_GET['corepagenumber'])) {

            $this->selectedpagenumber = $_GET['corepagenumber'];

            $this->getPageContent = new CorePagesModel();
            $this->getPageContent->find($this->selectedpagenumber);
            $this->siteContent = $this->getPageContent->data()->corePages_Content;

            echo $this->siteContent;
        }
        return $this->siteContent;
    }


    /**
     * Show the index page
     * @return void
     */
    public function indexAction()
    {
        $this->getPageContent = new CorePagesModel();
        $this->pageContent = $this->getSelectedValue();

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/index.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'cPanel',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'pageName' => 'Pages',
            'processuploadPageContent' => Config::APP_CMS_SAVE_CORE_PAGES_PRETTY_URI,
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'aboutPage' => '/appcms/corepages/aboutpage',
            'productPage' => '/appcms/corepages/productpage',
            'servicesPage' => '/appcms/corepages/servicespage',
            'vlogPage' => '/appcms/corepages/vlogpage',
            'termsPage' => '/appcms/corepages/termspage',
            'blogPage' => '/appcms/corepages/blogpage',
            'privacyPage' => '/appcms/corepages/privacypage',
            'socialPage' => '/appcms/corepages/socialpage',
            'loginPage' => '/appcms/corepages/loginpage',
            'logoutPage' => '/appcms/corepages/logoutpage',
            'contactPage' => '/appcms/corepages/contactpage',
            'registerPage' => '/appcms/corepages/registerpage',
            'galleryPage' => '/appcms/corepages/gallerypage',
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' =>  $this->username
        ],  'appcms/views');
    }


    public function editpagesAction(){

        //echo 'User index on User Page<br>';
        /*View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'pageName' => 'Pages',
            'processuploadPageContent' => Config::APP_CMS_SAVE_CORE_PAGES_PRETTY_URI,
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->getSelectedValue(),
            'username' =>  $this->username
        ],  'appcms/views');*/


        // 1. check if the input data via post or get method exist
        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function aboutpageAction()
    {
        $this->core_page_number = '1115';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'About',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/aboutpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        // 1. check if the input data via post or get method exist
        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }

    }

    public function blogpageAction()
    {
        $this->core_page_number = '1126';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Blog',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/blogpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        // 1. check if the input data via post or get method exist

    }

    public function contactpageAction()
    {
        $this->core_page_number = '1118';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Contact',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/contactpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function musicpageAction()
    {
        $this->core_page_number = '1130';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Music',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/musicpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function videopageAction()
    {
        $this->core_page_number = '1129';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Video',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/videopage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }

    }

    public function vlogpageAction()
    {
        $this->core_page_number = '1127';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Vlog',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/vlogpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

             if(Input::exists()){

                 // 2. get input field csrf_token and check if it exist
                 //if(CSRF::check(Input::get('csrf_token'))) {

                 $validate = new Validation();

                 $validation = $validate->check($_POST, array(
                     'editcorepages' => array(
                         'required' => true,
                     )
                 ));

                 if ($validation->passed()) {
                     try {
                         $this->getPageContent->update('cor3Pag3s',
                             array('corePages_Content' => Input::get('editcorepages')
                             ), $this->core_page_number);

                         Redirect::to('/appcms/corepages/index');

                     }catch (Exception $e) {
                         die($e->getMessage());
                     }
                 } else { // loop through each validation error that is return
                     foreach ($validation->errors() as $error) {
                         echo $error, "<br>";
                     }
                 }
                 //}
             }
    }

    public function productpageAction()
    {

        $this->core_page_number = '1117';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = html_entity_decode($this->getPageContent->data()->corePages_Content);

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Product',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/productpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'username' => $this->username
        ], 'appcms/views');

        // 1. check if the input data via post or get method exist
        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

                $validate = new Validation();

                $validation = $validate->check($_POST, array(
                    'editcorepages' => array(
                        'required' => true,
                    )
                ));

                if ($validation->passed()) {
                    try {
                          $this->getPageContent->update('cor3Pag3s',
                            array('corePages_Content' => Input::get('editcorepages')
                            ), $this->core_page_number);

                        Redirect::to('/appcms/corepages/index');

                    }catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else { // loop through each validation error that is return
                    foreach ($validation->errors() as $error) {
                        echo $error, "<br>";
                    }
                }
            //}
        }
    }

    public function servicespageAction()
    {
        $this->core_page_number = '1116';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Services',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/servicespage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function termspageAction()
    {
        $this->core_page_number = '1122';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Terms & Conditions',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/termspage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function privacypageAction()
    {
        $this->core_page_number = '1121';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Privacy',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/privacypage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function socialpageAction()
    {
        $this->core_page_number = '1123';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Social Media',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/socialpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function registerpageAction()
    {
        $this->core_page_number = '1120';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Register',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/registerpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function subscribepageAction()
    {
        $this->core_page_number = '1135';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Subscribe',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/subscribepage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function forgotpasswordpageAction()
    {
        $this->core_page_number = '1133';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Forgot Password',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/forgotpasswordpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function loginpageAction()
    {
        $this->core_page_number = '1119';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Login',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/loginpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function logoutpageAction()
    {
        $this->core_page_number = '1132';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Logout',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/logoutpage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function gallerypageAction()
    {
        $this->core_page_number = '1124';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Gallery',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/gallerypage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function historypageAction()
    {
        $this->core_page_number = '1128';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'History',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/historypage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function clientspageAction()
    {
        $this->core_page_number = '1125';

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;

        //echo 'User index on User Page<br>';
        View::renderTemplate('/corepages/editpages.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit Core Pages',
            'pageTitle' => 'Edit Core Pages',
            'breadcrumb_index' => 'Core Pages',
            'pageName' => 'Clients',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'indexpage' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processuploadPageContent' => '/appcms/corepages/clientspage',
            'processPageSelection' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'pageContent' => $this->siteContent,
            'pageNames' => $this->getPageContent->corePagesName(),  // display page names in drop down
            'username' => $this->username
        ], 'appcms/views');

        if(Input::exists()){

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validate = new Validation();

            $validation = $validate->check($_POST, array(
                'editcorepages' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->getPageContent->update('cor3Pag3s',
                        array('corePages_Content' => Input::get('editcorepages')
                        ), $this->core_page_number);

                    Redirect::to('/appcms/corepages/index');

                }catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop through each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

}