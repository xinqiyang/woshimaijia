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
 * 晒晒首页
 * @author xinqiyang
 * @date   2010-7-2
 *
 */
class ShowAction extends AppBaseAction
{
	function _bf_deal($model)
	{
		switch($model)
		{
			case 'goods':
				if(!$_POST['id'])
				{

					
					//判断是否存在URL,如果没有存在则添加URL
					$isexist = checkDomain($_POST['fromurl']);
					if(is_array($isexist))
					{
						//存在则插入数据返回ID
						$_POST['url_id'] = $isexist['id'];
					}else{
						$data['title'] = 'neededit';
						$data['domain'] = getHost($_POST['fromurl']);
						$data['category_id'] ='4';
						$data['createtime'] = time();
						$data['user_id'] = $this->getuid();
						$d = D('url');
						$_POST['url_id'] = $d->add($data);
						//dump($d->getLastSQL()); exit;
					}
				}
				break;
			case 'brand':
				if(!$_POST['id'])
				{
					//新增时候默认赋值
					$_POST['supportnum'] = 1;
					//$_POST['buynum'] = 1;
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
		extract($param);
		switch($model)
		{
			case 'goods':
				if($type == 1)
				{
					//新增则晒数加1
					D('user')->setInc('shownum','id='.$this->getuid());	
				}
				if($img)
				{
					//去切图了...截图完了就去 上传其他的图片的了
					$this->redirect('album/cuticon',array('image_id'=>$img,'model'=>$model,'goto'=>$id,'showtype'=>$_POST['showtype']));
				}else{
					$this->redirect('deal/published',array('module'=>'show','action'=>'showgoods','id'=>$id));
				}
				break;
			case 'brand':
				//提交到发布成功页面
				$this->redirect('deal/published',array('module'=>'show','action'=>'showbrand','id'=>$id));
				break;
		}
	}
	
	function index()
	{
		$d = D('goods');
		$ids = $d->field('id')->where("image_id !='1' and showtype=2 and status=1")->select();
		
		
		$b = D('brand');
		$bids = $b->field('id')->where("image_id<>''")->select();
		//dump($b->getBrands($bids));
		$this->assign('brand',$b->mget(arraytostr($bids)));
		//加载晒晒
		$this->assign('goods',$d->mget(arraytostr($ids)));
		
		$this->page = array('title'=>'晒晒','tags'=>'晒晒,秀秀东西, 一起  团购 团购社区','desc'=>'我的买家团购分享,大家的体验分享社区');
		
		$this->t();
	}
	
	function showgoods()
	{
		$id = intval($_GET['id']);
		if($id)
		{
			//var_dump($id);
			$d = D('goods');
			//TODO:这里如果ID没有的话就无法调用的了
			$goods = $d->get($id);
			//var_dump($goods);
			$this->assign('vo',$goods);
			$this->assign('comment',D('comment')->getcomments(strin($id),'goods',100));
			
			$this->page = $goods;
			//显示下面加载的用户信息
			$uam['likenum'] = $d->getUserAndModel('goods',$id,'likenum');
			$uam['wantnum'] = $d->getUserAndModel('goods',$id,'wantnum');
			
			if($goods['showtype'] == '2' )
			{
				$uam['ownernum'] = $d->getUserAndModel('goods',$id,'ownernum');
			}
			
			if($goods['imageids'])
			{
				$this->assign('imageidss',D('image')->where('id in '.$goods['imageids'])->select());
			}
			//dump($uam);
			$this->assign('uam',$uam);
			
			//show user TODO:需要添加加为朋友的功能,呵呵
			$this->assign('user',D('user')->get($goods['user_id']));
			
			
			//show site info
			$url = D('url')->get(1); //get($goods['url_id']);
			if($url['status'] == 1)
			{
				$this->assign('url',$url);
			}
			//显示晒晒的模板
			$this->t();
			
		}
		
	}
	
	function showbrand()
	{
		$id = (int)$_GET['id'];
		if($id)
		{
			$d = D('brand');
			$brand = $d->get($id);
			//var_dump($brand);
			$this->assign('vo',$brand);
			
			$comments = D('comment')->getcomments(strin($id),'brand',100);
			//var_dump($comments);
			$this->assign('comment',$comments);
			//var_dump($comments);
			$this->page = $brand;
			
			//show user TODO:需要添加加为朋友的功能,呵呵
			$this->assign('user',D('user')->get($brand['user_id']));
			
			//显示下面加载的关联信息
			$uam['supportnum'] = $d->getUserAndModel('brand',$id,'supportnum');
			$uam['buynum'] = $d->getUserAndModel('brand',$id,'buynum');
			//var_dump($uam);
			$this->assign('uam',$uam);
			$this->t();
		}
	}
	
	
}
 
?>