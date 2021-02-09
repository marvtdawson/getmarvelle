<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 2/20/17
 * Time: 6:01 AM
 */

namespace AppCMS\Controller;
use core\Config;
use core\Controller;
use core\View;
//use library\User\User;
//use library\Sessions\Sessions;
use library\Form\Input;
use PDOException;
//use library\Controller\Redirect;
use Library\Controller\Styles;
use Library\CSRF\CSRF;
use Library\Models\Model;
use Library\Models\SiteKeyWordsModel;

class Music extends Controller
{
    private $_db;

    public $username,
        $userId,
        $curruserInfo,
        $currUser,
        $validate,
        $userLogin,
        $fields,
        $media_type,
        $cdCoverFile,
        $cdCoverFileExt,
        $tempName,
        $origName,
        $trakFile,
        $musicFileExt,
        $checkImage,
        $checkTrak,
        $checkMusicType,
        $musicDir,
        $memberAssetsDir,
        $memberMediaDir,
        $memberMusicDir,
        $memberMusicProjects,
        $memberMusicThumbs,
        $artistProjects,
        $extension,
        $musicTracks = array(),
        $gallery,
        $path,
        $uploadOk = 1,
        $sessionName,
        $cookieName,
        $_tableName = 'regMem_Media',
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords;

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
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('music/index.phtml', [
            'tabtitle' => 'MusiQ',
            'pageTitle' => 'MusiQ',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'addcd' => CONFIG::APP_CMS_ADD_CD_PRETTY_URI,
            'addmusic' => CONFIG::APP_CMS_ADD_MUSIC_PRETTY_URI,
            'editmusic' => CONFIG::APP_CMS_EDIT_MUSIC_PRETTY_URI,
            'deletemusic' => CONFIG::APP_CMS_DELETE_MUSIC_PRETTY_URI,
            'contactentries' => Config::APP_CMS_CONTACT_ENTRIES_PRETTY_URI,
            'controlboard' => Config::APP_CMS_CONTROL_BOARD_PRETTY_URI,
            'soundeffects' => Config::APP_CMS_SOUND_EFFECTS_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

    public function addcdAction()
    {
        View::renderTemplate('music/addcd.phtml', [
            'tabtitle' => 'Add CD',
            'pageTitle' => 'Add CD',
            'siteName' => $this->siteName,
            'breadcrumb_index' => 'musiQ',
            'indexpage' => Config::APP_CMS_MUSIC_INDEX,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');

        // check if the input data via post or get method exist
        if(Input::exists()) {

            // get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

                    $this->memberAssetsDir = '../public/assets/m3Mb3rz/' . $this->userId . '/';
                    $this->memberMediaDir = 'media/';
                    $this->memberMusicDir = 'music/';
                    $this->memberMusicProjects = 'projects/';
                    $this->memberMusicThumbs = 'thumbs/';

                    $this->artistProjects = $this->memberAssetsDir .
                        $this->memberMediaDir .
                        $this->memberMusicDir .
                        $this->memberMusicProjects . '/';

                    $this->cdCoverFile = $this->memberAssetsDir .
                                         $this->memberMediaDir .
                                         $this->memberMusicDir .
                                         $this->memberMusicProjects .
                                         $this->memberMusicThumbs . basename($_FILES["uploadCdCover"]["name"]);

                    //echo 'This file will load to: ' . $this->cdCoverFile . '<br >';

                    $this->cdCoverFileExt = pathinfo($this->cdCoverFile, PATHINFO_EXTENSION);
                    //echo 'This file ext is: ' . $this->cdCoverFileExt . '<br >';

                    $this->checkImage = mime_content_type($_FILES["uploadCdCover"]["tmp_name"]);
                    //echo 'This image type is: ' . $this->checkImage . '<br >';

                    // 1. check if image being upload is the right formatted mime type / image
                    if( $this->checkImage !== 'image/jpeg' ||
                        $this->checkImage !== 'image/JPEG' ||
                        $this->checkImage !== 'image/png'){

                        // redirect or display modal
                        //echo "Wrong file type was attempted to upload<br>";
                        $this->uploadOk = 0;
                    }

                    // 2. check if file already exists
                    if (file_exists($this->cdCoverFile)) {
                        echo "Sorry, file already exists.<br>";
                        $this->uploadOk = 0;
                    }

                    // 3. file size
                    if ($_FILES["uploadCdCover"]["size"] > 500000) {
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

                        if (move_uploaded_file($_FILES["uploadCdCover"]["tmp_name"], $this->cdCoverFile)) {

                            $this->media_type = 'Audio';

                            // set vars for slide names
                            $this->tempName =  $_FILES["uploadCdCover"]["tmp_name"];
                            $this->origName =  $_FILES["uploadCdCover"]["name"];

                            try {
                                $this->_db->insert($this->_tableName, array(  // update user member profile in table
                                    'regMem_Id' => $this->userId,
                                    'media_type' => $this->media_type,
                                    'project_name' => Input::get('cdName'),
                                    'media_Tmp_Name' => $this->tempName,
                                    'media_Orig_Name' => $this->origName,
                                    'media_day' => date('M'),
                                    'media_month' => date('d'),
                                    'media_year' => date('Y'),
                                ));
                                //echo "The file ". basename( $_FILES["upload_slide_image"]["name"]). " has been uploaded.";
                                mkdir($this->artistProjects . Input::get('cdName'), 777);
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


    public function addtrackAction()
    {
        View::renderTemplate('music/addmusic.phtml', [
            'tabtitle' => 'Add musiQ',
            'pageTitle' => 'Add musiQ',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'processForm' => Config::APP_CMS_ADD_MUSIC_PRETTY_URI,
            'breadcrumb_index' => 'musiQ',
            'indexpage' => Config::APP_CMS_MUSIC_INDEX,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username,
            'styles' => Styles::styleType(),
        ],  'appcms/views');

        // check if the input data via post or get method exist
        if(Input::exists()) {

            // get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $this->memberAssetsDir = '../public/assets/m3Mb3rz/' . $this->userId . '/';
            $this->memberMediaDir = 'media/';
            $this->memberMusicDir = 'music/';
            $this->memberMusicProjects = 'projects/';
            $this->memberMusicThumbs = 'thumbs/';

            $this->artistProjects = $this->memberAssetsDir .
                $this->memberMediaDir .
                $this->memberMusicDir .
                $this->memberMusicProjects . '/';

            $this->trakFile = $this->memberAssetsDir .
                $this->memberMediaDir .
                $this->memberMusicDir .
                $this->memberMusicProjects . basename($_FILES["uploadTrak"]["name"]);

            //echo 'This file will load to: ' . $this->cdCoverFile . '<br >';

            $this->trakFileExt = pathinfo($this->trakFile, PATHINFO_EXTENSION);
            //echo 'This file ext is: ' . $this->cdCoverFileExt . '<br >';

            $this->checkTrak = mime_content_type($_FILES["uploadTrak"]["tmp_name"]);
            //echo 'This image type is: ' . $this->checkImage . '<br >';

            // 1. check if image being upload is the right formatted mime type / image
            if( $this->checkTrak !== 'audio/mp3' || $this->checkTrak !== 'audio/ogg'){

                // redirect or display modal
                //echo "Wrong file type was attempted to upload<br>";
                $this->uploadOk = 0;
            }

            // 2. check if file already exists
            if (file_exists($this->trakFile)) {
                echo "Sorry, file already exists.<br>";
                $this->uploadOk = 0;
            }

            // 3. file size
            if ($_FILES["uploadTrak"]["size"] > 500000) {
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

                if (move_uploaded_file($_FILES["uploadTrak"]["tmp_name"], $this->trakFile)) {

                    $this->media_type = 'Audio';

                    // set vars for slide names
                    $this->tempName =  $_FILES["uploadTrak"]["tmp_name"];
                    $this->origName =  $_FILES["uploadTrak"]["name"];

                    try {
                        $this->_db->insert($this->_tableName, array(  // update user member profile in table
                            'regMem_Id' => $this->userId,
                            'media_type' => $this->media_type,
                            'project_name' => Input::get('uploadTrak'),
                            'media_Tmp_Name' => $this->tempName,
                            'media_Orig_Name' => $this->origName,
                            'media_day' => date('M'),
                            'media_month' => date('d'),
                            'media_year' => date('Y'),
                        ));
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
        View::renderTemplate('music/editmusic.phtml', [
            'tabtitle' => 'Edit musiQ',
            'pageTitle' => 'Edit musiQ',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'MusiQ',
            'indexpage' => Config::APP_CMS_MUSIC_INDEX,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');

    }

    public function deleteAction()
    {
        View::renderTemplate('music/deletemusic.phtml', [
            'tabtitle' => 'Delete musiQ',
            'pageTitle' => 'Delete musiQ',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'musiQ',
            'indexpage' => Config::APP_CMS_MUSIC_INDEX,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }


}