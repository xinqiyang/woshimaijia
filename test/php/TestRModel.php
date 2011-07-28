<?php
require_once '../../src/php/Buddy/Functions.php';
require_once '../../src/php/Buddy/RModel.php';
//load CONFIG
C(include '../../src/php/Config/dev/data.conf.php');

class TestRModel extends PHPUnit_Framework_TestCase
{
	
	public function testgetInstanceAndSet()
	{
		$key = 'redismaster';
		$redis = storeR();
		$r = $redis->set($key,'test01value');
		$this->assertEquals(true,$r);
	}
	
	public function testgetValue()
	{
		$key = 'redismaster';
		$value = 'test01value';
		$redis = storeR();
		$r = $redis->get($key);
		$this->assertEquals(true,$r === $value);
	}
	
	public function testgetFromSlave()
	{
		$key = 'redismaster';
		$value = 'test01value';
		$redis = RModel::getSlaveInstance();
		$r = $redis->get($key);
		if($r)
		{
			$this->assertEquals(true,$r === $value);
		}else{
			var_dump('getFromSlave_false');
		}
	}
	
	public function testgetAndSetSlave()
	{
		$key = 'slavetest1';
		$value = 'test01value';
		$redis = storeR();
		$redis->set($key,$value);
		$slaveredis = RModel::getSlaveInstance();
		$r = $slaveredis->get($key);
		if($r)
		{
			$this->assertEquals(true,$r === $value);
		}else{
			var_dump('getAndSetSlave_false');
		}
	}
	
	public function testgetFromMaster()
	{
		$key = 'redismaster01';
		$value = 'test01value';
		$redis = storeR();
		$redis->set($key,$value);
		$r = $redis->get($key);
		if($r)
		{
			$this->assertEquals(true,$r === $value);
		}else{
			var_dump('getFromMaster_false');
		}
	}
	
	
}