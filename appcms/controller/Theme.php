<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/10/17
 * Time: 6:58 PM
 */

namespace appcms\controller;
use Core\Controller;
use Core\Config;
use core\View;
use library\Form\Input;
use library\Theme\Sitetheme;
use library\User\User;
use Library\Models\Model;
use library\Form\Validation;
use library\Controller\Redirect;
use Exception;
use Library\Models\SiteKeyWordsModel;

class Theme extends Controller
{

    public $username,
        $curruserInfo,
        $validate,
        $userId,
        $fields,
        $siteStyles,
        $getSiteStyleInfo,
        $newHeadFootColor,
        $_tableName = 'syst3mTh3m3',
        $keyword_type = Config::CPANEL_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteKeywords;

    private $_db,
        $_data;

    public function __construct(){

        // connect to db
        $this->_db = Model::getInstance();

        $this->curruserInfo = new User();
        $this->userId =  $this->curruserInfo->data()->id;

        $this->validate = new Validation();

        $this->siteStyles = new Sitetheme();
        $this->siteStyles->find($this->userId);
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
    }

    /**
     * After filter which could potentially be good for destroying sessions
     *
     * @return void
     */
    protected function after(){}

    public function indexAction(){
        View::renderTemplate('Theme/index.phtml', [
            'tabtitle' => Config::APP_CMS_THEME_INDEX_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_THEME_INDEX_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'cPanel',
            'indexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'themefont' => Config::APP_CMS_THEME_EDIT_FONT_PRETTY_URI,
            'themepagebkgroundcolor' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PRETTY_URI,
            'themelayoutcolor' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');

    }

    public function editfont(){
        View::renderTemplate('Theme/editfont.phtml', [
            'tabtitle' => Config::APP_CMS_THEME_EDIT_FONT_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_THEME_EDIT_FONT_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Theme',
            'processForm' => Config::APP_CMS_THEME_EDIT_FONT_PROCESS,
            'formName' => Config::APP_CMS_THEME_EDIT_FONT_FORM_NAME,
            'submitButton' => Config::APP_CMS_THEME_EDIT_FONT_SUBMIT_BUTTON,
            'indexpage' => Config::APP_CMS_THEME_INDEX_PRETTY_URI,
            'themefont' => Config::APP_CMS_THEME_EDIT_FONT_PRETTY_URI,
            'themepagebkgroundcolor' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PRETTY_URI,
            'themelayoutcolor' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');
    }


    public function processfont(){
        echo 'Processing Font Style Now!';
    }

    public function layoutcolor(){
        View::renderTemplate('Theme/editlayout.phtml', [
            'tabtitle' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Theme',
            'processForm' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_PROCESS,
            'formName' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_FORM_NAME,
            'submitButton' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_SUBMIT_BUTTON,
            'indexpage' => Config::APP_CMS_THEME_INDEX_PRETTY_URI,
            'themefont' => Config::APP_CMS_THEME_EDIT_FONT_PRETTY_URI,
            'themepagebkgroundcolor' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PRETTY_URI,
            'themelayoutcolor' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username,
            'newheadfootColor' => $this->siteStyles->data()->newlayoutColor,
        ],  'appcms/views');
    }

    public function processlayoutcolor(){

        echo 'Processing Layout Color Now!';

        // update user data
        // check if the input data via post or get method exist
        if(Input::exists()) {

            // 2. get input field csrf_token and check if it exist
            //if(CSRF::check(Input::get('csrf_token'))) {

            $validation = $this->validate->check($_POST, array(
                'layout-color' => array(
                    'min' => 4,
                    'max' => 8,
                )
            ));

            if ($validation->passed()) {

                try {
                    $this->curruserInfo->update($this->_tableName, array(  // update user memberprofile in table
                        'newlayoutColor' => Input::get('layout-color'),
                        'currentlayoutColor' => Input::get('layout-color')
                    ));

                    Redirect::to(Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_PRETTY_URI);

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else { // loop thru each validation error that is return
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            //}
        }
    }

    public function pagebackground(){

        View::renderTemplate('Theme/editpagebackgroundcolor.phtml', [
            'tabtitle' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PAGE_TITLE,
            'pageTitle' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PAGE_TITLE,
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'breadcrumb_index' => 'Theme',
            'processForm' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PROCESS,
            'formName' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_FORM_NAME,
            'submitButton' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_SUBMIT_BUTTON,
            'indexpage' => Config::APP_CMS_THEME_INDEX_PRETTY_URI,
            'themefont' => Config::APP_CMS_THEME_EDIT_FONT_PRETTY_URI,
            'themepagebkgroundcolor' => Config::APP_CMS_THEME_EDIT_PAGE_BACKGROUND_COLOR_PRETTY_URI,
            'themelayoutcolor' => Config::APP_CMS_THEME_EDIT_LAYOUT_COLOR_PRETTY_URI,
            'cpanelindexpage' => Config::APP_CMS_CPANEL_INDEX_PRETTY_URI,
            'username' =>  $this->username
        ],  'appcms/views');

    }

    public function processpagebackground(){

        echo 'Processing Page Background Color Now!';

    }



}