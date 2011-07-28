<?php
require_once '../../src/php/Buddy/Functions.php';
require_once '../../src/php/Buddy/Queue.php';

//load CONFIG
C(include '../../src/php/Config/dev/data.conf.php');

class TestQueue extends PHPUnit_Framework_TestCase
{
	public function testput()
	{
		$name = 'xq_queue';
		$data = 'xinqi';
		$q = new Queue();
		$r = $q->put($name, $data);
		$this->assertEquals(true,$r);
	}
	
	public function testget()
	{
		$name = 'xq_queue';
		$data = 'xinqi';
		$q = new Queue();
		$r = $q->get($name);
		$this->assertEquals($data,$r);
	}
	
}