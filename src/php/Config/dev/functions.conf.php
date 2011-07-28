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
 * system functions configuration
 */
return array(
	//get all of the system functions
	'head'=>array(
		'index:index'=>array('title'=>'首页','tags'=>'我是买家,首页','desc'=>'我是买家首页'), //seo 
		'index:home'=>array('title'=>'','tags'=>'','desc'=>''),
		'signup:index'=>array('title'=>'','tags'=>'','desc'=>''),
		'login:index'=>array('title'=>'','tags'=>'','desc'=>''),
		'login:forgetpass'=>array('title'=>'','tags'=>'','desc'=>''),
		'signup:deal'=>array('title'=>'','tags'=>'','desc'=>''),
	),
	
	'data'=>array(
		'index:index'=>array(
			'accountlist'=>'account/msglist','checkin'=>'account/xxxxx',
		),
		'signup:index'=>array(
			'accountlist'=>'check/index','checkin'=>'check/index',
		),
	),
);