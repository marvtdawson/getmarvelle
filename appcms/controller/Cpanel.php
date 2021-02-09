<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 1/21/17
 * Time: 12:39 AM
 */

namespace AppCMS\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\User\User;
use Library\Models\SiteKeyWordsModel;


class Cpanel extends Controller
{
    public $username,
        $userId,
        $currUser,
        $key,
        $memberPermissions,
        $userLogin,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords;

    public function __construct()
    {
        //parent::__construct($route_params);

        $this->currUser = new User();
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
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $memberPermKey = $this->currUser->data()->regMem_Group;

        /*$currKey = $this->currUser->hasPermission($memberPermKey);
         echo $memberPermKey;
         die();*/

        if($memberPermKey){
            switch ($memberPermKey){
                case 1:
                    $this->memberPermissions = 'member';
                    break;
                case 2:
                    $this->memberPermissions = 'indierep';
                    break;
                case 3:
                    $this->memberPermissions = 'deejay';
                    break;
                case 4:
                    $this->memberPermissions = 'admin';
                    break;
            }

        }

        View::renderTemplate('cpanel/index.phtml', [
            'tabtitle' => 'Member cPanel',
            'pagetitle' => 'Member cPanel',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'cmsmusicindex' => Config::APP_CMS_MUSIC_INDEX,
            'addcd' => Config::APP_CMS_ADD_CD_PRETTY_URI,
            'addmusic' => Config::APP_CMS_ADD_MUSIC_PRETTY_URI,
            'editmusic' => Config::APP_CMS_EDIT_MUSIC_PRETTY_URI,
            'deletemusic' => Config::APP_CMS_DELETE_MUSIC_PRETTY_URI,
            'videoindex' => Config::APP_CMS_VIDEO_INDEX_PRETTY_URI,
            'addvideo' => Config::APP_CMS_ADD_VIDEO_PRETTY_URI,
            'editvideo' => Config::APP_CMS_EDIT_VIDEO_PRETTY_URI,
            'deletevideo' => Config::APP_CMS_DELETE_VIDEO_PRETTY_URI,
            'contactentries' => Config::APP_CMS_CONTACT_ENTRIES_PRETTY_URI,
            'cmscontbrdindex' => Config::APP_CMS_CONTROL_BOARD_PAGE_INDEX_PRETTY_URI,
            'controlboard' => Config::APP_CMS_CONTROL_BOARD_PRETTY_URI,
            'soundeffects' => Config::APP_CMS_SOUND_EFFECTS_PRETTY_URI,
            'slideshowindex' => Config::APP_CMS_SLIDESHOW_INDEX_PAGE_PRETTY_URI,
            'slideshow' => Config::APP_CMS_SLIDESHOW_PRETTY_URI,
            'addslide' => Config::APP_CMS_ADD_SLIDE_PRETTY_URI,
            'editslide' => Config::APP_CMS_EDIT_SLIDE_PRETTY_URI,
            'deleteslide' => Config::APP_CMS_DELETE_SLIDE_PRETTY_URI,
            'themeindex' => Config::APP_CMS_THEME_INDEX_PRETTY_URI,
            'themefont' => Config::APP_CMS_THEME_EDIT_FONT_PRETTY_URI,
            'themepagebkgroundcolor' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PRETTY_URI,
            'themelayoutcolor' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_PRETTY_URI,
            'cmsvmindex' => Config::APP_CMS_VIRTUAL_MANAGER_INDEX_PRETTY_URI,
            'fanstats' => Config::APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PRETTY_URI,
            'trackstats' => Config::APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PRETTY_URI,
            'userprofileindex' => Config::APP_CMS_USER_INDEX_PAGE_URI,
            'editaddress' => Config::APP_CMS_USER_EDIT_ADDRESS_PRETTY_URI,
            'editemail' => Config::APP_CMS_USER_EDIT_EMAIL_PRETTY_URI,
            'editalternativeemail' => Config::APP_CMS_USER_EDIT_ALTERNATIVE_EMAIL_PRETTY_URI,
            'editphone' => Config::APP_CMS_USER_EDIT_PHONE_PRETTY_URI,
            'demographs' => Config::APP_CMS_USER_DEMOGRAPHS_PRETTY_URI,
            'profilenotifications' => Config::APP_CMS_SETTINGS_NOTIFICATIONS_PRETTY_URI,
            'corepageindex' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'corepages' => Config::APP_CMS_CORE_PAGES_PRETTY_URI,
            'editpages' => Config::APP_CMS_EDIT_CORE_PAGES_PRETTY_URI,
            'galleryindex' => Config::APP_CMS_GALLERY_INDEX_PAGE_PRETTY_URI,
            'addgallery' => Config::APP_CMS_GALLERY_ADD_PAGE_PRETTY_URI,
            'editgallery' => Config::APP_CMS_GALLERY_EDIT_PAGE_PRETTY_URI,
            'deletegallery' => Config::APP_CMS_GALLERY_DELETE_PAGE_PRETTY_URI,
            'socialsindex' => Config::APP_CMS_SOCIAL_MEDIA_INDEX_PAGE_PRETTY_URI,
            'addsocialmedia' => Config::APP_CMS_SOCIAL_MEDIA_ADD_PAGE_PRETTY_URI,
            'editsocialmedia' => Config::APP_CMS_SOCIAL_MEDIA_EDIT_PAGE_PRETTY_URI,
            'deletesocialmedia' => Config::APP_CMS_SOCIAL_MEDIA_DELETE_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'memberprofileindex' => '/appcms/profile/index',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'hasPermission' => $this->memberPermissions,
        ],  'appcms/views');

    }

}