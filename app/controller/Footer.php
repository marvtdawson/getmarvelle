<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 2/25/17
 * Time: 1:35 PM
 */

namespace App\Controller;
use Core\Config;
use core\Controller;
use core\View;

class Footer extends Controller
{
    public static $site_name;
    public static $site_name_cms;

    /*public function __construct(){}*/

    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before(){}

    /**
     * After filter
     *
     * @return void
     */
    protected function after(){}


    public static function getFooterLinks(): string
    {
        self::$site_name = Config::SITE_NAME;
        self::$site_name_cms = Config::SITE_NAME_CMS;
        return self::$site_name;
    }

    public function indexAction()
    {
        //render variable values to Twig template variables
        View::renderTemplate('template/layout/footer.phtml', [
            'siteName' => Config::SITE_NAME,
            'siteNameCMS' => Config::SITE_NAME_CMS
        ]);
    }
}