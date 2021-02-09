<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 12/1/16
 * Time: 2:13 PM
 */

namespace library\View;


class AbstractView
{

    public static function render($view)
    {

        $file =  "../../app/views/$view";  // relative to the Library directory

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
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if($twig === null)
        {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }



}