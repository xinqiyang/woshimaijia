<?php
// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet 
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://www.woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <517577550@qq.com>
// +----------------------------------------------------------------------
/**
 * 
 * @author xinqiyang
 * @date   2010-5-16
 *
 */
class MailAction extends AppBaseAction {
	
	function _baseinit()
	{
		parent::_baseinit();
		if(!$this->getuid())
		{
			$this->redirect('index/index');
		}
	}
	
	/**
	 * 消息首页 收件箱
	 */
	function index()
	{
		$mailnum = 0;
		$mail = D('mail')->getMails();
		//var_dump($mail);
		if($mail)
		{
			$mailnum = count(list_search($mail,array('status'=>'1')));
		}
		
		
		$this->assign('mail',$mail);
		$this->page = array('title'=>"我的收件箱(".$mailnum."未读)",'tags'=>'收件箱,我是买家','desc'=>'我的买家,买家分享社区');
		
		$this->t();
	}

	
	
	/**
	 * 选择好友
	 */
	function selectto()
	{
		$m = D('userandmodel');
		$ids = $m->field('model_id')->where("linktype='focus' and model='user' and user_id=".$this->getuid())->select();
		//dump($m->getlastSQL());
		$this->assign('friends',D('user')->newgetUsers(strin($ids,'model_id')));
		
		$this->page = array('title'=>"选择收件人",'tags'=>'选择收件人,我是买家','desc'=>'我的买家,买家分享社区');
		$this->t();
	}
	
	function write()
	{
		$id = (int)$_GET['id'];
		if($id)
		{
			$user =D('user')->getOneUser($id);
			if(is_array($user))
			{
			$this->assign('user',D('user')->getOneUser($id));
			//加载好友列表
			$this->page = array('title'=>'发新消息','tags'=>'发消息,我是买家','desc'=>'我的买家,买家分享社区');
			$this->t();
			}else{
				$this->assign('jumpUrl',__APP__.'/mail/index');
				$this->error('选择的收件人出现了点问题^-^!');
			}
		}
	}
	
	/**
	 * 发送消息
	 */
	function send()
	{
		$m = D('mail');
		if($m->create())
		{
			$id = $m->add();
			if($id)
			{
				//更新收件人的状态
				D('user')->setField('havemail','1','id='.$_POST['touid']);
				$this->success('发送成功');
			}else{
				$this->error('系统错误');
			}
		}else{
			$this->error($m->getError());
		}
		
	}
	
	function mail()
	{
		$id = (int)$_GET['id'];
		if($id)
		{
			$m=D('mail');
			$mail = $m->getMail($id);
			if(is_array($mail))
			{
				if($mail['status'] == '1')
				{
					//状态设置为已读   1 未读  2删除  3已读
					$m->setField('status','3','id='.$id);
				}
			}
			//dump($mail);
			$this->assign('vo',$mail);
			$this->page = array('title'=>'消息内容','tags'=>'消息,我是买家','desc'=>'我的买家,买家分享社区');
			
			$this->t();
		}
	}
}

 
?>