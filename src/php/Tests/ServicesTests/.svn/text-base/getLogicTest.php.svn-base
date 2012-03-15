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

class getLogicTest extends PHPUnit_Framework_TestCase 
{
	public function testgetDistrict()
	{
		$ip = '111.193.219.74';  //beijing
		$ip = '114.80.166.240'; //shanghai
		$ip = '61.154.127.255'; //quanzhou
		
		$r = DistrictLogic::getDistrict($ip);

		$this->assertEquals('beijing',$r);
	}
}