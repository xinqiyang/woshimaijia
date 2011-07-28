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
 * Group
 * @author xinqiyang
 * @date   2010-4-14
 *
 */
class GroupAction extends AppBaseAction {

	protected function _baseinit()
	{
		//初始化父类信息
		parent::_baseinit();

	}


	function _bf_show($param)
	{
		switch ($param)
		{
			case 'topic':
				$topic['group_id'] = (int)$_GET['group_id'];
				$this->assign('topic',$topic);
				$this->page = array('title'=>'发表话题','tags'=>'侃侃,小组,我是买家,团购社区','desc'=>'发表话题');
					
				break;
		}
	}


	/**
	 * 前置函数
	 * @param $param
	 */
	function _bf_deal($param)
	{
		//extract($param);
		switch($param)
		{
			case 'topic':
				//判断用户是否在群组里面
				$d = D('userandgroup');
				$isin =$d->where('`user_id`='.$this->getuid().' and status =1 and `group_id`='.$_REQUEST['group_id'])->find();
				//dump($d->getLastSQL());
				if(!$isin)
				{
					//$this->error('请先加入群组');
					//执行加入群组操作
					$_GET['group_id'] = $_REQUEST['group_id'];
					$this->join(true);
				}
				

				break;
			case 'group':

				if(!$_REQUEST['id'])
				{
					//如果超过5个群组则无法继续创建了
					$count =D('userandgroup')->where('`user_id`='.$this->getuid().' and status =1')->select();
					//$countgroup=count($count);
					// dump(count($count));
					if(count($count) > 4)
					{
						$this->error('您已经创建了5个群了,不能在创建了');
					}
					//设置成员为1
					$_POST['membercount'] = 1;
					//设置管理员ID
					$_POST['adminids'] = $this->getuid();
				}
				break;
			case 'post':
				$d = D('userandgroup');
				$groupid = D('topic')->getField('group_id','id='.$_POST['topic_id']);
				$isin =$d->where('`user_id`='.$this->getuid().' and status =1 and `group_id`='.$groupid)->find();
				//dump($d->getLastSQL());
				if(!$isin)
				{
					//$this->error('请先加入群组');
					$_GET['group_id'] = $groupid;
					$this->join(true);
				}
				break;
		}
	}

	/**
	 * 后置函数
	 * @param $param
	 */
	function _af_deal($param)
	{
		//dump($param);
		extract($param);
		switch($model)
		{
			case 'topic':
				//判断用户是否在群组里面
				if($type == 1)
				{
					$_POST['istopic']='1';
					$_POST['topic_id']=$id;
					$d = D('post');
					if($d->create())
					{
						$d->add();
						//增加话题数
						D('group')->setInc('topiccount','id='.$_POST['group_id']);
					}
					
				}else{
					$mapc['content'] = $_POST['content'];
					$pp = D('post');
					$pp ->where("istopic=1 and topic_id=$id and user_id=" .$this->getuid())->save($mapc);
					//dump($pp->getLastSQL()); exit;
					//dump('aaa');
				}
				$this->redirect('group/showtopic',array('id'=>$id));

				break;
			case 'post':
				$s = D('topic');
					
				$idss = $s->setInc('postcount',"id=".$_POST['topic_id']);
				//dump($idss.'   '.$d->getLastSQL());exit;
				$s->where("id=".$_POST['topic_id'])->save(array('lastreplytime'=>time()));
				break;
			case 'group':
				if($type == 1)
				{
					//新建完成,写入关联
					$rel = D('Userandgroup');
					$_POST['group_id'] = $id;
					if($rel->create())
					//TODO:这里要保证写入成功
					$rel->add();

				}
				if($img)
				{
					$this->redirect('album/cuticon',array('image_id'=>$img,'model'=>$model,'goto'=>$id));
				}else{
					$this->redirect('group/showgroup',array('id'=>$id));
				}
				break;
		}
	}


	/**
	 * 首页
	 */
	function index()
	{

		$t = D('group');
		//组成模块
		$this->assign('group',$t->getGroup(strin($t->field('id')->where('status=1')->select())));

		//我的小组最新话题(分页处理)
		//列出小组话题 20条  显示更多小组讨论

		$ug = D('userandgroup');

		$where = $this->getuid() ? $this->getuid() : '1';
		$ids = $ug->field('group_id')->where('user_id='.$where)->select();
		$list =$t->getTopics(strin($ids,'group_id'));

		$this->assign('list',$list);

		//最近活动的大家
		//$userids = $ug->field('user_id')->where('group_id in '.strin($ids,'group_id'))->select();
		$this->assign('members',$t->getMembers(strin($ids,'group_id')));
		//大家也喜欢去的小组
		$this->assign('toogroups',$t->getGroup(strin($ids,'group_id')));
		if($this->getuid())
		{
			//我的小组
			$myids = $t->field('id')->where('status=1 and user_id='.$this->getuid())->select();
			$this->assign('mygroups',$t->getGroup(strin($myids)));
		}

		$this->page = array('title'=>'侃侃组','tags'=>'侃侃,小组,我是买家,团购社区','desc'=>'我的买家分享,大家的体验分享社区');

		$this->t();
	}
	/**
	 * 搜索
	 */
	function search()
	{
		//搜索小组,搜索发言

	}


