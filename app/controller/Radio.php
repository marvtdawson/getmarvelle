<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 1/7/17
 * Time: 11:40 PM
 */

namespace App\Controller;
use core\Config;
use core\Controller;
use core\View;
use library\Models\CorePagesModel;
use library\Models\SiteKeyWordsModel;



class Radio extends Controller
{
    public $playerpage,
        $getpagecontent,
        $siteContent,
        $getSiteKeywords,
        $siteKeywords,
        $core_page_number = 1134,
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

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($this->core_page_number);
        $this->siteContent = $this->getPageContent->data()->corePages_Content;
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
        View::renderTemplate('hgmradio.phtml', [
            'tabTitle' => 'HGM Radio',
            'pageTitle' => 'Player',
            'playerpage' => $this->playerpage,
            'siteName' => $this->siteName,
            'pageContent' => $this->siteContent,
            'siteKeywords' => $this->siteKeywords,
        ]);
    }
}