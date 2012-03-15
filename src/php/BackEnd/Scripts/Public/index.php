<?php
// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet 
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2011 http://woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <xinqiyang@gmail.com>
// +----------------------------------------------------------------------

define('PUB_MODE','CLI');  //set the public mode  web/cli 
//set app path
define('APP_NAME','BackEnd');
define('APP_PATH',dirname(__FILE__));
define('ACTION_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Actions');
define('TEMP_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Temp');
//buddy path
define('BUDDY_PATH',dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'buddy');

//this is dev mode ,if you use the product mode then change the dev to product
define('CONF_PATH',dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'Config/dev');
//load framework
require BUDDY_PATH.DIRECTORY_SEPARATOR.'Loader.php';
//then run app instance
App::run();
