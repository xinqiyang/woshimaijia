<?php
/**
 * MIS Project Path
 */
define('PUB_MODE','WEB');  //set the public mode  web/cli 
//set app path
define('APP_NAME','Mis');
define('APP_PATH',dirname(__FILE__));
define('ACTION_PATH',dirname(dirname(__FILE__)).'/Actions');
define('TEMP_PATH',dirname(dirname(__FILE__)).'/Temp');
define('VIEW_PATH',dirname(dirname(__FILE__)).'/Views');

//buddy path
define('BUDDY_PATH','/home/xinqiyang/wwwroot/buddy');
//define('BUDDY_PATH',dirname(dirname(dirname(dirname(__FILE__)))).'/Buddy');
//this is dev mode ,if you use the product mode then change the dev to product
define('CONF_PATH',dirname(dirname(dirname(dirname(__FILE__)))).'/Config/dev');
//load framework
require BUDDY_PATH.'/Loader.php';
//then run app instance
App::run();