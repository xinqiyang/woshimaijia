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

class MessageServiceTest extends PHPUnit_Framework_TestCase 
{
	
	public function testaddMessage()
	{
		$_POST['form'] = 'mail';
		$_POST['from_id'] = '123456';
		$_POST['to_id'] = '654321';
		$_POST['title'] = '我的测试';
		$_POST['content'] = '我的测试结果';
		
		
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$result = Validate::validates();
		
		var_dump($result);
	}
		
}