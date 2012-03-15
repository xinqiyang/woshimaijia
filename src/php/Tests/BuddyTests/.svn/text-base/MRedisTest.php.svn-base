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

class MRedisTest extends PHPUnit_Framework_TestCase
{
	
	public function testredisGetHashes()
	{
		
		$bol = false;
		$idList = array('13132274645974701','13132274646019752');
		$delidList = array('h:13132274645974701','h:13132274646019752');
		//BaseService::redisDeleteKeys($delidList);die;
		$r = BaseService::redisGetHashes($idList);
		//var_dump($r);
		if(count($r) == 2){
			$bol = true;
		}
		$this->assertEquals(true,$bol);
	}
	
	public function testhmGet() {

		$bol = false;
		//use command is : zAdd,zRange,zDelete,zRevRange
		$r = MRedis::instance();
		$key = 'h:3232323';
		$array = array('col'=>'1111','col2'=>'bbbb');
		$r->hmSet($key,$array);
		$result = $r->hGetAll($key);
		if(is_array($result) && $result['col'] == '1111')
		{
			$bol = true;
		}
		$this->assertEquals(true,$bol);
		
/*		
		$key = $r->randomKey();
		
		$surprise = $r->get($key);  // who knows what's in there.
		var_dump($key,$surprise);
		die;
		
		$key = "bdk:z:like:23333333333333333"; //zset
		
		$key1 = "bdk:z:like:23333333333333334"; //zset
		$key2 = "bdk:z:like:23333333333333335"; //zset
		
		$type1 = '11111111111111111';
		$type2 = '11111111111111112';
		$type3 = '11111111111111113';
		$type4 = '11111111111111114';
		// user 2333333333333333333 like 11111111111111111  score is 1
		$r->zAdd($key,1,$type1);
		$r->zAdd($key,30,$type2);
		$r->zAdd($key,5,$type3);
		$r->zAdd($key,10,$type4);
		
		$r->zAdd($key1,1,$type1);
		$r->zAdd($key1,30,$type3);
		
		$r->zAdd($key2,1,$type1);
		$r->zAdd($key2,30,$type2);
		
		//asc 
		$result = $r->zRange($key,0,-1);
		//desc true or false is the same result
		$resultzrev = $r->zRevRange($key,0,-1,true);
		// where score>0 and score<=29 
		$resultbyscore = $r->zRangeByScore($key,0,29);
		//select count(*) from xxx where score>0 and score<=5
		$resultzcount = $r->zCount($key,0,5);
		//delete from xxx where score>0 and score<=1 
		$resultzdeleterangebyscore = $r->zDeleteRangeByScore($key,0,1);
		//delete from xxx where id>0 limit 2
		$resultzdeleterangebyrank = $r->zDeleteRangeByRank($key,0,1);
		//select count(*) from xxx
		$resultzsize = $r->zSize($key);
		//select score form xxx where xxx and type = type1
		$resultzscore = $r->zScore($key,$type1);
		//get the asc rank key
		$resultzrank = $r->zRank($key,$type2);
		$resultzrevrank = $r->zRevRank($key,$type2);
		//zincby
		$resultzincby = $r->zIncrBy($key,1,$type1);
		//zUnion 
		$resultzunion = $r->zUnion($key,array($key1,$key2));
		//zunion score>5 limit 1
		$resultzunionscore = $r->zUnion($key,array($key1,$key2),array(5,1));
		//z intersection
		$resultzinter = $r->zInter($keyinter1,array($key1,$key2));
		//?/
		$resultzinterrange = $r->zInter($keyinter2,array($key1,$key2),array(1,1));
		//order by score asc
		$resultzinterrangemin = $r->zInter($keyintermin,array($key1,$key2),array(1,5),'min');
		//order by score desc
		$resultzinterrangemax = $r->zInter($keyintermax,array($key1,$key2),array(1,5),'max');
		
		var_dump($resultzunion);die;
		var_dump($result,$resultzrev,$resultbyscore,$resultzcount,$resultzdeleterangebyscore);
	*/
	}
}