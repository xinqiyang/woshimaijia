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

class SpamServiceTest extends PHPUnit_Framework_TestCase
{
	
	public function testwordFilter()
	{
		$post = "我们要一起组织起来支持温家宝总理为大家做事情";
		//$post = "赵紫阳的测试了";
		$post = "我没有了";
		$r = SpamService::wordFilter($post);
		$this->assertEquals($r,true);
	}
}
