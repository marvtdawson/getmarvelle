<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 2/12/17
 * Time: 8:14 PM
 */

namespace App\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\Sessions\Sessions;

class SiteMessages extends Controller
{

    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before()
    {
        //echo "(before) ";
        //return false;
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
        View::renderTemplate('sitemessages.phtml', [
            'tabtitle' => 'Messages',
            'pagetitle' => 'Messages'
        ]);

        if(Sessions::exists('success')){
            echo Sessions::flash('success');
        }
    }

}