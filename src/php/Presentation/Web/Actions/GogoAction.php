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
 * 逛逛首页
 * @author xinqiyang
 * @date   2010-7-2
 *
 */
class GogoAction extends AppBaseAction
{
	function _bf_deal($model)
	{
		switch($model)
		{
			case 'url':
				if(!$_POST['id'])
				{
					//新增时候默认赋值
					$_POST['gonum'] = 1;
					
					//判断是否唯一
					$pattern="/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/";
					if(preg_match($pattern,$_POST['domain']))
					{
						$result = checkDomain($_POST['domain']);
						if($result)
						{
							$this->error('您录入的站点别人已经分享过了,请录入其他的网址,谢谢');
						}
					}else{
						$this->error('网址不能为空或者格式错误,必须带http://');
					}
					
					//保存域名
					$_POST['domain'] = getHost($_POST['domain']);
					
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
			case 'url':
				if($type == 1)
				{
					//新增则逛数加1
					D('user')->setInc('gogonum','id='.$this->getuid());	
					
				}
				if($img)
				{
					$this->redirect('album/cuticon',array('image_id'=>$img,'model'=>$model,'goto'=>$id));
				}else{
					$this->redirect('gogo/showurl/id/'.$id);
				}
				break;
		}
	}
	
	/**
	 * 显示首页
	 */
	function index()
	{
		$d = D('url');
		$ids = $d->field('id')->limit(100)->select();
		$urls = $d->mget(arraytostr($ids));
		$gogos[0] = list_search($urls,array('category_id'=>1)); //$d->getUrls($d->field('id')->where('category_id=1')->select());
		$gogos[1] = list_search($urls,array('category_id'=>2));//$d->getUrls($d->field('id')->where('category_id=2')->select());
		$gogos[2] = list_search($urls,array('category_id'=>3)); //$d->getUrls($d->field('id')->where('category_id=3')->select());
		//加载逛逛的信息
		//dump($d->getUrls($ids));
		$this->assign('gogo',$gogos);
		
		$this->page = array('title'=>'逛逛','tags'=>'逛逛,逛网店,我是买家','desc'=>'我的买家,买家分享社区');
		
		$this->t();
	}
	
	/**
	 * 显示URL
	 */
	function showurl()
	{
		$id = (int)$_GET['id'];
		if($id)
		{
			$d = D('url');
			$surl = $d->get($id);
			$this->assign('vo',$surl);
			$this->assign('comment',D('comment')->getSubComments(strin($id),'url',20));
			
			//显示下面加载的用户信息
			$uam['gonum'] = $d->getUserAndModel('url',$id,'gonum');
			
			$uam['goodnum'] = $d->getUserAndModel('url',$id,'goodnum');
			//dump($uam['goodnum']);
			if($surl['category_id'] == '1' || $surl['category_id'] == '3' )
			{
				$uam['buynum'] = $d->getUserAndModel('url',$id,'buynum');
			}
			//dump($uam['buynum']);
			$this->assign('uam',$uam);
			
			//逛过这里的人还逛过那些地方
			//$otherurls = $d->getuserUrls(strin($uam['goodnum']));
			//dump($otherurls);
			//dump($d->getLastSql());
			//$this->assign('otherurls',$otherurls);
			
			//显示今天的团购信息
			//指定团购发布用户信息的网站标志
			//TODO:需要修改ID
			if($surl['category_id'] ==3)
			{
				//TODO:显示右侧的商品信息
				$todaygoods = D('goods')->get(414);
				//var_dump($todaygoods);
				
			}else{
				$todaygoods = D('goods')->get(415);
			}
			$this->assign('goods',$todaygoods);
			
			//show user TODO:需要添加加为朋友的功能,呵呵
			$this->assign('user',D('user')->get($surl['user_id']));
			
			//TODO:这样做感觉性能很差,数组被复制了一次
			$this->page = $surl;
			$this->t();
			
		}
	}
	
	
	
	/**
	 * 用户的动作信息记录
	 */
	function clickdo()
	{
		
	}
	
	
}
 
?>