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

class OnlineServiceTest extends PHPUnit_Framework_TestCase
{
	public function testonline()
	{
		//$keys = 'wsmjweb';
		//var_dump(OnlineService::online($keys));
		var_dump(OnlineService::online());
	}
	
	public function testlogoutall()
	{
		$keys = 'PHPREDIS_SESSION:*';
		//$keys = 'wsmjweb';
		$r = OnlineService::logoutAll($keys);
		var_dump($r);
	}
}