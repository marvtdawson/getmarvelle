<?php
namespace App\Controller;
use core\Config;
use core\Controller;
use core\View;
use AppCMS\Controller\Userprofile;
use Library\Models\CorePagesModel;
use Library\Models\SiteKeyWordsModel;


class Services extends Controller 
{

    public $displaypagecontent,
        $username,
        $userLogin,
        $getpagecontent,
        $siteContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1116,
        $keyword_type = Config::CORE_PAGES_KEYWORDS;


    public function __construct(array $route_params)
    {
        parent::__construct($route_params);
    }

    /**
     * Before filter which is useful for login authentication
     * session control and cookies
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
     * After filter which could potentially be good for destroying sessions etc
     *
     * @return void
     */
    protected function after(){}


    public function indexAction()
    {
       View::renderTemplate('services.phtml', [
          'tabTitle' => 'Services',
           'pageTitle' => 'Services',
           'siteName' => $this->siteName,
           'username' =>  $this->username,
           'userLogin' => $this->userLogin,
           'pageContent' => $this->siteContent,
           'siteKeywords' => $this->siteKeywords,
        ]);

    }
}