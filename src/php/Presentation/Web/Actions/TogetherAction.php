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
 * 一起
 * @author xinqiyang
 * @date   2010-7-7
 *
 */
 
class TogetherAction extends AppBaseAction
{
	/**
	 * 一起首页
	 */
	public function index()
	{
		
		$d = D('user');
		$newids = $d->field('id')->where("status =1 and image_id > '1'")->limit(16)->order('createtime desc')->select();
		$this->assign('newusers',$d->mget(arraytostr($newids)));
		
		$g = D('goods');
		//加载晒晒的功能了,显示大家推荐的
		$ids = $g->field('id')->where("image_id<>'' and showtype='1'")->select();
		$goods = $g->mget(arraytostr($ids));
		//var_dump($goods[0]);
		$this->assign('goods',$goods);
		
		
		//调用一些团购网站
		$g = D('url');
		$groupids =$g->field('id')->where('category_id=3')->select();
		$groupurl = $g->mget(arraytostr($groupids));
		$this->assign('group',$groupurl);
		
		$this->page = array('title'=>'一起 ','tags'=>'一起  团购 团购社区','desc'=>'我的买家团购分享,大家的体验分享社区');
		
		$this->t();
	}
}
?>