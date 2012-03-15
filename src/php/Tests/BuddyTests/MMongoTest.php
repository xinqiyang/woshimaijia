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
 * mongodb test
 * @author xinqiyang
 * $mongo = new MMongo("127.0.0.1:11223");
* $mongo->selectDb("test_db");
* $mongo->ensureIndex("test_table", array("id"=>1), array('unique'=>true));
* $mongo->count("test_table");
* $mongo->insert("test_table", array("id"=>2, "title"=>"asdqw"));
* $mongo->update("test_table", array("id"=>1),array("id"=>1,"title"=>"bbb"));
* $mongo->update("test_table", array("id"=>1),array("id"=>1,"title"=>"bbb"),array("upsert"=>1));
* $mongo->find("c", array("title"=>"asdqw"), array("start"=>2,"limit"=>2,"sort"=>array("id"=>1)))
* $mongo->findOne("$mongo->findOne("ttt", array("id"=>1))", array("id"=>1));
* $mongo->remove("ttt", array("title"=>"bbb"));
* $mongo->remove("ttt", array("title"=>"bbb"), array("justOne"=>1));
* $mongo->getError();
 */
require_once dirname(dirname(__FILE__))."/TestConfiguration.php";

class MMongoTest extends PHPUnit_Framework_TestCase
{
	public function testinstance()
	{
		$mongo = MMongo::instance('stat');
		$count = $mongo->count("foo");
		//var_dump("COUNT:".$count."\n");
		
		$r = $mongo->insert("foo", array("id"=>6, "title"=>"asdqw"));
		//var_dump($r);
		$result = $mongo->find('foo',array('id'=>2));
		//var_dump($result);
	}
	
	public function testinstancestat()
	{
		$mongo = MMongo::instance('mongo');
		$count = $mongo->count("foo");
		//var_dump("COUNT:".$count."\n");
		$r = $mongo->insert("foo", array("id"=>mt_rand(100, 10000), "title"=>"asdqw"));
		//var_dump($r);
		$result = $mongo->find('foo',array('id'=>2));
		//var_dump($result);
	}
	
	public function testmongoread()
	{
		$mongo = MMongo::instance('mongoread');
		//$count = $mongo->count("foo");
		//var_dump("COUNT:".$count."\n");
		$r = $mongo->insert("foo", array("id"=>2, "title"=>"asdqw"));
		var_dump($r);
		//$result = $mongo->find('foo',array('id'=>2));
		//var_dump($result);
	}

}
