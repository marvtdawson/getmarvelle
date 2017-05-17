<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 5/13/17
 * Time: 12:29 PM
 */

namespace app\controller;

use core\Controller;
use core\View;
use core\Config;
use library\Models\CorePagesModel;
use library\Models\SiteKeyWordsModel;


class Profile extends Controller
{

    public $regSuccess,
        $display_page_content,
        $get_page_content,
        $core_page_number = 1115,
        $keyword_type = Config::CORE_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteName,
        $siteContent,
        $username,
        $userLogin,
        $billboard,
        $thumbProfile;

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

        /* $loggedInUserName = new Userprofile();
       $this->username = $loggedInUserName->getLoggedInUserInfo();*/

        $this->billboard = Config::MEMBER_PROFILE_BILLBOARD_IMAGE;
        $this->thumbProfile = Config::MEMBER_PROFILE_THUMB_PROFILE_IMAGE;

    }

    /**
     * After filter which could potentially be good for destroying sessions etc
     *
     * @return void
     */
    protected function after(){}


    public function indexAction()
    {
        View::renderTemplate('/memberprofiles/profile.phtml', [
            'tabTitle' => 'Member\'s Home',
            'pageTitle' => 'Member\'s Home',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'Member\'s Home',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
        ]);

    }

    public function artistbioAction()
    {
        View::renderTemplate('/memberprofiles/bio.phtml', [
            'tabTitle' => 'Members Bio',
            'pageTitle' => 'Members Bio',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'Members Bio',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
        ]);

    }

    public function artistmusicAction()
    {
        View::renderTemplate('/memberprofiles/music.phtml', [
            'tabTitle' => 'Members Music',
            'pageTitle' => 'Members Music',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'Members Music',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
        ]);

    }

    public function artistvideosAction()
    {
        View::renderTemplate('/memberprofiles/videos.phtml', [
            'tabTitle' => 'Members Video',
            'pageTitle' => 'Members Video',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'Members Video',
            'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
            'userReg' => $this->regSuccess,
            'username' =>  $this->username,
            //'userLogin' => $this->userLogin,
            'billboard' => $this->billboard,
            'thumbProfile' => $this->thumbProfile
        ]);

    }

}