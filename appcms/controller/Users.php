<?php

namespace AppCMS\Controller;
use core\Config;
use core\Controller;
use core\View;
use Library\Controller\Styles;
use Library\CSRF\CSRF;
use library\User\User;
use Library\Controller\United_States;
use library\Form\Validation;
use library\Form\Input;
use library\Controller\Redirect;
use Exception;
use library\Models\SiteKeyWordsModel;


/**
 * User admin controller
 *
 * PHP version 5.4
 */
class Users extends Controller
{

    public $username,
        $loggedInUserName,
        $curruserInfo,
        $userDemoInfo,
        $validate,
        $userId,
        $fields,
        $_tableName = 'r3gM3mb3rs',
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords;

    public function __construct(){

       $this->curruserInfo = new User();
       $this->userId =  $this->curruserInfo->data()->id;

       $this->userDemoInfo = new Userdemographics();
       $this->userDemoInfo->find($this->userId);

       $this->validate = new Validation();

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

        // check if user is logged in via isLoggedIn()
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

    ###################### RENDER VIEWS ###################################

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('users/index.phtml', [
            'tabtitle' => 'User Info',
            'pageTitle' => 'User Info',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'userprofileindex' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'editaddress' => Config::APP_CMS_USER_EDIT_ADDRESS_PRETTY_URI,
            'editemail' => Config::APP_CMS_USER_EDIT_EMAIL_PRETTY_URI,
            'editphone' => Config::APP_CMS_USER_EDIT_PHONE_PRETTY_URI,
            'editalternativeemail' => Config::APP_CMS_USER_EDIT_ALTERNATIVE_EMAIL_PRETTY_URI,
            'artistName' => '/appcms/users/artistname',
            'artistStyle' => '/appcms/users/artiststyle',
            'artistBio' => '/appcms/users/artistbio',
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

    public function editAddress()
    {

        View::renderTemplate('users/address.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => 'Edit User Address',
            'pageTitle' => 'Edit User Address',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'User Info',
            'indexpage' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'userprofileindex' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'processForm' => Config::APP_CMS_USER_EDIT_ADDRESS_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'states' => United_States::us_abbr(),// added states to form
            'userstate' => $this->userDemoInfo->data()->regMem_State,
            'city' => $this->userDemoInfo->data()->regMem_City,
            'zipcode' => $this->userDemoInfo->data()->regMem_Zipcode,
            'username' =>  $this->username

        ],  'appcms/views');

        // update user data
        // check if the input data via post or get method exist
        if(Input::exists()) {

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validation = $this->validate->check($_POST, array(
                'user_state' => array(
                   /* 'min' => 4,
                    'max' => 35,*/
                ),
                'user_city' => array(
                    'min' => 4,
                    'max' => 25,
                ),
                'user_zipcode' => array(
                    'min' => 5,
                    'max' => 10,
                )
            ));

            if ($validation->passed()) {
                try {
                    $this->curruserInfo->update('regMemDemographics', array(  // update user memberprofile in table
                        'regMem_State' => Input::get('user_state'),
                        'regMem_City' => Input::get('user_city'),
                        'regMem_Zipcode' => Input::get('user_zipcode'),
                    ));

                    Redirect::to(Config::APP_CMS_USER_INDEX_PAGE_URI);

                } catch (Exception $e) {
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

    public function editEmail(){

        View::renderTemplate('users/email.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabtitle' => 'Edit User Email',
            'pageTitle' => 'Edit User Email',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'User Info',
            'indexpage' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processForm' => Config::APP_CMS_USER_EDIT_EMAIL_PRETTY_URI,
            'username' =>  $this->username,
            'currentEmail' => $this->curruserInfo->data()->regMem_E1,
        ],  'appcms/views');

        // update user data
        // check if the input data via post or get method exist
        if(Input::exists()) {

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validation = $this->validate->check($_POST, array(
                'user-primary-email' => array(
                    'min' => 6,
                    'max' => 35,
                )
            ));

            if ($validation->passed()) {

                try {
                    $this->curruserInfo->update('r3gM3mb3rs', array(  // update user memberprofile in table
                        'regMem_E1' => Input::get('user-primary-email'),
                        'regMem_E2' => Input::get('user-primary-email'),
                    ));

                    Redirect::to(Config::APP_CMS_USER_INDEX_PAGE_URI);

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop thru each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }

    }

    public function alternativeemail(){

        View::renderTemplate('users/alternativeemail.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabtitle' => 'Edit Alternative Email',
            'pageTitle' => 'Edit Alternative Email',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'User Info',
            'indexpage' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'processForm' => Config::APP_CMS_USER_EDIT_ALTERNATIVE_EMAIL_PRETTY_URI,
            'username' =>  $this->username,
            'alterEmail' => $this->curruserInfo->data()->regMem_Alt_E,
        ],  'appcms/views');

        // update user data
        // check if the input data via post or get method exist
        if(Input::exists()) {

            // get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validation = $this->validate->check($_POST, array(
                'user-alternative-email' => array(
                    'min' => 6,
                    'max' => 35,
                )
            ));

            if ($validation->passed()) {

                try {
                    $this->curruserInfo->update('r3gM3mb3rs', array(  // update user memberprofile in table
                        'regMem_Alt_E' => Input::get('user-alternative-email')
                    ));

                    Redirect::to(Config::APP_CMS_USER_INDEX_PAGE_URI);

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop thru each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }

    }

    public function editPhone(){
        View::renderTemplate('users/phone.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabtitle' => 'Edit User Phone',
            'pageTitle' => 'Edit User Phone',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'User Info',
            'indexpage' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'userprofileindex' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'editaddress' => Config::APP_CMS_USER_EDIT_ADDRESS_PRETTY_URI,
            'editemail' => Config::APP_CMS_USER_EDIT_EMAIL_PRETTY_URI,
            'editphone' => Config::APP_CMS_USER_EDIT_PHONE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username,
            'phoneNumber' => $this->curruserInfo->data()->regMem_Phone
        ],  'appcms/views');

        // update user data
        // check if the input data via post or get method exist
        if(Input::exists()) {

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validation = $this->validate->check($_POST, array(
                'user-phone' => array(
                    'required' => true,
                    'min' => 10,
                    'max' => 16,
                )
            ));

            if ($validation->passed()) {

                try {
                    $this->curruserInfo->update('r3gM3mb3rs', array(  // update user memberprofile in table
                        'regMem_Phone' => Input::get('user-phone'),
                    ));

                    Redirect::to(Config::APP_CMS_USER_INDEX_PAGE_URI);

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop thru each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }

    }

    public function artistname()
    {
        View::renderTemplate('users/artist_name.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabtitle' => 'Artist Facts',
            'pageTitle' => 'Artist Facts',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'User Info',
            'indexpage' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'userprofileindex' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'username' =>  $this->username,
            'artistName' => $this->curruserInfo->data()->regMem_Aname,
            'nameForm' => Config::APP_CMS_USER_DEMOGRAPHS_ARTIST_NAME_FORM_NAME,
            'processArtistName' => '/appcms/users/artistname',
        ], 'appcms/views');


        // update user data
        // check if the input data via post or get method existt
        if(Input::exists()) {

                // get input field csrf_token and check if it exist
                //if(CSRF::check(Input::get('csrf_token'))) {

                    $validation = $this->validate->check($_POST, array(
                        'artist-name' => array(
                            'required' => true,
                            'min' => 2,
                            'max' => 35,
                        )
                    ));

                    if ($validation->passed()) {

                        try {
                            $this->curruserInfo->update('r3gM3mb3rs', array(  // update user memberprofile in table
                                'regMem_Aname' => Input::get('artist-name'),
                            ));

                            Redirect::to(Config::APP_CMS_USER_INDEX_PAGE_URI);

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } else { // loop thru each validation error that is return
                        foreach ($validation->errors() as $error) {
                            echo $error, "<br>";
                        }
                    }
                //}
        }

    }

    public function artiststyle(){

        View::renderTemplate('users/artist_style.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabtitle' => 'Artist Style',
            'pageTitle' => 'Artist Style',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'User Info',
            'indexpage' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'userprofileindex' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'username' =>  $this->username,
            'artistname' => $this->curruserInfo->data()->regMem_Aname,
            'styles' => Styles::styleType(),
            'artistStyle' => htmlspecialchars($this->userDemoInfo->data()->regMem_Style),
            'nameForm' => Config::APP_CMS_USER_DEMOGRAPHS_ARTIST_NAME_FORM_NAME,
            'processArtistName' => Config::APP_CMS_USER_DEMOGRAPHS_PRETTY_URI,
            'processArtistFlow' => Config::APP_CMS_USER_DEMOGRAPHS_ARTIST_STYLE_FLOW_FORM,
            'styleForm' => Config::APP_CMS_USER_DEMOGRAPHS_ARTIST_STYLE_FORM_NAME,
        ], 'appcms/views');

        // update user data
        // check if the input data via post or get method existt
        if(Input::exists()) {

            // get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validation = $this->validate->check($_POST, array(
                'artist_style' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 35,
                )
            ));

            if ($validation->passed()) {

                try {
                    $this->curruserInfo->update('regMemDemographics', array(  // update user memberprofile in table
                        'regMem_Style' => htmlspecialchars(Input::get('artist_style')),
                    ));

                    Redirect::to(Config::APP_CMS_USER_INDEX_PAGE_URI);

                } catch (Exception $e) {
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

    public function artistbio()
    {


        View::renderTemplate('users/bio.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabtitle' => 'Artist Bio',
            'pageTitle' => 'Artist Bio',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'User Info',
            'indexpage' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'userprofileindex' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'username' => $this->username,
            'processuploadPageContent' => '/appcms/users/artistbio',
            'artistName' => $this->curruserInfo->data()->regMem_Aname,
            'nameForm' => Config::APP_CMS_USER_DEMOGRAPHS_ARTIST_NAME_FORM_NAME,
            'processArtistName' => '/appcms/users/artistname',
        ], 'appcms/views');

        // update user data
        // check if the input data via post or get method existt
        if(Input::exists()) {

            // get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validation = $this->validate->check($_POST, array(
                'edit_bio' => array(
                    'required' => true,
                )
            ));

            if ($validation->passed()) {

                try {
                    $this->curruserInfo->update('regMemDemographics', array(  // update user memberprofile in table
                        'regMem_Bio' => Input::get('edit_bio'),
                    ));

                    Redirect::to(Config::APP_CMS_USER_INDEX_PAGE_URI);

                } catch (Exception $e) {
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
