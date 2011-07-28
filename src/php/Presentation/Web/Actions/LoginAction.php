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
 * LoginAction
 * @author xinqiyang
 * @date   2010-4-8
 *
 */
class LoginAction extends AppBaseAction {

	function index()
	{
		$mail = '';
		$cookieinfo = cookie('wsmjemail');
		if(isset($cookieinfo) || isset($_GET['email']))
		{
			$cookieinfo = txtdecode(cookie('wsmjemail'));
			$mail = $cookieinfo ? $cookieinfo : $_GET['email'];
		}
		$this->t();
	}

	/**
	 * checklogin 检测登陆
	 */
	public function checklogin()
	{
		if(!$this->getuid())
		{
			$email = isset($_POST["email"]) ? $_POST["email"] : cookie('wsmjemail');
			$password = isset($_POST["password"]) ? md5($_POST["password"]) : txtdecode(cookie('wsmjpass'));

			if(!empty($email) && !empty($password))
			{
				$map['email'] = $email;
				$map['password'] = $password;
				$user = userInfo($map);
				//dump($user);exit;
				if(is_array($user))
				{
					//TODO:判断是否激活需要修改为 1
					if($user['status']=='1')
					{
		
						$city = get_city();
						$myuser = D('user');
						if(($user['locationid']== '0') || empty($user['city']))
						{
							//更新用户登陆信息
							$myuser->execute("UPDATE `sz_user` SET `lastlogintime`='".time()."', `city` = '".$city['name']."', `locationid` = '".$city['id']."',`lastloginip`='".get_client_ip()."' where id=".$user['id']);
						}else{
							//更新用户登陆信息
							$myuser->where("id=".$user['id'])->setField(array('lastlogintime',time()),array('lastloginip',get_client_ip()));
							
						}
						
						//设置session
						setUserinfo($user);
						//dump(D('user')->getLastSQL()); exit;
						
						//保存下地区信息
						
						//保存用户COOKIE
						cookie('wsmjemail',txtencode($email));
						if($_POST["autologin"] == "on")
						{
							cookie('wsmjpass',txtencode($password));
						}
						unset($email,$password);
						//登陆后跳转的页面,判断资料情况在跳转相应界面

						$this->redirect('index/index');
					}else{
						//访问邮箱激活帐号,传入邮箱
						$this->redirect('signin/active',array('email'=>$email));
					}
				} else {
					//跳转到登陆的页面
					$this->error('邮箱或者密码错误');
				}
			} else {
				//输出错误信息
				$this->redirect('login/index');
			}
		}else{
			//默认跳转判断
			//$this->redirect('people/space/id/'.$this->getuid());
		}
	}

	/**
	 * logout system
	 */
	public function logout()
	{
		Session::destroy();
		cookie("wsmjemail",'');
		cookie("wsmjpass",'');
		$this->redirect('login/index');
	}
	
	/**
	 * login forget password
	 */
	public function forgetpass()
	{
		/*
		if($this->ispost())
		{
			//TODO:找回密码的逻辑,判断邮箱是否存在,
			$mail = trim($_POST['email']);
			$user = D('user')->where("email='$mail'")->find();
			if(is_array($user))
			{
				$code = md5(time());
				//写入用户表
				$user->passwordcode = $code;
				$user->save();
				//发送右键
				$map['mail'] = $mail;
				$map['title'] = "我是买家 用户找回密码邮件！";
				$map['body'] = "<img src='http://woshimaijia.com/Resource/images/nav/logo.gif' title='我是买家' /><br /><h1>我是买家    买家体验分享社区<br /><br /><br /><h1>点击重设 我是买家 帐号密码<a href='http://woshimaijia.com/index.php/login/resetpassword/email/$mail/code/$code'  target='_blank'>重设我是买家帐号密码 </a> <br />如果无法点击 请复制以下链接到浏览器地址栏http://woshimaijia.com/index.php/login/resetpassword/email/$mail/code/$code  "; //邮件内容;
				wsmjsendmail($map);
				//TODO:这里得掉到哪里去呢?
				$this->assign('jumpUrl',__ROOT__);
				$this->success('重新设置密码右键发送成功,请查看邮箱');
			
			}else{
				$this->error("邮箱不存在,请重新输入");
			}
			
		}
		*/
		$this->t();
	}
}


?>