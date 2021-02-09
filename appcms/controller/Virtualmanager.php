<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/10/17
 * Time: 8:19 PM
 */

namespace AppCMS\controller;

use Core\Config;
use core\View;
use core\Controller;
use library\Models\SiteKeyWordsModel;


class Virtualmanager extends Controller
{

    public $username,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords;

    public function __construct(){
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

    public function indexAction(){
        View::renderTemplate('virtualmanager/index.phtml', [
            'tabtitle' => Config::APP_CMS_VIRTUAL_MANAGER_INDEX_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_VIRTUAL_MANAGER_INDEX_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'fanstats' => Config::APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PRETTY_URI,
            'trackstats' => Config::APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

    public function fanstats(){

        View::renderTemplate('virtualmanager/fanstats.phtml', [
            'tabtitle' => Config::APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'processForm' => Config::APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PROCESS,
            'formName' => Config::APP_CMS_VIRTUAL_MANAGER_FAN_STATS_FORM_NAME,
            'breadcrumb_index' => 'Virtual Manager',
            'indexpage' => Config::APP_CMS_VIRTUAL_MANAGER_INDEX_PRETTY_URI,
            'fanstats' => Config::APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PRETTY_URI,
            'trackstats' => Config::APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

    public function trackstats(){

        View::renderTemplate('virtualmanager/trackstats.phtml', [
            'tabtitle' => Config::APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'processForm' => Config::APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PROCESS,
            'formName' => Config::APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_FORM_NAME,
            'breadcrumb_index' => 'Virtual Manager',
            'indexpage' => Config::APP_CMS_VIRTUAL_MANAGER_INDEX_PRETTY_URI,
            'fanstats' => Config::APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PRETTY_URI,
            'trackstats' => Config::APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

}