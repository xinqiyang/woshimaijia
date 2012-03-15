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
require_once dirname(dirname(__FILE__))."/TestConfiguration.php";

class PostLogicTest extends PHPUnit_Framework_TestCase{
	public function testpostlogic(){
		if(!defined('APP_NAME')){
			define('APP_NAME', 'Web');
		}
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST = array('id'=>objid(),'content'=>'testtdopost deal','form'=>'tweet');
		$array = Validate::validates();
		$r = PostLogic::addPost($array);
		var_dump($r);
	}
}
