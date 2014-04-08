<?php
//this file is generated from the video at https://www.youtube.com/watch?v=JQkfAdZbAJE&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
//this file is included on every page so that the required classes are loaded in
session_start();

//create a global array of configuration settings
$GLOBALS['config'] = array(
	//database config
	'mysql'   => array(
		'host'     => 'mysql.stuartbrown.name',
		'username' => 'stuartbrown',
		'password' => 'm4nch3st3r',
		'db'       => 'photo_gallery_oop'
		),
	//so you can remember a user
	'remember'=> array(
		'cookie_name'   => 'hash',
		'cookie_expiry' => 604800
		),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token' //token info for token.php class. generated in hidden field in resgister.php 
		)

	);

//auto-load classes as required rather than add require_once a load of times
//whenever we initialise a new class ($db=new DB()) the class is passed to the $class argument of the below function and
//the relevant class.php file is included
//an anonymous function takes the argument $class
//spl stands for standard php library
spl_autoload_register(function($class){
	require_once '_/components/php/classes/' . $class . '.php';
});

require_once '_/components/php/functions/sanitize.php';

?>
