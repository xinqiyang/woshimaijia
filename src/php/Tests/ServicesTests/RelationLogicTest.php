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

class RelationLogicTest extends PHPUnit_Framework_TestCase
{
	public function testfocus()
	{
		$user_id = 12344;
		$other_id = 345;
		$r = RelationService::focus($user_id, $other_id);
		var_dump($r);
		$this->assertEquals(true,is_array($r));
	}
	
	public function testunfocus()
	{
		$user_id = 12344;
		$other_id = 345;
		$r = RelationService::unfocus($user_id, $other_id);
		var_dump($r);
		$this->assertEquals(true,is_array($r));
	}
	
	public function testgetrelation()
	{
		$user_id = 12344;
		$type = 'focus';
		$limit = 3;
		$r = RelationService::getRelation($user_id, $type, $limit);
		var_dump($r);
		$this->assertEquals(true,is_array($r));
	}
	
}