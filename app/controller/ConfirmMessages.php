<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/18/17
 * Time: 2:48 PM
 */

namespace app\controller;
use core\Config;
//use library\Sessions\Sessions;
use core\Controller;
use core\View;
use library\User\User;

class ConfirmMessages extends Controller
{
    public $id,
        $userId,
        $userInfo,
        $userName,
        $userEmail,
        $getNewUserId,
        $returnUserInfo = array();

    public function __construct()
    {

    }

    /**
     * Before filter which is useful for login authentication
     * session control and cookies
     *
     * @return void
     */
    protected function before(){}

    /**
     * After filter which could potentially be good for destroying sessions etc
     *
     * @return void
     */
    protected function after(){}

    public function getLastInsertedId($id)
    {
        $this->userInfo = new User();
        $this->userInfo->find($id);

        $this->returnUserInfo = array(
            $this->userId => $this->userInfo->data()->id,
            $this->userName => $this->userInfo->data()->regMem_Name,
            $this->userEmail => $this->userInfo->data()->regMem_E1
        );

        return $this->returnUserInfo;

    }


    public function indexAction()
    {
        View::renderTemplate('confirms/confirm_message.phtml', [
            'tabtitle' => 'Confirmation',
            'pagetitle' => 'Confirmation',
            'confirmationType' => 'Registration',
            'siteName' => Config::SITE_NAME,
        ]);

    }

    public function contactAction()
    {
        View::renderTemplate('confirms/contact_messages.phtml', [
            'tabtitle' => 'Confirmation',
            'pagetitle' => 'Confirmation',
            'confirmationType' => 'Registration',
            'siteName' => Config::SITE_NAME,
        ]);

    }

    public function memberNotFound()
    {
        View::renderTemplate('confirms/memberNotFound.phtml', [
            'tabtitle' => 'Member Account',
            'pagetitle' => 'Member Account',
            'confirmationType' => 'Account Status',
            'siteName' => Config::SITE_NAME,
        ]);

    }
    public function activationIncomplete(){
        View::renderTemplate('confirms/activation_confirm_message.phtml', [
            'tabtitle' => 'Account Status',
            'pagetitle' => 'Activation Process Incomplete',
            'confirmationType' => 'Account Status',
            'siteName' => Config::SITE_NAME,
        ]);


    }

}