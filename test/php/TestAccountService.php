<?php
require_once '../../src/php/Buddy/Functions.php';
require_once '../../src/php/Buddy/MModel.php';
require_once '../../src/php/BackEnd/Services/AccountService.php';
//load CONFIG
C(include '../../src/php/Config/dev/data.conf.php');

class TestAccountService extends PHPUnit_Framework_TestCase
{
	public function testcreate()
	{

		$_POST['type']='account'; //指定数据类型
		$_POST['rule']='account'; //指定验证规则
		
		$_POST['account']='111';
		$_POST['password']='222';
		$_POST['email']='sxx@163.com';
		$_POST['status']=1;
		$_POST['createtime']=time();

		debug_start('test');
		for($i=0;$i<1;$i++)
		{
			$r = AccountService::create($_POST);
		}
		debug_end('test');
		$this->assertEquals(true,$r);
	}
}