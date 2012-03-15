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

return array(
	'debug'=>true, //online please close
	'url_mode'=>2,  // 1 compact  2,rewrite
	'autoload_reg'=> true,
	'app_autoload_path'=>BUDDY_PATH.','.BUDDY_PATH.DIRECTORY_SEPARATOR.'Vender,',
	
	'default_timezone'=>'PRC',

	'default_theme'=>'default',
	'default_lang'=>'zh-cn',

	'COOKIE_EXPIRE'         => 2592000, // set 1 month
    'COOKIE_DOMAIN'         => '.woshimaijia.com',
    'COOKIE_PATH'           => '/',
    'COOKIE_PREFIX'         => 'bd_',
	'COOKIE_LIST_COUNT'           => 100,     //list length,set 100 ok

	'SESSION_AUTO_START'    => true,    // 是否自动开启Session
    // 内置SESSION类可用参数
    'SESSION_NAME'          => '',
    'SESSION_PATH'          => '', 
    'SESSION_CALLBACK'      => '', 

    'TOKEN_ON'              => true,
    'TOKEN_NAME'            => '__hash__', 
    'TOKEN_TYPE'            => 'md5',

	//pathinfo set
	'URL_PATHINFO_MODEL'    => 2,      
    'URL_PATHINFO_DEPR'     => '/',	
    'URL_HTML_SUFFIX'       => '',  
    
	'var_pathinfo'=>'s',
	'url_html_suffix'=>'.html',
	'web_route_rules'=>array(
		array('/^blog\/(\d+)$/','Blog','read','id'),
		array('/^people\/(\w+)$/','People','people','name'),
	),
	
	'var_ajax_submit'       => 'ajax',  // 默认的AJAX提交变量
	'default_ajax_return'   => 'JSON',
	
	//template set
    'TMPL_TEMPLATE_SUFFIX'  => '.html',     // 默认模板文件后缀
    //'TMPL_CONTENT_TYPE'     => 'text/html', // 默认模板输出类型
    'TMPL_CACHFILE_SUFFIX'  => '.php',      // 默认模板缓存后缀
    'TMPL_DENY_FUNC_LIST'	=> 'echo,exit',	// 模板引擎禁用函数
    //'TMPL_PARSE_STRING'     => '',          // 模板引擎要自动替换的字符串，必须是数组形式。
    'TMPL_L_DELIM'          => '{',			// 模板引擎普通标签开始标记
    'TMPL_R_DELIM'          => '}',			// 模板引擎普通标签结束标记
    'TMPL_VAR_IDENTIFY'     => 'array',     // 模板变量识别。留空自动判断,参数为'obj'则表示对象
    'TMPL_STRIP_SPACE'      => true,       // set true
    'TMPL_CACHE_ON'			=> true,        // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_CACHE_TIME'		=>	-1,         // 模板缓存有效期 -1 为永久，(以数字为值，单位:秒)
    //'TMPL_ACTION_ERROR'     => 'Public:success', // 默认错误跳转对应的模板文件
    //'TMPL_ACTION_SUCCESS'   => 'Public:success', // 默认成功跳转对应的模板文件
    //'TMPL_FILE_DEPR'=>'/', //模板文件MODULE_NAME与ACTION_NAME之间的分割符，只对项目分组部署有效
    
    'TAGLIB_BEGIN'          => '<',  // 标签库标签开始标记
    'TAGLIB_END'            => '>',  // 标签库标签结束标记
    //'TAGLIB_LOAD'           => true, // 是否使用内置标签库之外的其它标签库，默认自动检测
    //'TAGLIB_BUILD_IN'       => 'cx', // 内置标签库名称(标签使用不必指定标签库名称),以逗号分隔
    //'TAGLIB_PRE_LOAD'       => '',   // 需要额外加载的标签库(须指定标签库名称)，多个以逗号分隔
    'TAG_NESTED_LEVEL'		=> 3,    // 标签嵌套级别
    'TAG_EXTEND_PARSE'      => '',   // 指定对普通标签进行扩展定义和解析的函数名称。

    /* 表单令牌验证 */
    'TOKEN_ON'              => true,     // 开启令牌验证
    'TOKEN_NAME'            => '__hash__',    // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE'            => 'md5',   // 令牌验证哈希规则
    

);