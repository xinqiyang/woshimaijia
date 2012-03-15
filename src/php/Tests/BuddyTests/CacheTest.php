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

class CacheTest extends PHPUnit_Framework_TestCase {

	public function testmemcached()
	{
		$cache = Cache::instance();
		$key = 'testkey';
		$value = 'aaa';
		$cache->set($key,$value);
		$r = $cache->get($key);
		$this->assertEquals($value,$r);
	}
	
	public function testmemcache()
	{
		$cache = Cache::instance('memcache');
		$key = 'testkey11';
		$value = 'aaa1';
		$cache->set($key,$value);
		$r = $cache->get($key);
		$this->assertEquals($value,$r);
	}
}