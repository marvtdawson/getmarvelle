<?php
/**
 * Singleton pattern: this file is included on every page
 * Codecourse Tutorial video PHP OOP Login/Registration
 * video 4/23
 *
 */

// initiate application var
$site = "hgd";

// config settings
$GLOBALS['config'] = array(
	
	'mysql' => array(
		'host' => 'cpsrvd 11.48.1.2',
		'username' => 'wlAdmin',
		'password' => 'Simply@New1972',
		'db' => 'wlAdmin'
	),
	
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user'
	
	)	
);

// standard php library(spl) auto loader to include a group of php files at once
// without listing eaching file in a include, instead you can loop through
// the entire wl_Classes folder
spl_autoload_register(function($class){
	
	// require all classes in the class folder
	require_once('classes/' . $class . '.php');
	
});

// sanitize data
require_once('filtzers/sanityClean_Fields.php');


?>