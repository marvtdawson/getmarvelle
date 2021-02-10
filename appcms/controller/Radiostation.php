<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/10/17
 * Time: 8:57 PM
 */

namespace appcms\controller;

use core\Controller;
use core\View;
use Core\Config;
use Library\Models\SiteKeyWordsModel;


class Radiostation extends Controller
{

    public $username,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords;

    public function __construct(){}

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

    public function indexAction()
    {
        View::renderTemplate('radiostation/index.phtml', [
            'tabtitle' => Config::APP_CMS_CONTROL_BOARD_INDEX_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_CONTROL_BOARD_INDEX_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'controlboard' => Config::APP_CMS_CONTROL_BOARD_PRETTY_URI,
            'soundeffects' => Config::APP_CMS_SOUND_EFFECTS_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ], 'appcms/views');
    }

    public function controlboardAction()
    {

        View::renderTemplate('radiostation/controlboard.phtml', [
            'tabtitle' => Config::APP_CMS_CONTROL_BOARD_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_CONTROL_BOARD_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Radio Station',
            'indexpage' => Config::APP_CMS_CONTROL_BOARD_PAGE_INDEX_PRETTY_URI,
            'controlboard' => Config::APP_CMS_CONTROL_BOARD_PRETTY_URI,
            'soundeffects' => Config::APP_CMS_SOUND_EFFECTS_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ], 'appcms/views');
    }

    public function soundeffectsAction()
    {
        View::renderTemplate('radiostation/soundeffects.phtml', [
            'tabtitle' => Config::APP_CMS_SOUND_EFFECTS_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_SOUND_EFFECTS_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Radio Station',
            'indexpage' => Config::APP_CMS_CONTROL_BOARD_PAGE_INDEX_PRETTY_URI,
            'controlboard' => Config::APP_CMS_CONTROL_BOARD_PRETTY_URI,
            'soundeffects' => Config::APP_CMS_SOUND_EFFECTS_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ], 'appcms/views');
    }

}