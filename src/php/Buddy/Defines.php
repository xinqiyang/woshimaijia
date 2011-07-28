<?php

if(version_compare(PHP_VERSION, '6.0.0','<'))
{
	@set_magic_quotes_runtime(0);
	define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc()?true:false);
}

define('MEMORY_LIMIT_ON', function_exists('memory_get_usage'));
define('IS_CGI', substr(PHP_SAPI, 0,3)=='cgi'?1:0);
define('IS_WIN', strstr(PHP_OS, 'WIN')?1:0);
define('IS_CLI', PHP_SAPI =='cli'?1:0);

date_default_timezone_set('PRC');
/**
 * get the start memory usage
 */
if(MEMORY_LIMIT_ON)
{
	$GLOBALS['_startUseMems'] = memory_get_usage();
}

if(!IS_CLI) {
    if(!defined('_PHP_FILE_')) {
        if(IS_CGI) {
            $_temp  = explode('.php',$_SERVER["PHP_SELF"]);
            define('_PHP_FILE_',  rtrim(str_replace($_SERVER["HTTP_HOST"],'',$_temp[0].'.php'),'/'));
        }else {
            define('_PHP_FILE_',    rtrim($_SERVER["SCRIPT_NAME"],'/'));
        }
    }
    if(!defined('__ROOT__')) {
        if( strtoupper(APP_NAME) == strtoupper(basename(dirname(_PHP_FILE_))) ) {
            $_root = dirname(dirname(_PHP_FILE_));
        }else {
            $_root = dirname(_PHP_FILE_);
        }
        
        define('__ROOT__',   (($_root=='/' || $_root=='\\')?'':$_root));
    }
}
