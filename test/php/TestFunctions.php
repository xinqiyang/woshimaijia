<?php
require_once '../../src/php/Buddy/Functions.php';

//load CONFIG
C(include '../../src/php/Config/dev/data.conf.php');

/**
 * this Test will test all the public and used functions in the class
 *
 * @author xinqiyang
 *
 */
class TestFunctionsTest extends PHPUnit_Framework_TestCase
{
	
	public function testU()
	{
		define('APP_NAME', 'Web');
		$url = 'index/index/aaa/123/';
		$uvalue = U('index/index',array('aaa'=>'123'));
		//var_dump($uvalue);
		$this->assertEquals(true,$url === $uvalue);
	}
	
	public function testobjid()
	{
		$r = objid();
		//var_dump($r);
		$this->assertEquals(true,$r>0);
	}
	
}