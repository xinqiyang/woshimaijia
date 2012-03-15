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

class MMemcachedTest extends PHPUnit_Framework_TestCase
{
		public function testquery()
		{
			$id = 13141536903974121;
			$sql = "SELECT content FROM __TABLE__ WHERE user_id=$id ORDER BY ID DESC LIMIT 1";
			$r = BaseService::query('post', $sql);
			var_dump($r);
			$this->assertEquals(true,is_array($r));		
		}
		
		public function testqueryField()
		{
			$id = 13141536903974121;
			$field = 'content';
			$sql = "user_id=$id ORDER BY ID DESC";
			$r = BaseService::queryField('post', $sql,$field);
			var_dump($r);
			$this->assertEquals(true,is_string($r));		
		}
		
		public function testqueryFieldAll()
		{
			$id = 13141536903974121;
			$field = '*';
			$sql = "user_id=$id ORDER BY ID DESC";
			$r = BaseService::queryField('post', $sql,$field);
			var_dump($r);
			$this->assertEquals(true,is_string($r));		
		}
					
}