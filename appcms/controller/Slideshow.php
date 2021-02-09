<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 2/26/17
 * Time: 1:48 PM
 */

namespace AppCMS\Controller;
use core\View;
use core\Controller;
use core\Config;
use library\Form\Validation;
use library\Form\Input;
use Exception;
use library\Gallery\GalleryAbstract;
use library\User\User;
use library\Models\Model;
use PDOException;
use Library\CSRF\CSRF;
use library\Models\SiteKeyWordsModel;

class Slideshow extends Controller
{

    private $_db;

    public $user,
        $username,
        $curruserInfo,
        $currUser,
        $validate,
        $userId,
        $userLogin,
        $slideTempName,
        $slideOrigName,
        $fields,
        $slide_dir,
        $slideFile,
        $slideFileExt,
        $checkImage,
        $slideImagesPath,
        $extension,
        $slideImages = array(),
        $gallery,
        $path,
        $uploadOk = 1,
        $sessionName,
        $cookieName,
        $_tableName = 'syst3mSlid3sz',
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords;

    public function __construct()
    {
        //parent::__construct($route_params);

        // connect to db
        $this->_db = Model::getInstance();

        $this->curruserInfo = new User();
        $this->userId =  $this->curruserInfo->data()->id;

        $this->validate = new Validation();

        $this->sessionName = Config::getLoggedInUserSessionName();
        $this->cookieName = Config::COOKIE_HASH_NAME;

        $this->gallery = new GalleryAbstract();
        $this->gallery->setPath($this->slideImagesPath);

      /* if(!$this->user){
            if(Sessions::exists($this->sessionName)){
                $user = Sessions::get($this->sessionName);

                // get user data
                if($this->curruserInfo->find($user)){
                    $this->_isLoggedIn = true;
                }else{
                    // process and redirect to logout
                }
            }else{
                $this->curruserInfo->find($this->user);
            }
        }*/
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

    /**
     * @param array $fields
     * @throws Exception
     * create user account
     */
    public function create($fields = array()){
        if(!$this->_db->insert($this->_tableName, $fields)){
            throw new Exception('There was a problem creating a new account.');
        }
    }

    public function update($tableName, $fields = array(), $id =  null)
    {
        if(!$id && $this->curruserInfo->isLoggedIn()){
            $id = $this->curruserInfo->data()->id;
        }

        if(!$this->_db->update($tableName, $id, $fields)){
            throw new Exception('There was a problem updating your account.');
        }
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('slideshow/index.phtml', [
            'tabTitle' => Config::APP_CMS_SLIDESHOW_PAGE_TITLE,
            'pageTitle' => 'Slide Home',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'slideshow' => Config::APP_CMS_SLIDESHOW_PRETTY_URI,
            'processaddimageform' => Config::APP_CMS_SLIDESHOW_PROCESS,
            'slideshowForm_Submit' => Config::APP_CMS_SLIDESHOW_SUBMIT_BUTTON,
            'breadcrumb_index' => 'Slideshow',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'addslide' => Config::APP_CMS_ADD_SLIDE_PRETTY_URI,
            'editslide' => Config::APP_CMS_EDIT_SLIDE_PRETTY_URI,
            'deleteslide' => Config::APP_CMS_DELETE_SLIDE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
        ],  'appcms/views');
    }

    public function addAction()
    {
        // render view
        View::renderTemplate('slideshow/add.phtml', [
            'tabTitle' => Config::APP_CMS_SLIDESHOW_PAGE_TITLE,
            'pageTitle' => 'Add Slide',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'csrftoken' => CSRF::generatetoken(),
            'slideshow' => Config::APP_CMS_SLIDESHOW_PRETTY_URI,
            'processaddimageform' => Config::APP_CMS_ADD_SLIDE_PRETTY_URI,
            'slideshowForm_Submit' => Config::APP_CMS_SLIDESHOW_SUBMIT_BUTTON,
            'breadcrumb_index' => 'Slideshow',
            'indexpage' => Config::APP_CMS_SLIDESHOW_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' => $this->username
        ], 'appcms/views');

        // add slide
        // update user data
        // check if the input data via post or get method existt
        if(Input::exists()) {

            // get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

                $this->slide_dir =  '../public/assets/images/slideshow/';

                $this->slideFile = $this->slide_dir . basename($_FILES["upload_slide_image"]["name"]);
                //echo $this->slideFile . '<br >';

                $this->slideFileExt = pathinfo($this->slideFile, PATHINFO_EXTENSION);
                //echo 'This file ext is: ' . $this->slideFileExt . '<br >';

                $this->checkImage = mime_content_type($_FILES["upload_slide_image"]["tmp_name"]);
                //echo 'This image type is: ' . $this->checkImage . '<br >';

                // 1. check if image being upload is the right formatted mime type / image
                if($this->checkImage !== 'image/jpg' ||
                    $this->checkImage !== 'image/jpeg' ||
                    $this->checkImage !== 'image/JPEG' ||
                    $this->checkImage !== 'image/png' ||
                    $this->checkImage !== 'image/gif'){
                    // redirect or display modal
                    //echo "Wrong file type was attempted to upload<br>";
                    $this->uploadOk = 0;
                }

                // 2. check if file already exists
                if (file_exists($this->slideFile)) {
                    echo "Sorry, file already exists.<br>";
                    $this->uploadOk = 0;
                }

                // 3. file size
                if ($_FILES["upload_slide_image"]["size"] > 500000) {
                    echo "Sorry, your file is too large.<br>";
                    $this->uploadOk = 0;
                }

                // 4. check file extension
              /*if($this->slideFileExt){
                  if($this->slideFileExt !== 'jpg'){
                      echo 'This is not a jpg. <br>';
                  }
                  if($this->slideFileExt !== 'jpeg'){
                      echo 'This is not a jpeg. <br>';
                  }
                  if($this->slideFileExt !== 'JPEG'){
                      echo 'This is not a JPEG. <br>';
                  }
                  if($this->slideFileExt !== 'png'){
                      echo 'This is not a PNG. <br>';
                  }
                  if($this->slideFileExt !== 'gif'){
                      echo 'This is not a GiF. <br>';
                  }
                }*/

                // 5. move file to upload
                if($this->uploadOk === 1){
                    echo "Sorry, your file was not uploaded.";
                }elseif($this->uploadOk === 0){

                    if (move_uploaded_file($_FILES["upload_slide_image"]["tmp_name"], $this->slideFile)) {

                        // set vars for slide names
                        $this->slideTempName =  $_FILES["upload_slide_image"]["tmp_name"];
                        $this->slideOrigName =  $_FILES["upload_slide_image"]["name"];

                        try {
                            $this->_db->insert('syst3mSlid3sz', array(  // update user memberprofile in table
                                'hgm_Member_Id' => $this->userId,
                                'slide_Tmp_Name' => $this->slideTempName,
                                'slide_Orig_Name' => $this->slideOrigName,
                                'slide_Date' => date('M d, Y'),
                            ));
                            //echo "The file ". basename( $_FILES["upload_slide_image"]["name"]). " has been uploaded.";
                        }
                        catch (PDOException $e) {
                            die($e->getMessage());
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            //} // csrf token exists
        }
    }

    public function editAction()
    {
        $images = $this->gallery->getImages(array('jpg', 'png'));

        View::renderTemplate('slideshow/edit.phtml', [
            'tabTitle' => Config::APP_CMS_SLIDESHOW_PAGE_TITLE,
            'pageTitle' => 'Edit Slide',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'slideshow' => Config::APP_CMS_SLIDESHOW_PRETTY_URI,
            'processaddimageform' => Config::APP_CMS_SLIDESHOW_PROCESS,
            'slideshowForm_Submit' => Config::APP_CMS_SLIDESHOW_SUBMIT_BUTTON,
            'breadcrumb_index' => 'Slideshow',
            'indexpage' => Config::APP_CMS_SLIDESHOW_INDEX_PAGE_PRETTY_URI,
            'addslide' => Config::APP_CMS_ADD_SLIDE_PRETTY_URI,
            'editslide' => Config::APP_CMS_EDIT_SLIDE_PRETTY_URI,
            'deleteslide' => Config::APP_CMS_DELETE_SLIDE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'slideImages' => $images,
        ],  'appcms/views');

        //echo '<pre>', print_r($images), '</pre>';
    }

    public function deleteAction()
    {
        View::renderTemplate('slideshow/delete.phtml', [
            'tabTitle' => Config::APP_CMS_SLIDESHOW_PAGE_TITLE,
            'pageTitle' => 'Delete Slide',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'slideshow' => Config::APP_CMS_SLIDESHOW_PRETTY_URI,
            'processaddimageform' => Config::APP_CMS_SLIDESHOW_PROCESS,
            'slideshowForm_Submit' => Config::APP_CMS_SLIDESHOW_SUBMIT_BUTTON,
            'breadcrumb_index' => 'Slideshow',
            'indexpage' => Config::APP_CMS_SLIDESHOW_INDEX_PAGE_PRETTY_URI,
            'addslide' => Config::APP_CMS_ADD_SLIDE_PRETTY_URI,
            'editslide' => Config::APP_CMS_EDIT_SLIDE_PRETTY_URI,
            'deleteslide' => Config::APP_CMS_DELETE_SLIDE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');

    }




}