<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/13/17
 * Time: 2:05 AM
 */

namespace AppCMS\Controller;

use Core\Config;
use core\Controller;
use core\View;
use library\Models\SiteKeyWordsModel;


class Settings extends Controller
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
        //echo 'User index on User Page<br>';

        View::renderTemplate('settings/index.phtml', [
            'tabtitle' => 'User Setting',
            'pageTitle' => 'User Setting',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function notificationsAction()
    {
        //echo 'User index on User Page<br>';

        View::renderTemplate('settings/notifications.phtml', [
            'tabtitle' => 'Notifications Setting',
            'pageTitle' => 'Notifications Setting',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function keywordsAction()
    {
        //echo 'User index on User Page<br>';

        View::renderTemplate('settings/keywords.phtml', [
            'tabtitle' => 'Keywords Setting',
            'pageTitle' => 'Keywords Setting',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function subscriberAction()
    {
        //echo 'User index on User Page<br>';

        View::renderTemplate('settings/subscriber.phtml', [
            'tabtitle' => 'Subscriber Setting',
            'pageTitle' => 'Subscriber Setting',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }

}