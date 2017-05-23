<?php
/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/7/16
 * Time: 11:07 PM
 */

namespace App\Controller;
use appcms\controller\Emailer;
use appcms\controller\Userdemographics;
use core\Config;
use core\Controller;
use core\View;
use library\Form\Validation;
use library\Form\Input;
use library\CSRF\CSRF;
//use library\Sessions\Sessions;
use library\User\User;
use library\Controller\Hash;
use Exception;
use library\Controller\Redirect;
//use PDOException;
//use appcms\controller\Userprofile;
//use PDO;
use library\Models\CorePagesModel;
use library\Models\SiteKeyWordsModel;


class Register extends Controller {

    public $validator;
    public $error;
    public $formName;
    public $pageTitle;
    public $processForm;
    public $submitButton;
    public $token,
        $userLogin,
        $username,
        $getNewUserId,
        $memberBaseDir,
        $sendNewMemberEmail,
        $confirmation,
        $getpagecontent,
        $siteContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1120,
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

       /* $loggedInUserName = new Userprofile();
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
        View::renderTemplate('register.phtml', [
            'csrftoken' => CSRF::generatetoken(),
            'tabTitle' => Config::REGISTER_FORM_PAGE_TITLE,
            'pageTitle' => Config::REGISTER_FORM_PAGE_TITLE,
            'formName' => Config::REGISTER_FORM_NAME,
            'processform' => Config::REGISTER_FORM_PROCESS,
            'submitbutton' =>  Config::REGISTER_FORM_SUBMIT_BUTTON,
            'siteName' => $this->siteName,
            'username' =>  $this->username,
            //'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
            'siteKeywords' => $this->siteKeywords,
        ]);

        // if user is logged in redirect to profile page
        if($this->username !== ''){

            Redirect::to('/appcms/profile/index');
        }
    }

    public function gotInfo(){


            echo '<script type="javascript">alert("Got Info");</script>';

    }

    /**
     *
     */
    public function processAction()
    {

        // 1. check if the Input class exist
        if(Input::exists()){

            if(CSRF::check(Input::get('csrf_token'))) {

                $validate = new Validation();

                $validation = $validate->check($_POST, array(

                    'regMemberType' => array(
                        'required' => true,
                        'min' => 2,
                        'max' => 25,
                    ),
                    'regAname' => array(
                        'required' => true,
                        'name' => 'Artist Name',
                        'min' => 2,
                        'max' => 25,
                    ),
                    'regName' => array(
                        'required' => true,
                        'name' => 'Name',
                        'min' => 5,
                        'max' => 35,
                    ),
                    'regEmail_1' => array(
                        'required' => true,
                        'name' => 'Email',
                        'min' => 10,
                        'max' => 35,
                    ),
                    'regEmail_2' => array(
                        'required' => true,
                        'name' => 'Re-Email',
                        'max' => 255,
                    ),
                    'regPw' => array(
                        'required' => true,
                        'name' => 'Password',
                        'min' => 6,
                        'max' => 35,
                    ),
                    'regTerms' => array(
                        'required' => true
                    )
                ));

                if ($validation->passed()) {

                    $user =  new User();
                    $salt = Hash::salt(32);

                    try{
                        $user->create(array(  // create user memberprofile in table
                            'regMem_Type' => Input::get('regMemberType'),
                            'regMem_Aname' => Input::get('regAname'),
                            'regMem_Name' => Input::get('regName'),
                            'regMem_E1' => Input::get('regEmail_1'),
                            'regMem_E2' => Input::get('regEmail_2'),
                            'regMem_Pw' => Hash::make(Input::get('regPw'), $salt),
                            'regMem_Salt' => $salt,
                            'regMem_Account' => 'NA',
                            'regMem_TaC' => Input::get('regTerms'),
                            'regMem_Month' => date('M'),
                            'regMem_Day' => date('d'),
                            'regMem_Year' => date('Y'),
                            'regMem_Group' => 1,
                            ));

                        $this->getNewUserId = $user->lastId();
                        $memberBaseDir = '../public/assets/m3Mb3rz/';
                        $memberMediaDir = 'media/';
                        $memberImageDir = 'images/';
                        $memberImageDirBillboard = 'billboard/';
                        $memberImgaeDirThumbnail = 'thumbs/';
                        $memberMusicDir = 'music/';
                        $memberMusicProjects = 'projects/';
                        $memberMusicImageThumbnails = 'thumbs/';
                        $memberVideoDir = 'video/';
                        $newMemberPath = $memberBaseDir.$this->getNewUserId.'/';

                        if(file_exists($newMemberPath == TRUE)){
                            die('Member File Exist Already!');
                        }
                        else if(!file_exists($newMemberPath == TRUE)) {
                            $cleanOldMask = umask(0);

                            // create user folders with prefix salt & user id and partial special password
                            mkdir($newMemberPath, 0777, true);
                            mkdir($newMemberPath . $memberMediaDir, 0777, true);

                            // create images directory and sub-folders
                            mkdir($newMemberPath . $memberImageDir, 0777, true);
                            mkdir($newMemberPath . $memberImageDir . $memberImageDirBillboard , 0777, true);
                            mkdir($newMemberPath . $memberImageDir . $memberImgaeDirThumbnail , 0777, true);

                            // create music directory and sub-folders
                            mkdir($newMemberPath . $memberMediaDir . $memberMusicDir, 0777, true);
                            mkdir($newMemberPath . $memberMediaDir . $memberMusicDir . $memberMusicProjects , 0777, true);
                            mkdir($newMemberPath . $memberMediaDir . $memberMusicDir . $memberMusicProjects .  $memberMusicImageThumbnails , 0777, true);

                            // create video directory
                            mkdir($newMemberPath . $memberMediaDir . $memberVideoDir, 0777, true);

                            chown($newMemberPath, 0777);
                            umask($cleanOldMask);

                        }

                        $userDemoGraphics = new Userdemographics();

                        $userDemoGraphics->create(array(  // create user memberprofile in table
                            'id' => $this->getNewUserId,
                        ));

                        // send member activation email
                        $this->sendNewMemberEmail = new Emailer();
                        $this->sendNewMemberEmail->registerEmail($this->getNewUserId);

                        // send confirmation with user info in it
                        //$this->confirmation = new ConfirmMessages();
                        //$this->confirmation->getLastInsertedId($this->getNewUserId);

                        Redirect::to('/confirmMessages/index');

                    }catch(Exception $e){

                        // redirect to error page and log error
                        //Redirect::to('/error/index');
                        echo $e->getMessage(). "<br/>";
                        echo $e->getCode() . "<br/>";
                        echo $e->getFile() . "<br/>";
                        echo $e->getLine() . "<br/>";

                    }
                } else {
                    foreach ($validation->errors() as $error) {
                        echo $error, "<br>";
                    }
                }
            }
         }

    }

}