<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/23/17
 * Time: 8:10 AM
 */

namespace AppCMS\Controller;
use core\Config;
use core\Controller;
use core\View;
use Library\Models\SiteKeyWordsModel;
use library\Form\Input;
use Library\CSRF\CSRF;
use PDOException;
use Library\Models\Model;

class Gallery extends Controller
{
    private $_db;

    public $username,
        $userId,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords,
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
        $uploadOk = 1;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);

        // connect to db
        $this->_db = Model::getInstance();
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

    /**
     * Show the index page
     * @return void
     */
    public function indexAction()
    {
        //echo 'User index on User Page<br>';
        View::renderTemplate('gallery/index.phtml', [
            'tabtitle' => 'Gallery',
            'pageTitle' => 'Gallery',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'addgallery' => Config::APP_CMS_GALLERY_ADD_PAGE_PRETTY_URI,
            'editgallery' => Config::APP_CMS_GALLERY_EDIT_PAGE_PRETTY_URI,
            'deletegallery' => Config::APP_CMS_GALLERY_DELETE_PAGE_PRETTY_URI,
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');


    }

    /**
     * Show the index page
     * @return void
     */
    public function addgalleryAction()
    {
        //echo 'User index on User Page<br>';
        View::renderTemplate('gallery/addgallery.phtml', [
            'tabtitle' => 'Add Gallery',
            'pageTitle' => 'Add Gallery',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Gallery',
            'indexpage' => Config::APP_CMS_GALLERY_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');


    }

    /**
     * Show the index page
     * @return void
     */
    public function editgalleryAction()
    {
        //echo 'User index on User Page<br>';
        View::renderTemplate('gallery/editgallery.phtml', [
            'tabtitle' => 'Edit Gallery',
            'pageTitle' => 'Edit Gallery',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Gallery',
            'indexpage' => Config::APP_CMS_GALLERY_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');


    }

    /**
     * Show the index page
     * @return void
     */
    public function deletegalleryAction()
    {
        //echo 'User index on User Page<br>';
        View::renderTemplate('gallery/deletegallery.phtml', [
            'tabtitle' => 'Delete Gallery',
            'pageTitle' => 'Delete Gallery',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Gallery',
            'indexpage' => Config::APP_CMS_GALLERY_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');

    }

    public function addThumb()
    {
        // render view
        View::renderTemplate('/add.phtml', [
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

}