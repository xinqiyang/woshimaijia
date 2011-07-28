<?php
require_once '../../src/php/Buddy/Functions.php';
require_once '../../src/php/Buddy/Curl.php';
class TestCurl extends PHPUnit_Framework_TestCase
{
	public function testget()
	{
		debug_start();
		$url = 'http://api.dev.woshimaijia.com/check/index';
		$r = Curl::get($url);
		$this->assertEquals(true,$r == 1);
		debug_end();
	}
	
	public function testgettype()
	{
		$url = 'http://api.dev.woshimaijia.com/check/index/type/2';
		$r = Curl::get($url);
		$this->assertEquals(true,$r == '2CHECK');
	}
	
	public function testpost()
	{
		$result = "posttypeCHECK";;
		$url = 'http://api.dev.woshimaijia.com/check/post';
		$params = array('type'=>'type','post'=>'post');
		$r = Curl::post($url, $params);
		$this->assertEquals(true,$r == $result);
	}
	
}