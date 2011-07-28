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
 * return all of the sys forms 
 */
return array(
	'WebForms'=>array(
		'signup'=>array(
			'fields'=>array('title'=>'title','name'=>'name','createtime'=>'createtime'),
			'method'=>'post', // define method post/get
			'api'=>'reg/add', //get the api logic do deal the request
			'ajax'=>'1', // set 1/0 
			//POST data check
			'check'=>array(
				//checktype 1=>must_validate,2=>value_validate,3=>exist_validate
				'title'=>array(1,'require','标题必须填写'),//validate preg check, error report
				'name'=>array(2,'email','邮箱格式错误'),
			),
			'auto'=>array(
				'createtime'=>'time',
			),
			'return'=>'json', //return json/xml
		),
		
		'signin'=>array(
			'fields'=>array('title'=>'title','name'=>'name','createtime'=>'createtime'),
			'method'=>'post', // define method post/get
			'api'=>'reg/add', //get the api logic do deal the request
			'ajax'=>'1', // set 1/0 
			//POST data check
			'check'=>array(
				//checktype 1=>must_validate,2=>value_validate,3=>exist_validate
				'title'=>array(1,'require','标题必须填写'),//validate preg check, error report
				'name'=>array(2,'email','邮箱格式错误'),
			),
			'auto'=>array(
				'createtime'=>'time',
			),
			'return'=>'json', //return json/xml
		),
		//send a tweet
		'tweet'=>array(
			'fields'=>array('title'=>'title','name'=>'name','createtime'=>'createtime'),
			'method'=>'post', // define method post/get
			'api'=>'reg/add', //get the api logic do deal the request
			'ajax'=>'1', // set 1/0 
			//POST data check
			'check'=>array(
				//checktype 1=>must_validate,2=>value_validate,3=>exist_validate
				'title'=>array(1,'require','标题必须填写'),//validate preg check, error report
				'name'=>array(2,'email','邮箱格式错误'),
			),
			'auto'=>array(
				'createtime'=>'time',
			),
			'return'=>'json', //return json/xml
		),
		
		//user send actions
		'actions'=>array(
			'fields'=>array('title'=>'title','name'=>'name','createtime'=>'createtime'),
			'method'=>'post', // define method post/get
			'api'=>'reg/add', //get the api logic do deal the request
			'ajax'=>'1', // set 1/0 
			//POST data check
			'check'=>array(
				//checktype 1=>must_validate,2=>value_validate,3=>exist_validate
				'title'=>array(1,'require','标题必须填写'),//validate preg check, error report
				'name'=>array(2,'email','邮箱格式错误'),
			),
			'auto'=>array(
				'createtime'=>'time',
			),
			'return'=>'json', //return json/xml
		),
		
		//public the product 
		'product'=>array(
			'fields'=>array('title'=>'title','name'=>'name','createtime'=>'createtime'), //form to field mapping
			'method'=>'post', // define method post/get
			'api'=>'reg/add', //get the api logic do deal the request
			'ajax'=>'1', // set 1/0 
			//POST data check
			'check'=>array(
				//checktype 1=>must_validate,2=>value_validate,3=>exist_validate
				'title'=>array(1,'require','标题必须填写'),//validate preg check, error report
				'name'=>array(2,'email','邮箱格式错误'),
			),
			'auto'=>array(
				'createtime'=>'time',
			),
			'return'=>'json', //return json/xml
		),
		//pub the brand
		'brand'=>array(
			'fields'=>array('title'=>'title','name'=>'name','createtime'=>'createtime'), //form to field mapping
			'method'=>'post', // define method post/get
			'api'=>'reg/add', //get the api logic do deal the request
			'ajax'=>'1', // set 1/0 
			//POST data check
			'check'=>array(
				//checktype 1=>must_validate,2=>value_validate,3=>exist_validate
				'title'=>array(1,'require','标题必须填写'),//validate preg check, error report
				'name'=>array(2,'email','邮箱格式错误'),
			),
			'auto'=>array(
				'createtime'=>'time',
			),
			'return'=>'json', //return json/xml
		),
		
		
	),
);