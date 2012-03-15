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

class BaseRedisTest extends PHPUnit_Framework_TestCase 
{
	
	public function testredisSetList()
	{
		return ;
		$array = array(1,2,3,4,5678);
		$key = KeysService::getKey(KeysService::$list, KeysService::$keyInbox,13333);
		$r = BaseService::redisSetList($key, $array);
		var_dump(BaseService::redisGetList($key, 0));
		$this->assertEquals(true,$r);
	}
	
	public function testredisGetKeyValues()
	{
		return ;
		$r = BaseService::redisGetKeyValues(13333, KeysService::$list,KeysService::$keyInbox);
		var_dump($r);
		$this->assertEquals(true,$r);
	}
	
	
	public function testredisSetKeyValues()
	{
		return ;
		$id = '11111111111111113';
		$keyType = array('h:','l:','s:','v:','c:','z:');
		$key = 'testkeya';
		$v1 = array('id'=>$id,'title'=>'testtile');
		$r1 = BaseService::redisSetKeyValues($id, $keyType[0], $key, $v1);
		var_dump('r1 -----------------',$r1);
		$rr1 = BaseService::redisGetKeyValues($id, $keyType[0], $key);
		var_dump($rr1);
		
		$v2 = 12345678909890989;
		$r2 = BaseService::redisSetKeyValues($id, $keyType[1], $key, $v2);
		var_dump('r2 -----------------',$r2);
		$rr2 = BaseService::redisGetKeyValues($id, $keyType[1], $key);
		var_dump($rr2);
		
		
		$v3 = 333333333333333;
		$r3 = BaseService::redisSetKeyValues($id, $keyType[2], $key, $v3);
		var_dump('r3 -----------------',$r3);
		$rr3 = BaseService::redisGetKeyValues($id, $keyType[2], $key);
		var_dump($rr3);
		
		
		$v4 = 'abc111';
		$r4 = BaseService::redisSetKeyValues('', $keyType[3], $key, $v4);
		var_dump('r4 -----------------',$r4);
		$rr4 = BaseService::redisGetKeyValues('', $keyType[3], $key);
		var_dump($rr4);
		
		$v5 = 1;
		$r5 = BaseService::redisSetKeyValues($id, $keyType[4], $key, $v5);
		var_dump('r5 -----------------',$r5);
		$rr5 = BaseService::redisGetKeyValues($id, $keyType[4], $key);
		var_dump($rr5);
		
		
		$v6 = 4;
		$score = 4;
		$r6 = BaseService::redisSetKeyValues($id, $keyType[5], $key, $v6,$score);
		var_dump('r6 -----------------',$r6);
		$rr6 = BaseService::redisGetKeyValues($id, $keyType[5], $key);
		var_dump($rr6);
		
	}
	
	public function testlpushx()
	{
		$id = '11111111111111116';
		$v2 = 1;
		$v3 = 2;
		$v4 = 3;
		$v5 = 1;
		$v6 = 2;
		$key = 'testlpush';
		$r2 = BaseService::redisSetKeyValues($id, KeysService::$ulist, $key, $v2);
		$r3 = BaseService::redisSetKeyValues($id, KeysService::$ulist, $key, $v3);
		$r4 = BaseService::redisSetKeyValues($id, KeysService::$ulist, $key, $v4);
		$r5 = BaseService::redisSetKeyValues($id, KeysService::$ulist, $key, $v5);
		$r6 = BaseService::redisSetKeyValues($id, KeysService::$ulist, $key, $v6);
		//$r7 = BaseService::redisSetKeyValues($id, KeysService::$list, $key, 'aaaaa');
		var_dump('r2 -----------------',$r2,$r3,$r4,$r5,$r6);
		$rr2 = BaseService::redisGetKeyValues($id, KeysService::$ulist, $key);
		var_dump($rr2);
		
	}
	
	
	
		
}