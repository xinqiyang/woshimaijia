<?php
require_once '../../src/php/Buddy/Functions.php';
require_once '../../src/php/Buddy/Cookie.php';

//load CONFIG
C(include '../../src/php/Config/dev/data.conf.php');


class TestCookie extends PHPUnit_Framework_TestCase
{

	public function testset()
	{
		$name = 'testcookie';
		$value = 'testcookievalue';
		//$r = cookie($name,$value);
		$r = 'xxx';
		var_dump($r);
		/*
		$r = Cookie::set($name, $value);
		var_dump($r);
		$this->assertEquals(true,$r);
		*/
	}
	
	/*
	public function testget()
	{
		$name = 'testcookie';
		$value = 'testcookievalue';
		$r = json_encode(Cookie::get($name));
		$this->assertEquals($value,$r);
	}
	
	//
	public function append()
	{
		
	}
	*/
	
	
	
}