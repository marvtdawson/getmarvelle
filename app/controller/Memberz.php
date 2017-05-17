<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 4/20/17
 * Time: 7:32 PM
 */

namespace App\Controller;
use core\Controller;
use Core\Config;
use library\User\User;
use library\Controller\Redirect;
use Exception; use core\View; use library\Models\SiteKeyWordsModel;

class Memberz extends Controller
{

    public $mp,
        $seq,
        $ws,
        $user,
        $userId,
        $userEmail,
        $artistName,
        $artistBioContent,
        $artistMusic,
        $artistVideo,
        $artistTwitterWidget,
        $hipHopNews,
        $getMemberActivationStatus,
        $getSiteKeywords,
        $keyword_type = Config::CORE_PAGES_KEYWORDS;

    public function __construct(array $route_params)
    {
        parent::__construct($route_params);
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
    }

    /**
     * After filter which could potentially be good for destroying sessions
     *
     * @return void
     */
    protected function after(){}

    /**
     *
     */
    public function activationAction(){

        $this->mp = $_GET['mp']; // id
        $this->seq = $_GET['seq']; // name
        $this->ws = $_GET['ws']; // email

        // check if info from uri coming is set
        if(!isset($this->mp) && !isset($this->seq) && !isset($this->ws)){

            //echo 'Missing Some Much Needed Info Is Missing to Complete the Registration Activation<br>';
        }

        // make sure if info coming in from uri is not empty
        if(empty($this->mp) && empty($this->seq) && empty($this->ws)){

            //echo 'Missing Some Values are Empty and or Missing to Complete the Registration Activation<br>';
        }

        // make sure if info coming in from uri is not empty
        if(!empty($this->mp) && !empty($this->seq) && !empty($this->ws)){

            $this->user = new User();
            $this->user->find($this->mp);

            $this->userId =  $this->user->data()->id;
            $this->userName = htmlspecialchars($this->user->data()->regMem_Name);
            $this->userEmail = $this->user->data()->regMem_E1;

            if(($this->userId !== $this->mp) && ($this->userEmail !== $this->ws) && ($this->userName !== $this->seq))
            {
                 // redirect to confirmation of fail activation
                //die('Something went wrong with info in the URI');
            }
            elseif(($this->userId === $this->mp) && ($this->userEmail === $this->ws) && ($this->userName === $this->seq))
            {
                $this->getMemberActivationStatus = $this->user->data()->regMem_Account;;

                // check if account has been set to active
                if($this->getMemberActivationStatus === 'A') {

                    Redirect::to(Config::SUBSCRIBE_FORM_PRETTY_URI);

                }else if($this->getMemberActivationStatus !== 'A'){
                    try{
                        $this->user->update('r3gM3mb3rs', array(  // update user member profile in table
                            'regMem_Account' => 'A',
                        ), $this->userId);

                        // redirect to login page
                        Redirect::to(Config::LOGIN_FORM_PRETTY_URI);

                    }catch(Exception $e){
                        // redirect to error page and log error
                        //Redirect::to('/error/index');
                        echo $e->getMessage(). "<br/>";
                        echo $e->getCode() . "<br/>";
                        echo $e->getFile() . "<br/>";
                        echo $e->getLine() . "<br/>";

                    }
                }

            }
        }
    }

    public function indexAction()
    {
        View::renderTemplate('/memberprofiles/index.phtml', [
            'tabTitle' => 'Search Members',
            'pageTitle' => 'Search Members',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'Search Member',
            'artistName' =>  $this->artistName,
            'artistMusic' => $this->artistMusic,
            'artistVideo' => $this->artistVideo,
            'artistBio' => $this->artistBioContent,
            'artistTwitterWidget' => '$this->artistTwitterWidget',
            'hipHopNews' => '$this->hipHopNews',
            'blog' => '/blog/index',
            'vlog' => '/vlog/index',
        ]);

    }

    public function profilesAction()
    {
        View::renderTemplate('/memberprofiles/profile.phtml', [
            'tabTitle' => 'Member\'s Page',
            'pageTitle' => 'Member\'s Page',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'Member\'s Page',
            /*'artistName' =>  $this->artistName,
            'artistMusic' => $this->artistMusic,
            '$artistVideo' => $this->artistVideo,
            'artistBio' => $this->artistBioContent,
            'artistTwitterWidget' => '$this->artistTwitterWidget',*/
        ]);

    }
}