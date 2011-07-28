<?php

class ApiList extends BaseApi
{
	public $apiList = array(
		//api list
		'account'=>array('verify','ratelimit','logout','updateimage','updateprofile','updateprivacy','getprivary'),
		'search'=>array('search'),
		'tag'=>array('create','suggestions','destroy','destroybatch'),
		'msg'=>array('new','destroy','destroybatch','list'),
		'people'=>array('people','friends','followers','hot','suggestions','follow','unfollow'),
	
		'login'=>array('login','logout','check','forgetpass'),
	);
}