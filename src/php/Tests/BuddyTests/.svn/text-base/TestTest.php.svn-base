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

class TestTest extends PHPUnit_Framework_TestCase {
	
	public function testisObject()
	{
		$id = '13132274644527071';
		$r = ItemLogic::isObject($id);
		var_dump($r);
	}
	
	public function testobjectid()
	{
		$time = time();
		$count = 0;
		while (true) {
			$count++;
			echo  objid()."\n";
			if(time()-$time>0){
				exit;
			}
		}
	}
	
	
	public function testu()
	{
		echo U('show/showgoods',array('id'=>'1'));
	}
	
	public function testblock()
	{
		echo 'aaaaaa';
		try{
			$r = UrlLogic::block(10);
			var_dump($r);
		}catch (Exception $e) {
			var_dump($e->__toString());
		}
	}
	
	public function urlserviceset()
	{
		//UrlService::set();
		$id = 13126189477784851;
		var_dump(UrlService::get($id,'title,tags'));
	}

	public function parseurl()
	{
		$url = 'http://open.client.lashou.com/api/cities';
		$r = getDomain($url);
		var_dump($r);
	}

	public function testxml()
	{
		//$url = 'http://open.client.lashou.com/api/cities';
		$url = 'http://open.client.lashou.com/api/detail/city/2419/p/1/r/10';
		$strXml = Curl::get($url);
		$arr = XML::toArray($strXml);
		var_dump($arr);
	}

	public function testobjectarr()
	{
		$arr = array('id'=>'xxx','name'=>'sss');
		$obj = (object)$arr;
		debug_start('obj');
		for($i=0;$i<10000;$i++)
		{
			$robj[] = self::testuseobj($obj);
		}
		debug_end('obj');

		debug_start('arr');
		for($i=0;$i<10000;$i++)
		{
			$rarr[] = self::testusearr($arr);
		}
		debug_end('arr');

		var_dump($arr,$obj);

	}

	private function testusearr($arr)
	{
		$arrnew = $arr['id'];
		return ;

	}
	private function testuseobj($obj)
	{
		$objnew = $obj->id;
		return ;
	}

	public function testsetmem()
	{
		$config = C('WebForms');
		//var_dump(is_array($config));die;
		//var_dump($r);die;
		$config = array(
				'ka'=>array('va33','ddd'),
				'kb'=>'vb33',
				'kc'=>'vc33',
			);
			
		chdb_create('chdb.data1', $config);
	}
	
	public function testgetmem()
	{
		$r = getMem('WebForms');
		var_dump($r);
	}
	
	public function testchdbset()
	{
		
			//set chdb
			echo 'SET PID：'.posix_getpid()." \n";
			$config = array(
				'ka'=>'va33',
				'kb'=>'vb33',
				'kc'=>'vc33',
			);
			
			chdb_create('chdb.data', $config);
			echo "SET OK \n";
		
	}
	
	public function testchdbget()
	{
		
			echo 'SET PID：'.posix_getpid()." \n";
			debug_start('start');
			//get it 
			$chdb = new chdb('chdb.data');
			$value1 = $chdb->get('ka');
			$value2 = $chdb->get('kb');
			debug_end('start');
			echo "GET KA $value1,KB $value2 \n";
		
	}
	
	
	
	public function testaddurl()
	{
		//echo get_include_path()."\n";
		//var_dump(C('app_autoload_path'));
		//die;
		//for($i=0;$i<10;$i++)
		//{
			UrlService::set();
		//}
	}
	
	public function testlog()
	{
		loginit("/tmp", "testlog", 16, array("uid"=>12345 , "reqip"=>"210.23.55.33"), true);
		logFATAL("fatal %d  %s !!!", 1231324, "asdfasdfsf");
		logWARNING("fatal %d  %s !!!", 1231324, "asdfasdfsf");
		logNOTICE("fatal %d  %s !!!", 1231324, "asdfasdfsf");
	}
	
	public function testsession()
	{
		//echo "test start \n";die;
		try{
			$sessionid = 'userid';
			Session::set($sessionid,'useridvalue');
			var_dump($sessionid);
			self::testsessionget();
		}catch (Exception $e) {
			var_dump($e->__toString());
		}
	}
	
	public function testsessionget()
	{
		
		//
		$sessionid = 'userid';
		$r = Session::get($sessionid);
		var_dump($r);
		
	}
	
	public function testgetredis()
	{
		$r = MRedis::instance()->get('userid');
		var_dump($r);
	}
	
	public function testiplocation()
	{
		header("Content-type: text/html; charset=utf-8"); 
		debug_start('ip');
		$ip = Iplocation::instance();
		$arr = array('123.120.1.160','124.130.2.160','223.120.1.160','66.228.59.210');
		foreach ($arr as $val)
		{
			$r = $ip->getlocation($val);
			var_dump($r);
		}
		//var_dump(mb_convert_encoding($r['country'], 'UTF8','GBK'));
		//var_dump(mb_convert_encoding($r['area'], 'UTF8','GBK'));
		debug_end('ip');
		die;
			
	}
	
	
	public function testaddparam()
	{
		
		$url = 'http://api.dev.woshimaijia.com/app/ddd';
		$_GET['aa'] = 'aaa';
		$_GET['bb'] = 'bbb';
		$urls = addParamToUrl($url,$_GET);
		var_dump($urls);
	}
	
