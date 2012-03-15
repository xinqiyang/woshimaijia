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

class LogTest extends PHPUnit_Framework_TestCase
{
	public function testlog()
	{
		echo "testlog\n";
		
		Session::set('uinfo', '{"id":"1111111","account":"admin","password":"21232f297a57a5a743894a0e4a801fc3","email":"wsmj100@woshimaijia.com","ip":"127.0.0.1","createtime":"1313588873"}');
		logNotice('bbbbbbbbbbbb');
		$get = Session::get('uinfo');
		$key = 'PHPREDIS_SESSION:*';
		$r = MRedis::instance();
		//$r->set($key,'sss');
		$result = $r->keys($key);
		echo "COUNT:".count($result)."\n\n";
		foreach ($result as $val) {
			//echo $val."\n";
			$keysresult = $r->get($val);
			//var_dump($keysresult);
			//echo "------------------------------------------\n\n\n";
		}
		
	}
}