	/**
	 * 小组页面
	 */
	function showGroup()
	{
		$id = (int)$_GET['id'];
		if($id)
		{
			$d=D('group');
			$group = $d->find($id);
			$this->assign('gg',$group);

			$this->assign('list',$d->getTopics(strin($id)));
			$this->assign('members',$d->getMembers(strin($id)));
			$this->page = $group;
			$this->t();

		}
	}

	function showTopic()
	{
		$id = (int)$_GET['id'];
		{
			$d = D('topic');
			$topic=$d->getTopic($id);
			$isadmin = '';
			$owner = '';
			if($topic)
			{
				$content = $d->getPosts($id);
				if($this->getuid())
				{
					$adminids = $d->getManager($id);
					$isadmin = in_array($this->getuid(),$adminids);
					//dump($isadmin);
				}else{
					$isadmin = false;
				}
				$this->assign('isadmin',$isadmin);
				$this->assign('topic',$topic[0]);
				$this->assign('contents',$content);
				$this->assign('tuid',$this->getuid());
				$this->page = $topic[0];
				$this->t();
			}
				
		}
	}

	/**
	 * 小组成员列表
	 */
	function members()
	{
		//组长  管理员  会员列表(分页显示)
		$id = (int)$_GET['group_id'];
		if($id)
		{
			//
			$d = D('group');

			$this->assign('members',$d->getMembers($id));
		}
		//---搜索模块

		//快捷链接

	}




	/**
	 * 加入小组
	 */
	function join($noshow)
	{
		if((int)$_GET['group_id'])
		{

			//ajax操作
			$d = D('userandgroup');
			$data['user_id'] = $this->getuid();
			$data['status'] = 1;
			$data['createtime'] = time();

			$data['group_id'] = $_GET['group_id'];

			$isin =$d->where('`user_id`='.$data['user_id'].' and status =1 and `group_id`='.$data['group_id'])->find();
			//dump($isin);
			$count = $d->where('`user_id`='.$data['user_id'])->count();

			if(!$isin)
			{
				//TODO:设置可以加入最多的小组
				if((int)$count < 250)
				{
					if($d->add($data))
					{
						//成员加一
						D('group')->setInc('membercount','id='.$data['group_id']);
						if(!$noshow)
						{
							$this->success('加入成功!');
						}
					}else{
						//dump($d->getLastSQL());
					}
				}else{
					$this->success('您参加了讨论组超过了250个,请退出一些后在添加');
				}
			}else{
				$this->success('您已经加入本组了');
			}

		}

	}

	/**
	 * 退出群组
	 */
	function quite()
	{
		//ajax操作
		if((int)$_GET['group_id'])
		{
			$d = D('userandgroup');
			$data['group_id'] = $_GET['group_id'];
			$data['user_id'] = $this->getuid();
			$isin = $d->where($data)->find();
			$gc = D('group')->getField('user_id','id='.$_GET['group_id']);
			if(is_array($isin) && ($isin['status']<>2) && $gc <> $_GET['group_id'])
			{
				$map['id'] = $isin['id'];
				//$map['status'] = 2;
				$result = $d->where($map)->delete();
				if($result)
				{
					D('group')->setDec('membercount','id='.$_GET['group_id']);
					$this->assign('jumpUrl',__APP__.'/group/index');
					$this->success('退出成功');
				}else{
					$this->error('系统错误');
				}
			}else{
				$this->error('参数错误或者已经退出自己的小组无法退出');
			}

		}
	}


	/**
	 * 管理信息
	 */
	function manage()
	{
		if($this->getuid())
		{
			
		
		$type = $_GET['type'];
		$id = (int)$_GET['id'];
		$cid = (int)$_GET['cid'];
		$group_id = (int)$_GET['gid'];
		$model = $_GET['model'];
		if($id)
		{
			//TODO:现在先验证单用户
			$t = D('topic');
			$adminids = $t->getManager($id);
			$isadmin = in_array($this->getuid(),$adminids);
			if($isadmin)
			{
				$status = '';
				$str ='操作失败';
				$jump ='';
				$field = '';
				if($model == 'topic' && $type)
				{
						
					//验证权限
					switch($type)
					{
						case 'block':
							//设置状态为 
							$str ="禁止回应";
							$field = 'islock';
							$status = 1;
							break;
						case 'noblock':
							//设置状态为 
							$str ="开启回应";
							$status = 0;
							$field = 'islock';
							break;

						case 'del':
							$str ="删除话题";
							$field = 'status';
							$status = 2;
							$jump= $group_id;
							break;
						case 'top':
							$str ="置顶话题";
							$field = 'istop';
							$status = 1;
							break;
						case 'notop':
							$str ="取消置顶";
							$field = 'istop';
							$status = 0;
							break;
					}
					//设置标志位
					if($type && $field)
					{
						$t->setField($field,$status,"id=$id");
						//$t->rm($id);
						if($jump){
							//删除的话就减少一个
							D('group')->setDec('topiccount',"id=$group_id",1);
							$this->assign('jumpUrl',U('group/showgroup',array('id'=>$group_id)));
						}
					}
					
				}else{
					if($model == 'post')
					{
						$c = D('post');
						$str='评论删除 ';
						$t->setDec('postcount',"id=$id",1);
						$c->setField('status',2,"id=$cid");
					}
				}

				$this->success($str.'设置成功了');
			}else{
				$this->error('No permission');
			}
		}
		}
	}


}


?>