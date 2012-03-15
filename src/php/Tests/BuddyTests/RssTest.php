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

class RssTest extends PHPUnit_Framework_TestCase {
	public function testrss()
	{
		$array['site'] = array('title'=>'aaa','desc'=>'bbb','url'=>'http://aaa.bbb.com');
		$array['body'] = array( 
		array('topic'=>'1fasdfsaf','link'=>'http://ssddss.com','date'=>'1318845887','abstract'=>'afdasdfasfasdfdsaf','author'=>'aaffa'),
		array('topic'=>'2fasdfsaf','link'=>'http://ssfffss.com','date'=>'1318845887','abstract'=>'afdasfasdasdffdsaf','author'=>'abbbaa'),
		);
		
		$rss = new Rss();
		$rss->outPut($array);
		
		$this->assertEquals(true,true);
		
	}
}