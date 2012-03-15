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


/**
 * OpenAPI Project Path
 */
define('PUB_MODE','IO');  //set the public mode  web/cli 
//set app path
define('APP_NAME','Api');
define('APP_PATH',dirname(__FILE__));
define('ACTION_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Actions');
define('TEMP_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Temp');
define('VIEW_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Views');
define('LANG_PATH',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Lang');

//buddy path
define('BUDDY_PATH',dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'buddy');

//这里需要改进
define('CONF_PATH',dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'Config/dev');

//load framework
require BUDDY_PATH.DIRECTORY_SEPARATOR.'Loader.php';
//设置URL_mode =0
C('url_mode',1);
//then run app instance
App::run();