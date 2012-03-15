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

class AccountServiceTest extends PHPUnit_Framework_TestCase 
{
	
	public function testSetRecommendProduct()
	{
		$arr = array('13166861173279530','13166861173361931','13166861173172240');
		$r = StoreLogic::actSetRecommendProduct($arr);
		$this->assertEquals(true,$r);
	}
	
	public function testwebPageIndex()
	{
		$params = array();
		$r = StoreLogic::webPageIndex($params);
		$this->assertEquals(true,is_array($r));
	}
}