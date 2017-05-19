<?php
/**
 * Error and Exception handling
 */
error_reporting(E_ALL);// show all php errors
ini_set('display_errors', 'On'); // show mysql errors

session_start();

/**
 * Front controller
 *
 * PHP version 5.4
 */


require '../vendor/autoload.php';

require_once dirname(__DIR__) . '/vendor/twig/twig/lib/Twig/Autoloader.php';

/**
 * Autoloader
 */
spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});


/**
 * Routing
 */
$router = new core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/({id:\d+}{\w})/{action}');
$router->add('appcms/{controller}/{action}', ['appcms' => 'appcms']);

$router->dispatch($_SERVER['QUERY_STRING']);