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

/**
 * test add services
 * @author xinqiyang
 *
 */
require_once dirname(dirname(__FILE__))."/TestConfiguration.php";
class AdServicesTest extends PHPUnit_Framework_TestCase
{
	
	public function testsetad()
	{
		$array['id'] = objid();
		$array['module'] = 'module'.mt_rand(0, 10000);
		$array['action'] = 'action'.mt_rand(0, 10000);
		$array['adcode'] = 'adcode'.mt_rand(0, 10000);
		$array['createtime'] = time();
		$array['adbegin'] = time()-1000;
		$array['adend'] = time();
		$array['status'] = 0;
		$array['services_id'] = 1;
		$array['position'] = 'l_r_01';
		$r = AdsService::addAd($array);
		var_dump($r);
	}
	
	public function testgetsad()
	{
		$module = 'module1279';
		$action = 'action8439';
		$r = AdsService::getsAd($module,$action);
		var_dump($r);
	}
	
	public function testaddestory()
	{
		$array = 13134304986687221 ;//array('id'=>'');
		$r = AdsService::adDestory($array);
		var_dump($r);
	}
	
	

}