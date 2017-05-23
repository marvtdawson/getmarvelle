<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 4/5/17
 * Time: 11:47 PM
 */

namespace appcms\controller;
use core\Config;
use core\Controller;
use core\View;
use library\Models\SiteKeyWordsModel;
/*use library\User\User;
use Library\CSRF\CSRF;
use Library\Controller\United_States;
use library\Form\Validation;
use library\Form\Input;
use library\Controller\Redirect;
use Exception;*/


class Profile extends Controller
{
    public $regSuccess,
        $username,
        $userLogin,
        $userId,
        $currUser,
        $key,
        $memberPermissions,
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords,
        $getContactEntries,
        $entry,
        $formEntry,
        $billboard,
        $thumbProfile;



    public function __construct()
    {

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

        $this->billboard = '../../assets/m3Mb3rz/' . $this->userId . '/images/billboard/default.jpg';
        $this->thumbProfile = '../../assets/m3Mb3rz/' . $this->userId . '/images/thumbs/default.jpg';
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
        View::renderTemplate('memberprofile/index.phtml', [
            'tabTitle' => 'Member Profile',
            'pageTitle' => 'Member Profile',
            'pageDescription' => 'Member Profile Page',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'formName' => Config::REGISTER_FORM_NAME,
            'processform' => Config::REGISTER_FORM_PROCESS,
            'submitbutton' =>  Config::REGISTER_FORM_SUBMIT_BUTTON,
            'userReg' => $this->regSuccess,
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'billboard' => $this->billboard,
            'thumbProfile' => $this->thumbProfile
        ]);
    }


}