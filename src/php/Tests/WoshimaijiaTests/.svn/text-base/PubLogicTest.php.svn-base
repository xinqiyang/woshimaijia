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

class PubLogicTest extends PHPUnit_Framework_TestCase 
{
	public function testactSetMessage()
	{
		$r = PubLogic::actSetMessage();
		$this->assertEquals(true,$r);
	}
	
	public function testgetRedisListData()
	{
		$key = 'l:pub';
		$from = 0;
		$pageSize = 5;
		$r = BaseService::redisGetList($key, $from,$pageSize);
		//var_dump($r);
		$this->assertEquals(true,is_array($r)&&(count($r)==5));
	}
	
	public function testwebPageIndex()
	{
		$params = array('p'=>'3','f'=>'0');
		$r = PubLogic::webPageIndex($params);
		//var_dump($r);
		$this->assertEquals(true,is_array($r));
	}
}