	public function testMongodb()
	{
		$m = new Mongo();

		// select a database
		$db = $m->test;
		
		$log = $db->createCollection("logger", true, 10*1024, 10); 

		for ($i = 0; $i < 100; $i++) {
		    $log->insert(array("level" => '1', "msg" => "sample log message #$i", "ts" => new MongoDate()));
		}
		
		$msgs = $log->find();
		
		foreach ($msgs as $msg) {
		    echo $msg['msg']."\n";
		}
		
		// select a collection (analogous to a relational database's table)
		$collection = $db->foo;
		//var_dump($db,$collection);
		// add a record
		$obj = array( "title" => "Calvin and Hobbes", "author" => "Bill Watterson" );
		$r = $collection->insert($obj);
		//var_dump($r);
		// add another record, with a different "shape"
		$obj = array( "title" => "XKCD", "online" => true );
		$collection->insert($obj);
		
		// find everything in the collection
		$cursor = $collection->find(array( "title" => "XKCD"));
		
		//var_dump($cursor);
		//die;
		// iterate through the results
		foreach ($cursor as $obj) {
		    echo $obj["title"] . "\n";
		}
	}
	
	public function testBaseSetList()
	{
		$key = 'testlist';
		$array = array(9,10,11);
		BaseService::setList($key,$array,5);
		$larray = array('k'=>$key,'f'=>'0','n'=>'0');
		$r = BaseService::getList($larray);
		var_dump($r);
	}
	
	
	public function updateProfile()
	{
		$r = storeR();
		/*
		
		$array = array('id'=>1234999,'screen_name'=>'testtest','icon'=>'aaa.jpg','note'=>'ddddddddddddd');
		$key = 'u:'.$array['id'];
		var_dump('SET',$r->hmSet($key,$array));
		var_dump('GET',$r->hGetAll($key));
		*/
		$arraynew = array('id'=>1234999,'icon'=>'aaaaaaaaaaaaabbbffffffffff.jpg');
		$key = 'u:'.$arraynew['id'];
		var_dump('SET',$r->hmSet($key,$arraynew));
		var_dump('GET',$r->hGetAll($key));
		
	}
	
	public function service()
	{
		$array = array('id'=>1111,'dd'=>'sss');
		var_dump(AccountService::addToEventQueue($array,__METHOD__));
	}
	
	public function testobjid()
	{
		$pre = '';
		$id = '';
		for($i=0;$i<100000;$i++)
		{
			$pre = $id;
			$id = objid();
			echo $id."\n";
			if($pre>=$id)
			{
				echo  $id."ERROR \n";
			}
		}
		
	}
	
	public function apipath()
	{
		echo "\n";
		echo API_PATH;
		echo "\n";
		echo "\n";
	}
	
	public function jsonencode()
	{
		$arr = array('product'=>array('brand'=>'1111','model'=>'2222','price'=>'323','origin'=>'ddfdsf','category'=>'fffff'));
		
		echo Json::encode($arr)."\n";
	}
	
	public function redis()
	{
		$r = storeR();
		$r->set('redistest',time());
		echo $r->get('redistest')."\n";
	}
	
	public function curlmultifetch()
	{
		debug_start('curl');
		$urlarr = array(
			//'index'=>'http://api.dev.woshimaijia.com/index/index',
			'check'=>'http://api.dev.woshimaijia.com/check/index',
		);
		
		$data = Curl::curlMultiFetch($urlarr);
		var_dump($data);
		//the time use
		//Process curl: Times 0.008302s 
		debug_end('curl');
	}

	public function filegetcontent()
	{
		debug_start('f');
		$url = 'http://api.dev.woshimaijia.com/check/index';
		$options = array ('http' => array ('method' => "GET", 'timeout' => 1 ) );
		$strContent = file_get_contents ( $url, false, stream_context_create ( $options ) );
		var_dump($strContent);				
		debug_end('f');

	}
	
	
	public function testredisset()
	{
		$prekey = 'uuuu_';
		$r = storeR();
		for($i=1;$i<10000;$i++)
		{
			$array = array('id'=>$i,'name'=>'3333');		
			$result1 = $r->hmSet($prekey.$i,$array);
			//var_dump($result1);
			$result2 = $r->hmSet($prekey.$i,$array);
			//var_dump($result2);
		}
	}
	
	
	public function testredisget()
	{
		debug_start();
		$prekey = 'uuuu_';
		for($i=1;$i<10000;$i++)
		{
			$idList[] = $i;
		}
		$keys = array('id','name','d');
		$result = RModel::getMultiHashes($prekey, $idList, $keys);
		//var_dump($result);
		debug_end();
	}
	
	
	public function testgetallkey()
	{
		//search key of the redis,get the key array
		debug_start();
		$r = storeR();
		$result = $r->keys('uuuu_99?9');
		
		var_dump($result,count($result));
		
		debug_end();
		var_dump('DB SIZE:'.$r->dbSize());
	}
	
	
	
	public function methodAll()
	{
		//
		
	}
	
	
	public function test001()
	{
		
	}
	
}
