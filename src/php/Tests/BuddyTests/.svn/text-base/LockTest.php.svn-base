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

class LockTest extends PHPUnit_Framework_TestCase {
	
	public function testExistsEaccelerator()
	{
		$r = function_exists("eaccelerator_lock");
		$this->assertEquals(true,$r);
	}
	
	
	public function testUseTempPath()
	{
		$name = 'lockTest';
		$lock = new Lock($name);
		$lock->lock();
		echo "do action ok \n";
		$lock->unlock();
		$this->asserEquals(true,true);
	}
	
	
	
}