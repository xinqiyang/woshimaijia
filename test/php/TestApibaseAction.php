<?php
require_once '../../src/php/Buddy/Functions.php';
require_once '../../src/php/Buddy/MModel.php';
require_once '../../src/php/Presentation/OpenApi/Actions/ApibaseAction.php';
//load CONFIG
C(include '../../src/php/Config/dev/data.conf.php');

class TestApibaseAction extends PHPUnit_Framework_TestCase
{
	public function testinput()
	{

		$_POST['type']='account'; //指定数据类型
		$_POST['rule']='account'; //指定验证规则
		
		$_POST['account']='111';
		$_POST['password']='222';
		$_POST['email']='sxx@163.com';
		$_POST['status']=1;
		$_POST['createtime']=time();

		debug_start('test');
		$a = new ApibaseAction();
		$r = $a->input();
		debug_end('test');
		$this->assertEquals(true,$r);
	}
}