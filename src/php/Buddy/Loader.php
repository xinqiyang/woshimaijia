<?php
/**
 * Buddy Loader 
 * Load all scripts of Buddy
 */
if (!defined('APP_NAME')) {
    //define app root
    define('APP_NAME', basename(dirname($_SERVER['SCRIPT_FILENAME'])));
}

//load basic functions
require BUDDY_PATH . '/Functions.php';

//define API path
define("API_PATH", dirname(BUDDY_PATH).'/API/');

//load configuration for app
if (is_file(CONF_PATH . '/load.conf.php')) {
    C(include CONF_PATH . '/load.conf.php');
} else {
	throw new Exception("Load configuratin file error,please check!",0);
    //exit('Load configuratin file error,please check!\n');
}

//load core class
$list = include BUDDY_PATH . '/Core.php';
foreach ($list as $key => $file) {
    require_cache($file);
}
