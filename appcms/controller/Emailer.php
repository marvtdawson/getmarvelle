<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 3/22/17
 * Time: 8:18 PM
 */

namespace appcms\controller;

use core\Controller;
use library\User\User;
use Core\Config;
use Core\View;

class Emailer extends Controller
{

    public $userInfo,
        $userId,
        $userName,
        $userEmail;

    public function __construct()
    {
        //parent::__construct($route_params);

    }

    public function emailouts()
    {
        View::renderTemplate('emailers/emailouts.phtml', [
            'tabTitle' => 'Email Style Test Page',
            'pageTitle' => 'Email Style Test Page',
            'siteName' => $this->siteName,
            //'username' =>  $this->username,
        ]);

    }

    public function registerEmail($id){

        $this->userInfo = new User();
        $this->userInfo->find($id);

       $this->userId = $this->userInfo->data()->id;
       $this->userName = trim($this->userInfo->data()->regMem_Name);
       $this->userEmail = $this->userInfo->data()->regMem_E1;

        // Send Email Message
        // Email the user their activation link
        $to = $this->userEmail;
        $from = "auto_responder@".Config::SITE_DOMAIN;
        $subject = 'Welcome to ' . Config::SITE_NAME;

        // Add
        //include('../../appcms/views/emailers/registeredEmail.phtml');

       $message = '
<!DOCTYPE html>
<head>
</head>
<body>
<div style="background-color:#a9a9a9;  border: 3px groove #a9a9a9; border-radius:5px; box-shadow:2px 2px 2px #545454;">
    <div style="background-color: #000000; height:55px; color:#FFFFFF;">
        <div style="float:left;">
            <img src="http://www.homegrownmusiq.com/assets/images/logo.jpg" style="width:50px; height:50px;" >
        </div>
        <div style="float:left; margin-top:5px; margin-left:10px; color:#FFFFFF;">
            <h3 style="color:#FFFFFF;">Welcome To ' . Config::SITE_NAME . '</h3>
        </div>
    </div>
    <div style="padding:12px; font-size:17px;">
        Hello <span class="email-username-font">' .  $this->userName  . '</span>!!!!,<br /><br />

        Thank you for choosing ' . Config::SITE_NAME .  ' as you Extended Virtual Manager!!!<br /><br />

        Our goal is to help you increase productivity via direct communication.<br />

        Whether your goal is to:<br />

        <ul>
            <li>Increase turns on your commerical washers and dryers.</li>
            <li>Communicate to your tenants or customer directly.</li>
            <li>Market directly to existing customers.</li>
            <li>Gain new customers.</li>
            <li>Offer discounts and new incentives.</li>
            <li>Lower overall operation cost.</li>
        </ul>'

           . Config::SITE_NAME . ' has the tools you need to promote your brand, label, swag and musiQ.<br /><br />

        You can now log into ' . Config::SITE_NAME . ' after you have successfully completed the activation process using your:<br /><br />

        Registered email address: ' . $this->userEmail . ' <br />

        And your registered password.<br /><br />

        Please click on the activation link below to finish the registration.<br />

        <a href="http://' . Config::SITE_DOMAIN  . '/memberz/activation?mp=' . $this->userId . '&seq=' . $this->userName . '&ws=' . $this->userEmail . '">
            http://' . Config::SITE_DOMAIN  . '/memberz/activation?mp=' . $this->userId  .
           '&seq=' . $this->userName .
           '&ws=' . $this->userEmail . '
        </a><br />

        Thank you,<br /><br />

        TEAM ' . Config::SITE_NAME . '!!
    </div>
</div>   
</body>
</html>';

        $headers = "From: " . $from . "\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 . \n";
        mail($to, $subject, $message, $headers);

    }

    public function contactFormEmail($id){

        // Send Email Message
        // Email the user confirmation that there contact messages was saved
        $to = $this->userEmail;
        $from = "auto_responder@".Config::SITE_DOMAIN;
        $subject = 'Welcome to ' . Config::SITE_NAME;

        $message = '<!DOCTYPE html>
						<html>
						<head><meta charset="utf-8">
						</head>
						<body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">						
						<div style="padding:24px; font-size:17px;">
						<h3>Hi Friend,</h3>
                        Thank you for contacting' . Config::SITE_NAME . '<br /><br />
						
						Regarding your comment:<br /><br />
						
						<font color="#0000FF">' . $this->message . '</font><br /><br />						
						
						Someone from' .  Config::SITE_NAME  .  'will review your comment, and
						reply to you as soon as possible.<br /><br />
						
                        Please do not respond to this email, for this email address is not checked.<br /><br />
						
						Thanks again for contacting us.<br />																				
						</div>
						<div align="center">' . Config::SITE_NAME . ' &copy; { }</div>
						</body>
						</html>';
        // End HTML Message

        $headers = "From: " . $from . "\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 . \n";
        mail($to, $subject, $message, $headers);

    }

    public function loginAttemptsEmail($id, $email){

    }

    public function forgotPasswordEmail($id, $email){

    }

    public function resetPasswordEmail($id, $email){

    }


}