<?php
// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <517577550@qq.com>
// +----------------------------------------------------------------------
/**
 * SignInAction
 * @author xinqiyang
 * @date   2010-4-8
 *
 */
class SignupAction extends AppBaseAction {
	function index()
	{
		$this->t();
	}
	/**
	 * 注册用户
	 */
	public function signup()
	{
		$d = D('user');
		//设置默认的用户名
		$_POST['cnname'] = $_POST['enname'];
		if($d->create())
		{
			//获取用户注册时候的地址信息
			$city = get_city();
			$code = md5(rand(100,999).time());
			$d->checkcode = $code;
			$d->locationid = $city['id'] ? $city['id'] : 0;
			$d->city = $city['name'] ? $city['name'] :'';
			$uid = $d->add();
			if($uid)
			{
				$mail = $_POST['email'];
				$map['mail'] = $mail;
				$map['title'] = "我是买家 用户注册激活邮件！";
				$map['body'] = "<img src='http://res.woshimaijia.com/Resource/images/nav/logo.gif' title='我是买家' /><br />
				<h1>我是买家    买家体验分享社区<br /><br /><br /><h1>点击激活 我是买家 帐号<a href='http://woshimaijia.com/index.php?m=signin&a=validateuser&email=$mail&code=$code'  target='_blank'>激活我是买家帐号 </a> 
				<br />如果无法点击 请复制以下链接到浏览器地址栏http://woshimaijia.com/index.php?m=signin&a=validateuser&email=$mail&code=$code"; //邮件内容;
				//发送验证邮件
				//TODO:测试完成后开启验证
				wsmjsendmail($map);
				//exit;
				//跳转到激活界面
				$this->redirect('active',array('mail'=>$mail));
			}else{
				$this->error($d->getDbError());
			}
		}else{
			//返回错误内容
			$this->error($d->getError());
		}
	}

	/**
	 * 激活系统
	 */
	public function active()
	{
		$this->t();
	}


	/**
	 * 重新发送邮件
	 */
	public function resend()
	{
		$mail = $_GET['email'];
		$code = M('user')->field('active,checkcode')->where("email=$email")->find();
		if($code['checkcode'] && (!$code['active']))
		{
				
			$map['mail'] = $mail;
			$map['title'] = "我是买家 用户注册激活邮件！";
			$map['body'] = "<h1>点击激活 我是买家 帐号<a href='http://woshimaijia.com/index.php/Sign/validateuser/email/$mail/code/$code'  target='_blank'>激活我是卖家帐号 </a> <br />如果无法点击 请复制以下链接到浏览器地址栏http://woshimaijia.com/index.php/Sign/validateuser/email/$mail/code/$code  "; //邮件内容;

			wsmjsendmail($map);
			//跳转到激活界面
			$this->redirect('active',$email);
		}else{
			$this->assign('jumpUrl',__APP__.'/sign');
			$this->error('邮箱错误或者已经激活');
		}
	}


	/**
	 * 验证用户邮箱
	 */
	public function validateuser()
	{
		//验证邮件URL中的参数
		$map['email'] = $_GET['email'];
		$map['checkcode'] = $_GET['code'];
		$d = D('user');
		$result = $d->where($map)->find();
		if($result)
		{
			//设置激活
			$lable = $d->where($map)->setField(array('status','checkcode'),array('1',''));
			
			if($lable)
			{
				$this->redirect('login/index',array('email'=>$map['email']));
			}else{
				$this->assign('jumpUrl',__APP__.'/sign/');
				$this->error('验证码错误');
			}
		}else {
			//
			$this->assign('jumpUrl',__APP__);
			$this->error('已验证');
		}

	}
	/**
	 * 验证邮箱的唯一性
	 * 使用ajax返回
	 */
	function checkemail()
	{
		echo 'success';
		die;
		$email = $_GET['email'];
		$u = M('user');
		$condition['email'] = $email;
		$result = $u -> where($condition)->count();
		echo  $result == 0 ? 'success' : L('signin_isused');
	}
	
	/**
	 * check validate user name
	 * check validate usre name of the register
	 */
	function checkname()
	{
		echo 'success'; //'用户名已用请换一个'
		die;
	}
	
}


?>
