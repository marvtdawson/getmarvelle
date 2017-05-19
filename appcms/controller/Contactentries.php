<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 1/23/17
 * Time: 12:57 AM
 */

namespace AppCMS\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\Models\ContactModel;
//use appcms\controller\Userprofile;
use library\Models\SiteKeyWordsModel;


class Contactentries extends Controller
{
    public $connect2Model,
        $username,
        $userId,
        $userLogin,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords,
        $siteName,
        $siteContent,
        $getContactEntries,
        $entry = 1,
        $formEntry;

    public static $entries;


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

        $this->getContactEntries = new ContactModel();
        $this->getContactEntries->find();
        $this->formEntry = $this->getContactEntries->data();

        echo $this->formEntry;

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
        View::renderTemplate('contact/index.phtml', [
            'tabtitle' => 'Contact Form Entries',
            'pageTitle' => 'Contact Form Entries',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'contactMessages' => $this->formEntry,
            'contactentries' => Config::APP_CMS_CONTACT_ENTRIES_PRETTY_URI,
            'controlboard' => Config::APP_CMS_CONTROL_BOARD_PRETTY_URI,
            'soundeffects' => Config::APP_CMS_SOUND_EFFECTS_PRETTY_URI,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username,
            //'contactName' => $this->formEntry,
        ],  'appcms/views');


    }

    public function getAllEntries(){}

}