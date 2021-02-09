<?php
/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/7/16
 * Time: 11:07 PM
 */

namespace App\Controller;
use core\Config;
use core\Controller;
use core\View;
use appcms\controller\Userprofile;
use Library\Models\CorePagesModel;
use Library\Models\SiteKeyWordsModel;

class Socials extends Controller {

    public $userLogin,
        $username,
        $getpagecontent,
        $siteContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1123,
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

        $loggedInUserName = new Userprofile();
        $this->username = $loggedInUserName->userName;
        $this->userLogin = $loggedInUserName->checkLoggedInUser();
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
       View::renderTemplate('socials.phtml', [
            'tabTitle' => 'Social Communities',
           'pageTitle' => 'Social Communities',
           'siteName' => $this->siteName,
           'username' =>  $this->username,
           'userLogin' => $this->userLogin,
           'pageContent' => $this->siteContent,
           'siteKeywords' => $this->siteKeywords,
        ]);
    }

}