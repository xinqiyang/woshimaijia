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
 * 首页模块
 * @author xinqiyang
 * @date   2010-4-10
 *
 */
class IndexAction extends AppBaseAction {


	function index()
	{

		//cookie('aaa','aaaaa');
		//cookie('aaa','bbbbbb');
		//var_dump(cookie('aaa'));
		//	die();
			/*
			//加载用户信息
		
			//首页调用下 URL信
			$d = D('url');
			$ids = $d->field('id')->limit(24)->select();
			$this->assign('gogo',$d->mget(arraytostr($ids)));

			//加载新来的人
			$u = D('user');
			$newids = $u->field('id')->limit(8)->order('createtime desc')->select();
			$this->assign('newusers',$u->mget(arraytostr($newids)));


			//最新加入的品牌
			$b = D('brand');
			$bids = $b->field('id')->limit(12)->select();
			//var_dump($bids);
			$this->assign('brand',$b->mget(arraytostr($bids)));


			//推荐大家购买的
			$g = D('goods');
			//加载晒晒的功能了,显示大家推荐的
			$ids = $g->field('id')->where("image_id<>'' and showtype='1'")->select();
			$this->assign('goods',$g->newgetGoods(strin($ids)));


			//调用评论信息
			$d = D('comment');
			$comments = $d->getComments(strin(D('goods')->field('id')->where('id in (417,426,427,428,429,430)')->select()),'goods',6);
			*/
			$this->assign('newusers',array());//$u->mget(arraytostr($newids)));
			$this->assign('gogo',array());// $d->mget(arraytostr($ids)));
			$this->assign('brand', array());//$b->mget(arraytostr($bids)));
			$this->assign('goods',array());//$g->newgetGoods(strin($ids)));
			$this->assign('comments',array());

			
			$this->page['num'] = array(1=>0,2=>11,0=>333);
			$this->t();
	}
	
	
	public function home()
	{
		
	}

}
