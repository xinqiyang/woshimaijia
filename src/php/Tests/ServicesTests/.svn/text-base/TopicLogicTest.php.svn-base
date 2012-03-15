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

class TopicLogicTest extends PHPUnit_Framework_TestCase 
{
	
	public function testaddTopic()
	{
		$title = '我的测试标题';
		$content = '测试数据';
		$source = 'web';
		$user_id = '222222';
		$group_id = '111111';
		$r = TopicLogic::addTopic($title, $content, $source, $user_id, $group_id);
		$this->assertEquals(true,$r);
	}
		
}