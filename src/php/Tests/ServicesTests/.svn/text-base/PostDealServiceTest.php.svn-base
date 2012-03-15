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

class PostDealServiceTest extends PHPUnit_Framework_TestCase 
{
	public function testUrl()
	{
		$content = "我这里还是可以发了http://item.taobao.com/item.htm?id=14660776838&cm_cat=50016756&_u=r1u942d8dad&pm2=2
刚刚有可以发了";
		$obj = new PostDealService($content,1234444444);
		$return = $obj->deal();
		var_dump($return);
		$this->assertEquals(true,true);
	}
	
	public function testshareGoods()
	{
		$content = "我这里还是可以发了http://item.taobao.com/item.htm?id=14660776838&cm_cat=50016756&_u=r1u942d8dad&pm2=2
刚刚有可以发了";
		
	}
	
	public function testdealpost()
	{
		return ;
		$content = "#送礼物##春节送礼##买车票##买电脑##买机票##送礼物##春节送礼##买车票##买电脑##买机票#";
		$obj = new PostDealService($content);
		$return = $obj->deal();
		var_dump($return);
		$this->assertEquals(true,true);
	}
}
	