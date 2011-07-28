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
 * 用户主页
 * @author xinqiyang
 * @date   2010-7-7
 *
 */

class PeopleAction extends AppBaseAction
{

	public function index()
	{

		//加载用户信息
		$d = D('user');
		$ids = $d->field('id')->where("status =1 and image_id <> ''")->limit(8)->select();
		$this->assign('users',$d->getUsers($ids));
		
		$newids = $d->field('id')->where("status =1 and image_id <> ''")->limit(8)->order('createtime desc')->select();
		$this->assign('newusers',$d->getUsers($newids));
		

		$activeids = $d->field('id')->where("status =1 and image_id <> ''")->limit(8)->order('lastlogintime desc')->select();
		$this->assign('activeusers',$d->getUsers($activeids));
		
		$gogousers = $d->field('id')->where("status =1 and image_id <> ''")->limit(8)->order('gogonum desc')->select();
		$this->assign('gogousers',$d->getUsers($gogousers));
		
		//加载我说,大家说.....
		$this->assign('says',D('say')->getSays(strin($ids)));

		$this->page = array('title'=>'大家','tags'=>'买家,买家团,买家社区','desc'=>'我的买家 大家,大家的分享社区');

		$this->t();
	}

	function space()
	{
		$id = (int)$_GET['id'];
		$user = $this->find('user','id='.$id);
		//dump($user);
		$this->assign('user',$user);
		$this->page['title'] = $user['cnname'].'的空间';
		$this->page['tags'] = $user['cnname'].',我是买家';
		$this->page['desc'] = $user['usertxt'];
		//加载数据信息
		$d = D('userandmodel');
		$ids = $d->field('distinct model_id')->where("user_id='$id' and model='url'")->limit(24)->select();
		$gobuydata[0] = D('url')->newgetUrls(strin($ids,'model_id'));
		$this->assign('gobuydata',$gobuydata);
		
		//我晒的
		$likeids = $d->field('distinct model_id')->where("user_id='$id' and model='goods' and linktype='likenum'")->limit(5)->select();
		//dump($d->getLastSQL());
		$wantids = $d->field('distinct model_id')->where("user_id='$id' and model='goods' and linktype='wantnum'")->limit(5)->select();
		$ownerids = $d->field('distinct model_id')->where("user_id='$id' and model='goods' and linktype='ownernum'")->limit(5)->select();
		
		$likegoods = D('goods')->newgetGoods(strin($likeids,'model_id'));
		$wantgoods = D('goods')->newgetGoods(strin($wantids,'model_id'));
		$ownergoods = D('goods')->newgetGoods(strin($ownerids,'model_id'));
		
		$this->assign('likegoods',$likegoods);
		$this->assign('wantgoods',$wantgoods);
		$this->assign('ownergoods',$ownergoods);
		//我支持的品牌
		$brandids = $d->field('distinct model_id')->where("user_id='$id' and model='brand'")->limit(5)->select();
		$brand = D('brand')->newgetBrands(strin($brandids,'model_id'));
		//dump($brand);
		$this->assign('brand',$brand);
		
		//我参加的小组
		$g = D('userandgroup');
		$gg =D('group');
		$groupids = $g->field('distinct group_id')->where("user_id='$id'")->limit(8)->order('rand()')->select();
		$gids =strin($groupids,'group_id');
		$grouplist = $gg->getGroup($gids);
		$this->assign('mygroups',$grouplist);
		//我的发言
		$t = D('topic');
		$tids = $t->field('id')->where("user_id='$id' and group_id in $gids")->limit(10)->select();
		$topic = $t->getMyTopics(strin($tids));
		$this->assign('topiclist',$topic);
		
		
		//加载我的朋友
		$friendids = $d->field('distinct model_id')->where("user_id='$id' and model='user'")->select();
		//当前操作用户
		$afriendids = $d->field('distinct model_id')->where("user_id='".UserID()."' and model='user'")->select();
		$rel = '';
		if(in_array($id,datasetToArray($afriendids,'model_id')))
		{ 
			$rel ="<br />已关注^-^ <a href=\"".__URL__."/nofocus/id/$id\">取消关注</a> <br />
			<a href=\"".__APP__."/mail/write/id/$id\">给".$user['cnname']."发消息</a>
			";
		}elseif($id == UserID()){
			//$rel='null';
		}else{
			$rel="
			<br /><br />
			<span id=\"focusid\"></span>
			<br />
			<button id=\"btnfocus\" type=\"button\" class=\"btn-focus\" onclick=\"dofocus('".$user['id']."')\">加为关注</button> <br /> 
			<a href=\"".__APP__."/mail/write/id/$id\">给".$user['cnname']."发消息</a>
			";
		}
		$this->assign('relfriend',$rel);
		
		$this->assign('focuspeople',D('user')->newgetUsers(strin($friendids,'model_id')));

		//加载我说,大家说.....
		$this->assign('says',D('say')->getMySays(strin($id)));
		
		$this->t();
	}

	function gomore()
	{
		$tpl = "People:gomore";
		$this->display($tpl);
	}
	
	function mygroup()
	{
		
		$this->page = array('title'=>'我的小组','tags'=>'侃侃组,小组,我是买家侃侃组','desc'=>'我是买家侃侃组');
		$this->t();
	}
	
	/**
	 * 我的晒晒
	 */
	function mygoods()
	{
		
		$this->page = array('title'=>'我晒的东西','tags'=>'晒晒,晒单,我是买家晒晒','desc'=>'我是买家晒晒');
		$this->t();
	}
	
	function mybrand()
	{
		$this->page = array('title'=>'我支持的品牌','tags'=>'我支持,买过,我是买家品牌','desc'=>'我是买家品牌');
		$this->t();
	}
	
	function myurl()
	{
		$this->page = array('title'=>'我常逛的地方','tags'=>'逛逛,网址,我是买家逛逛','desc'=>'我是买家大家经常去逛的网站网店');
		$this->t();
	}
	
	/**
	 * 我的相册
	 */
	function myalbum()
	{
		$this->page = array('title'=>'我的相册','tags'=>'我的相册,我是买家','desc'=>'我是买家大家经常去逛的网站网店');
		$this->t();
	}
}

?>