<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/9/16
 * Time: 1:29 AM
 */

namespace core;
use Library\Models\SiteKeyWordsModel;
use Library\Models\CorePagesModel;

abstract class Controller
{

    public $siteName,
        $userName,
        $siteKeywords,
        $core_page_number,
        $getPageContent,
        $pageType;

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }


    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name  Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            echo "Method $method not found in controller " . get_class($this);
        }
    }

    /**
     * get site name function
     */
    public function getSiteName(){

        $this->siteName = strtoupper(Config::SITE_NAME);
        return $this->siteName;
    }

    public function getKeyWords($pageType){

        $this->pageType = $pageType;

        $this->siteKeywords = new SiteKeyWordsModel();
        $this->siteKeywords->retrieveKeyWords($this->pageType);
        //$this->siteKeywords = "Testing keywords from inside the Controller";
        return $this->siteKeywords;
    }

    public function getPageContent($page_number){

        $this->getPageContent = new CorePagesModel();
        $this->getPageContent->find($page_number);
        $this->getPageContent->data()->corePages_Content;

        return $this->getPageContent;
    }

}