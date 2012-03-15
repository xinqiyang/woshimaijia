<?php
//add xhprof do performance test
//require '/home/xinqiyang/wwwroot/xhprof/xhprof_header.inc.php';
/**
 * Web Project Path
 */
define('PUB_MODE','WEB');  //set the public mode  web/cli 
//set app path
define('APP_NAME','Web');
define('APP_PATH',dirname(__FILE__));
define('ACTION_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Actions');
define('TEMP_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Temp');
define('VIEW_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Views');
define('LANG_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Lang');
//buddy path
define('BUDDY_PATH',dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'buddy');
//define('BUDDY_PATH',dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'Buddy');

//this is dev mode ,if you use the product mode then change the dev to product
define('CONF_PATH',dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'Config/dev');
//load framework
require BUDDY_PATH.DIRECTORY_SEPARATOR.'Loader.php';

//SET SESSION SERVER,if u not install redis then comment 
sessionServer(APP_NAME);

//then run app instance
App::run();
//debug_end('test');
//require '/home/xinqiyang/wwwroot/xhprof/xhprof_footer.inc.php';