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


class ScwsTest extends PHPUnit_Framework_TestCase
{
	public function testwordtype()
	{
		$content = "我真的挺喜欢真维斯的品牌的，但是感觉PEAK也还是不错ABC的，还是挺喜欢的呢，大家说呢";
		$type = 'feeling';
		$r = Scws::keywords($content, $type);
		var_dump($r);
		$this->assertEquals(true,is_array($r));
	}
	
	public function testkeywords()
	{
		$content = "我真的挺喜欢真维斯的品牌的，但是感觉PEAK也还是不错ABC的，还是挺喜欢的呢，大家说呢";
		$type = '';
		$r = Scws::wordType($content,$type);
		var_dump($r);
		$this->assertEquals(true,is_array($r));
	}
	
	/*
	public function testscws(){
		$so = scws_new();
		$so->set_charset('utf8');
		// 这里没有调用 set_dict 和 set_rule 系统会自动试调用 ini 中指定路径下的词典和规则文件
		$so->send_text("我是一个中国人,我会C++语言,我也有很多T恤衣服");
		while ($tmp = $so->get_result())
		{
			print_r($tmp);
		}
		$so->close();
	}
	*/
}