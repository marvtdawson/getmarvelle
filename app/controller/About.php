<?php
namespace App\Controller;

use core\Controller;
use core\View;
use core\Config;
use library\Models\CorePagesModel;
use library\Models\SiteKeyWordsModel;

class About extends Controller
{
    public $display_page_content,
        $get_page_content,
        $core_page_number = 1115,
        $keyword_type = Config::CORE_PAGES_KEYWORDS,
        $getSiteKeywords,
        $siteName,
        $siteContent,
        $username,
        $userLogin;

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

    }

    /**
     * After filter which could potentially be good for destroying sessions etc
     *
     * @return void
     */
    protected function after(){}


    public function indexAction()
    {
        View::renderTemplate('about.phtml', [
            'tabTitle' => 'About',
            'pageTitle' => 'About',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'About Us',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
        ]);

    }

    public function sassAction()
    {
        View::renderTemplate('sass.phtml', [
            'tabTitle' => 'SASS',
            'pageTitle' => 'SASS',
            'siteName' => $this->siteName,
            'siteKeywords' => $this->siteKeywords,
            'pageDescription' => 'SASS',
            'username' =>  $this->username,
            'userLogin' => $this->userLogin,
            'pageContent' => $this->siteContent,
            'param_sum' => $this->xorBitwise(),
            'looping' => $this->looping(),
            'loopingArrays' => $this->loopingArrays(),
        ]);
    }

    function xorBitwise()
    {
        $param1 = 5;
        $param2 = 10;
        $sum = '';
        $sum = $param1 ^ $param2;
        return $sum;
    }

    public function looping()
    {
        $a = 455;
        $b = $a;

        for($b = 460; $b < $a; $b++){
            echo $b . '<br>';
        }

    }

    public function loopingArrays()
    {
        $first_names = array('a' => 'Marvin', 'b' => 'Tosha', 'c' => 'Princess', 'e'=>'Thomas');
        $last_names = array('a' => 'Marvin', 'b' => 'Tosha', 'c' => 'Princess', 'd' => 'Thomas');


       /* foreach($first_names as $value){
            echo $value . '<br>';
        }*/

       $result = array_intersect_assoc($first_names, $last_names);

        print_r($result);

    }

}