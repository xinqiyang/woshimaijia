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

class FunctionsTestAction extends PHPUnit_Framework_TestCase
{
	
	public function testsetSessionServer()
	{
		$param = "Web";
		$session = C('session.'.$param);
	 	if(!empty($session))
	 	{
	 		if($session['handler'] == 'redis' && $session['path'] == 'tcp://127.0.0.1:6379')
	 		{
	 			$this->assertEquals(true,true);
	 		}else{
	 			$this->assertEquals(true,false);
	 		}
	 	}else{
	 		$this->assertEquals(true,false);
	 	}
	}
	
	
	public function testtraceid()
	{
		
	}
}