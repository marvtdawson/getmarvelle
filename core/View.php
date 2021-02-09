<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/9/16
 * Time: 1:54 AM
 */

namespace core;
use library\Sessions\Sessions;
use core\Config;
use core\Router;

class View
{
    public function __construct()
    {
    }
    /**
     * @param $view
     * @param array $args
     * @param string $directory
     */
    public static function render($view, $args = [], $directory = 'app/views/')
    {
        extract($args, EXTR_SKIP);

        $file =  "../$directory/$view";  // relative to the Library directory

        if(is_readable($file))
        {
            require $file;
        }
        else
        {
            echo "$file not found";
        }
    }
    /**
     * Render a view template using Twig
     */
    public static function renderTemplate($template, $args = [], $directory = 'app/views/')
    {
        static $twig = null;
        if($twig === null)
        {
            $loader = new \Twig_Loader_Filesystem([
                dirname(__DIR__) . '/app/views',
                dirname(__DIR__) . '/appcms/views'
            ]);
            $twig = new \Twig_Environment($loader);
        }
        ob_start();
        echo $twig->render($template, $args);
    }
}