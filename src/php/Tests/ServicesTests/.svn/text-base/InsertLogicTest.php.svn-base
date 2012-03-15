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

class InsertLogicTest extends PHPUnit_Framework_TestCase 
{
	
	public function testaddProduct()
	{
		return ;
		$title = '测试产品11';
		$content = '测试产品的简介';
		$user_id = '1233333';
		$image_id = '123';
		$source = 'web';
		$brand_id = '232323';
		$url_id = '32323';
		$r = ProductLogic::addProduct($title, $content,$user_id,$image_id,$brand_id,$url_id,$source);
		$this->assertEquals(true,$r);
	}
	
	public function testaddTopic()
	{
		return ;
		$title = '我的测试标题';
		$content = '测试数据';
		$source = 'web';
		$user_id = '222222';
		$group_id = '111111';
		$r = TopicLogic::addTopic($title, $content, $source, $user_id, $group_id);
		$this->assertEquals(true,$r);
	}
	
	public function testaddMail()
	{
		$fromuid = '33333331';
		$touid = '4444441';
		$title = '我的测试邮件';
		$content = '我的测试邮件内容';
		$r = MailLogic::addMail($fromuid, $touid, $title, $content);
		$this->assertEquals(true,$r);
	}
	
	
	public function testaddImage()
	{
		return ;
		$filename='aaa';
		$desc='dddd';
		$remoteurl='323';
		$url='3333';
		$model='user';
		$user_id='3232323';
		$source = 'web';
		$r = ImageLogic::addImage($model, $user_id,$filename,$source,$desc,$remoteurl,$url);
		$this->assertEquals(true,$r>0);
	}
	
	public function testaddCompaign()
	{
		return ;
		$title='我的测试组织';
		$content = '我的测试组织的内容';
		$starttime='2011-09-10 10：00：00';
		$endtime='2012-09-10 10：00：00';
		$expiration='30';
		$user_id='333333';
		$source = 'wap';
		$r = CompaignLogic::addCompaign($title,$content,$user_id,$starttime,$endtime,$expiration,$source);
		$this->assertEquals(true,$r);
	}
		
	public function testaddGroup()
	{
		return ;
		$user_id='3333';
		$title='我的小组';
		$desc='我的小组的测试信息';
		$image_id='3232323';
		$enname='aaaaaaaaaaaaaa';
		$r = GroupLogic::addGroup($user_id, $title, $desc, $image_id,$enname);
		$this->assertEquals(true,$r);
		
	}
	
	public function testaddAd()
	{
		return ;
		$module='user';
		$action='index';
		$adcode='我的广告的代码';
		$adbegin='223233232';
		$adend='3332323';
		$services_id='33333';
		$position='aaaa';
		$r = AdLogic::addAd($module, $action,$adcode,$adbegin, $adend, $services_id, $position);
		$this->assertEquals(true,$r);
	}
	
	public function testaddContent()
	{
		return ;
		$module='aa';$action='bb';$title='我的东西东西啊';$tags='TAG的啊';$desc='内容啊';$content='我的额你若啊';$services_id='11111';
		$r = ContentLogic::addContent($module, $action, $title, $tags, $desc, $content, $services_id);
		$this->assertEquals(true,$r);
	}
	
	public function testaddReport()
	{
		return ;
		$user_id='3333';$uname='a';$ip='127.323,333.222';$typename='1';$url='http://www.cache.com';$reason='我的测试';
		$r = ReportLogic::addReport($user_id, $typename,$url,$reason,$uname,$ip);
		$this->assertEquals(true,$r);
	}
	
	
	public function testaddServices()
	{
		return ;
		$account='admin';$password=md5('admin');$groupid='1';
		$r = ServicesLogic::addSerivces($account, $password, $groupid);
		$this->assertEquals(true,$r);
	}
	
	public function testaddTree()
	{
		return ;
		$title='节点';$tags='节点TAG';$desc='AAAA';$parentid='0';$module='aaa';$action='bbb';$parameters='ccc';$value='dddd';$level='1';
		$r = TreeLogic::addTree($title, $tags, $desc, $parentid, $level,$module,$action,$parameters,$value);
		$this->assertEquals(true,$r);
	}
	
	public function testaddCount()
	{
		return ;
		$id = mt_rand(0, 1000000000);
		$r = CountLogic::addCount($id);
		$this->assertEquals(true,$r);
	} 
	
	public function testaddTag()
	{
		return ;
		$tag = '捷克琼斯';
		$r = TagsLogic::addTag($tag);
		$this->assertEquals(true,$r);
	}
	
	public function testaddAccount()
	{
		$account='admins12';
		$password=md5('admin');
		$screenname='我是管理员';
		$email='admin12@woshimaijia.com';
		$image_id=1111;
		$mobile='15010392795';
		$city='kunming';
		$from='wsmj';
		$ip='127.127.127.127';
		$source='web';
		$r = AccountLogic::addAccount($account, $password, $screenname, $email,$image_id, $city,$mobile,$from,$ip,$source);
		$this->assertEquals(true,$r);
		
	}
}