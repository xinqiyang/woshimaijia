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

class MsnTest extends PHPUnit_Framework_TestCase {
	
	public function testmsn()
	{
		
		$msn = new Msn();
		
		if (!$msn->connect('xinqiyang@live.cn', 'ssss')) {
		    echo "Error for connect to MSN network\n";
		    echo "$msn->error\n";
		   
		}
		
		$r = $msn->getMembershipList();
		var_dump($r);die;
		echo "Done!\n";
		exit;
	}
	
	
	
}