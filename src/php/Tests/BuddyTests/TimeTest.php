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

class TimeTest extends PHPUnit_Framework_TestCase {
	
	public function testnongli()
	{
		$varTheDay = time();
		//$varTheDay = '2011-03-10 11:23:33';
		$nongli = Time::nongLi($varTheDay);
		
		$this->assertEquals(true,is_string($nongli));
		
	}
	
	
	
}