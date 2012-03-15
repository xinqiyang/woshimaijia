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

class AppBaseTest extends PHPUnit_Framework_TestCase
{
	public function testredishcount()
	{
		$key = 'testhcount';
		$array = array('id'=>'1','count'=>0);
		$field = 'count';
		$count = -1;
		$r = BaseService::redisHCount($key, $field,$count);
		//var_dump($r);
		$redis = MRedis::instance();
		$result  = $redis->hGetAll($key);
		var_dump($result);
	}
	
	public function testgetsByPage()
	{
		$object = 'post';
		$where = 'id>0';
		$offset = 2;
		$pageSize = 3;
		$r = BaseService::getsByPage($object, $where, $offset,$pageSize,'*');
		var_dump($r);
	}
}