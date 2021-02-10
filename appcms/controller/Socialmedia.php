<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/23/17
 * Time: 8:11 AM
 */

namespace appcms\controller;
use core\Config;
use core\Controller;
use core\View;
use library\User\User;
use library\Sessions\Sessions;
use library\Controller\Redirect;
use Library\Models\SiteKeyWordsModel;

class Socialmedia extends Controller
{

    public $username,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);
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
        View::renderTemplate('socialmedia/index.phtml', [
            'tabtitle' => 'Social Media',
            'pageTitle' => 'Social Media',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'addsocialmedia' => Config::APP_CMS_SOCIAL_MEDIA_ADD_PAGE_PRETTY_URI,
            'editsocialmedia' => Config::APP_CMS_SOCIAL_MEDIA_EDIT_PAGE_PRETTY_URI,
            'deletesocialmedia' => Config::APP_CMS_SOCIAL_MEDIA_DELETE_PAGE_PRETTY_URI,
            'deletemusic' => CONFIG::APP_CMS_DELETE_MUSIC_PRETTY_URI,
            'contactentries' => Config::APP_CMS_CONTACT_ENTRIES_PRETTY_URI,
            'controlboard' => Config::APP_CMS_CONTROL_BOARD_PRETTY_URI,
            'soundeffects' => Config::APP_CMS_SOUND_EFFECTS_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }


    public function addsocialmediaAction()
    {
        View::renderTemplate('socialmedia/addsocialmedia.phtml', [
            'tabtitle' => 'Add Social Media',
            'pageTitle' => 'Add Social Media',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Social Media',
            'indexpage' => Config::APP_CMS_SOCIAL_MEDIA_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

    public function editsocialmediaAction()
    {
        View::renderTemplate('socialmedia/editsocialmedia.phtml', [
            'tabtitle' => 'Edit Social Media',
            'pageTitle' => 'Edit Social Media',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Social Media',
            'indexpage' => Config::APP_CMS_SOCIAL_MEDIA_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');

    }

    public function deletesocialmediaAction()
    {
        View::renderTemplate('socialmedia/deletesocialmedia.phtml', [
            'tabtitle' => 'Delete Social Media',
            'pageTitle' => 'Delete Social Media',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Social Media',
            'indexpage' => Config::APP_CMS_SOCIAL_MEDIA_INDEX_PAGE_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

}