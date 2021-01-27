<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 2/20/17
 * Time: 1:30 AM
 */

namespace AppCMS\Controller;
use core\Config;
use core\Controller;
use core\View;
use appcms\controller\Userprofile;


class Cpanelleftmenu extends Controller
{
    public $userLoggedInCheck;

    public function __construct(){

        $userLoggedInCheck = new Userprofile();
        return $userLoggedInCheck;
    }

    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before(){}

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
        View::renderTemplate('layout/cpanelleftmenu.phtml', [
            'contactentries' => Config::APP_CMS_CONTACT_ENTRIES_PRETTY_URI,
            'fanstats' => Config::APP_CMS_VIRTUAL_MANAGER_FAN_STATS_PRETTY_URI,
            'trackstats' => Config::APP_CMS_VIRTUAL_MANAGER_TRACK_STATS_PRETTY_URI,
            'slideshow' => Config::APP_CMS_SLIDESHOW_PRETTY_URI,
            'controlboard'=> Config::APP_CMS_DELETE_MUSIC_PRETTY_URI,
            'soundeffects' => Config::APP_CMS_SOUND_EFFECTS_PRETTY_URI,
            'username' =>  'Test',
            'site_name' => Config::SITE_NAME,
        ],  'appcms/views');
    }

}