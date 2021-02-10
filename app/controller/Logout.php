<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/10/16
 * Time: 11:56 PM
 */

namespace App\Controller;
use core\Controller;
use core\View;
//use library\User\User;
use library\Sessions\Sessions;
use library\Cookies\Cookies;
use Core\Config;
use Library\Models\CorePagesModel;
use Library\Models\SiteKeyWordsModel;

class Logout extends Controller
{
    private
        $_sessionName,
        $_cookieName;

    public $siteContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1132,
        $keyword_type = Config::CORE_PAGES_KEYWORDS;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);

        $this->_sessionName = Config::getLoggedInUserSessionName();
        $this->_cookieName = Config::COOKIE_HASH_NAME;

        Sessions::delete($this->_sessionName);
        Cookies::delete($this->_cookieName);

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

        View::renderTemplate('logout.phtml', [
            'tabTitle' => 'Logout',
            'pageTitle' => 'Logout',
            'siteName' => $this->siteName,
            'pageContent' => $this->siteContent,
            'siteKeywords' => $this->siteKeywords,
        ]);

        //$user = new User();
        //$user->logout();

    }


}