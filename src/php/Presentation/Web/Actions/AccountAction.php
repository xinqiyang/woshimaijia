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
 +------------------------------------------------------------------------------
 * UserAction
 +------------------------------------------------------------------------------
 * @category User
 * @package  Lib
 * @subpackage
 * @author   xinqiyang <517577550@qq.com>
 +------------------------------------------------------------------------------
 */
class AccountAction extends AppBaseAction
{


	public function index()
	{
		$this->page = array('title'=>'我是买家 用户中心','tags'=>'逛逛,逛店,逛街,晒晒,分享,购物体验分享,我是买家','desc'=>'我的买家,买家分享社区');
		
		$this->t();
	}
	public function uploadicon()
	{

		$this->page = array('title'=>'上传我的头像','tags'=>'上传头像,我是买家','desc'=>'我的买家,买家分享社区');
		
		$this->t();
	}
	public function setting()
	{
		$d = D('user');
		$this->assign('vo',$d->get($this->getuid()));
		$this->page = array('title'=>'设置个人信息','tags'=>'设置个人信息,我是买家','desc'=>'我的买家,买家分享社区');

		$this->t();
	}

	public function _bf_update($a)
	{
		switch($a)
		{
			case 'user':
				if(ACTION_NAME =='upd_user')
				{
					//获取用户ID,保证可以更新成功
					$_POST['id']=$this->getuid();
				}
				//dump($_POST);exit;
				break;
		}
	}

	public function _af_update($a)
	{
		switch($a)
		{
			case 'upd_user':
				$this->changeuinfo();
				break;
		}
	}

	/**
	 * 头像上传方法
	 */
	public function cuticon()
	{
		$image_id = $this->upload('User',false);
		$this->assign('image_id',$image_id);
		
		$this->page = array('title'=>'头像剪切','tags'=>'头像剪切,我是买家','desc'=>'我的买家,买家分享社区');
		
		$this->t();

	}

	function setavatar()
	{
		if(!empty($_REQUEST['cut_pos']))
		{
			import('ORG.Util.ImageResize');

			$imgresize = new ImageResize();
			$imgresize->load(getUImage($_POST['image_id'],'',false)); //载入原始图片

			$posary=explode(',', $_REQUEST['cut_pos']);
			foreach($posary as $k=>$v) $posary[$k]=intval($v); //获得缩放比例和裁剪位置

			if($posary[2]>0 && $posary[3]>0) $imgresize->resize($posary[2], $posary[3]); //图片缩放

			//用户头像的命名规则
			$uico = D('image')->find($_POST['image_id']);

			//保存160*160的大图
			$imgresize->cut(160, 160, intval($posary[0]), intval($posary[1]));
			$large = 'l_'.$uico['filename'];

			//$imgresize->display();exit;
			$imgresize->save($uico['url'].'//'.$uico['model'].'//spic//'.$large);
			//保持80的中图
			$imgresize->resize(80, 80);
			$normal = $uico['filename'];
			$imgresize->save($uico['url'].'//'.$uico['model'].'//spic//'.$normal);
			//保存48*48的小图
			$imgresize->resize(48, 48);
			$meduim = 'm_'.$uico['filename'];
			$imgresize->save($uico['url'].'//'.$uico['model'].'//spic//'.$meduim,true);

			//写入数据库
			$user = D('user');
			//删除原来的头像图片

			$user->setField('image_id',$_POST['image_id'],'id='.$this->getuid());
			//设置SESSION信息
			$user->rm($this->getuid());
			$this->changeuinfo();
			$this->redirect('index');
		} else {
			//报告错误
			//跳到头像上传那去
			$this->error('get error');
		}

	}


	public function changepass()
	{
		$this->page=array('title'=>'修改密码','tags'=>'修改密码','desc'=>'修改密码');
		$this->t();
	}
	
	/**
	 * 修改密码
	 */
	public function changepassword()
	{
		$this->page = array('title'=>'修改密码','tags'=>'修改密码,我是买家','desc'=>'我的买家,买家分享社区');
		
		$pass =md5($_POST['password']);
		$repass = md5($_POST['newpassword']);
		if(isset($pass) && !empty($repass))
		{
			$password = $this->find('user','id='.$this->getuid(),'password');
		}

		if($pass == $password['password'])
		{
			if(strlen($_POST['newpassword']) >= 5)
			{
				$m = D('user');
				$m ->setField('password',$repass,'id='.$this->getuid());
				$this->assign('jumpUrl','__APP__/login/logout');
				$this->success('密码修改成功,需要重新登陆');
			} else {
				$this->error('新密码输入错误，应该大于5位小于20位');
			}
		}else {
			$this->error('原密码错误');
		}
	}
	
	public function seturl()
	{
		$this->page = array('title'=>'设置首页网址导航','tags'=>'设置网址导航','desc'=>'我的买家,买家分享社区');
		$this->t();
	}


}

?>