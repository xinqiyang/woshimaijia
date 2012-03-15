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

class AccountServiceTest extends PHPUnit_Framework_TestCase 
{
	
	public function testsignUp()
	{
		
		$data['id']=objid();
		$data['account']='scotoma';
		$data['password']=md5('heihei');
		$data['email']='scotoma@163.com';
		$data['mobile']='';
		$data['type']='1';
		$data['status']='0';
		$data['ip']='127.0.0.1';
		$data['image_id']='0';
		$data['screenname']='scotoma';
		
		$r = AccountService::signUp($data);
		var_dump($r);
	}
	
	public function testsessionget()
	{
		self::testsignup();
		$uinfo = Session::get('uinfo');
		$uid = Session::get('uid');
		var_dump($uinfo,$uid);
	}
	
	public function testupdateprofile()
	{
		$data['id']='13132553146912801';
		$data['sex']='1';
		$data['birthday']='1981-09-10';
		$data['createtime']=time();
		$data['score']='1';
		$data['money']='2';
		$data['lastlogintime']=time();
		$data['lastloginip']='127.0.0.1';
		$data['refereeid']='43132553146912801';
		$data['blogurl']='2222';
		$data['usertxt']='2222';
		$data['havemail']='1';
		$data['checkcode']='32323';
		$data['locationid']='1';
		$data['microblog']='4444';
		$data['qq']='2323';
		$data['msn']='323';
		$data['wangwang']='323';
		$data['mobile']='111111';
		$data['city']='111111';
		$r = AccountService::updateProfile($data);
		var_dump($r);
	}
	
	public function testchangepassword()
	{
		$data['id']='13132553146912801';
		$data['newpassword']=md5('lalala');
		$data['password']=md5('heihei');
		$r = AccountService::changePassword($data);
		var_dump($r);
	}
	
	
	public function testforgetpassword()
	{
		$data['id']='13132553146912801';
		$r = AccountService::forgetPassword($data);
		var_dump($r);
	}
	
	public function testchecklogin()
	{
		$data['email']='scotoma1@163.com';
		$data['password']=md5('lalala');
		$r = AccountService::checkLogin($data);
		var_dump($r);
	}
	
	public function testchangeemail()
	{
		$data['id']='13132553146912801';
		$data['email']= 'scotoma1@163.com';
		$r = BaseService::save('account', $data);
		var_dump($r);
	}
	
	public function testforbinaccount()
	{
		$data['id']='13132553146912801';
		$r = AccountService::forbidAccount($data);
		
		var_dump($r);
	}
	
	public function testaccount()
	{
		echo "fffffffff\n";
		$data['id']='13132553146912801';
		$r = AccountService::account($data);
		if($runTest){
			echo "run \n";
			$this->assertEquals(false,is_array($r));
		}
	}
	
	public function testuserinfo()
	{
		$data['id']='13132553146912801';
		$r = AccountService::userinfo($data);
		var_dump($r);
	}
	
	public function testaccountList()
	{
		$where = 'id>0';
		$r = AccountService::accountList($where);
		var_dump($r);
	}
	
	public function testnewaccount()
	{
		$r = AccountService::newaccount();
		var_dump($r);
	}
	
	public function testaccountin()
	{
		$array = AccountService::accountList('id>0');
		$r = AccountService::accountin($array);
		var_dump($r);
	}
	
}