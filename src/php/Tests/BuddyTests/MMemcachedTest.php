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

class MMemcachedTest extends PHPUnit_Framework_TestCase
{
	public function testmemcached()
	{
		$m = MMemcached::instance();
		$r = $m->set('test','testaaa');
		$this->assertEquals(true,$r);
	}

	public function testmemcache()
	{
		$value = 'testaaab';
		$m = MMemcached::instance('memcache');
		$m->set('testb',$value);
		$r = $m->get('testb');
		$this->assertEquals($value,$r);
	}
}