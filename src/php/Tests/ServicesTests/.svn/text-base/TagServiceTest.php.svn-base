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

class TagServiceTest extends PHPUnit_Framework_TestCase
{
	
	public function testaddtags()
	{
		return ;
		//
		for($i=0;$i<10;$i++){
			$array = array('id'=>objid(),'tag'=>'我的TAG'.mt_rand(0,1000),'tagcount'=>'0','status'=>0);
			$arrays[] = $array;
		}
		$r = TagsService::addTags($arrays);
		var_dump($r);
	}
	
	public function testgettags()
	{
		return ;
		$tagid0 = array('id'=>'13134284583413510');
		$tagid1 = array('id'=>'13134284583413970');
		//13134284583413970
		$r = TagsService::getTagsById(array($tagid0,$tagid1));
		var_dump($r);
	}
	
	public function testdestory()
	{
		return ;
		$array = array(array('id'=>'13134284583413510'));
		$id = 13134284583413970;
		$r = TagsService::destory($array);
		$r1 = TagsService::destory($id);
		var_dump($r,$r1);
	}
	
	public function testwords()
	{
		$content = "我还是很喜欢欧时力和ONLY的感觉 五季梦 感觉很一般啊，我之前买过了，乐町和Grand也不错的呢";
		$r = TagsService::getWords($content,'tags');
		var_dump($r);
		$this->assertEquals(true,is_array($r));
	}
	
}