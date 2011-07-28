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
 * 搜索模块
 * @author xinqiyang
 * @date   2010-4-8
 *
 */
class SearchAction extends AppBaseAction {
	
	
	function tags()
	{
		$tag = $_GET['tag'];
		$d = D('tags');
		//TODO:tags 需要在进行二次查询得到关联的信息并显示出来
		$result = $d->getTags($tag);
		
		$this->page = array('title'=>'我是买家 Tags','tags'=>'搜索,搜索结果,买家社区','desc'=>'我的买家 大家,大家的分享社区');
		
		$this->t();
	}
	
	function dosearch()
	{
		if(isset($_GET['keywords']))
		{
			$this->assign('keywords',$_GET['keywords']);
		}
		$this->page = array('title'=>'搜索','tags'=>'搜索,搜索结果,买家社区','desc'=>'我的买家 大家,大家的分享社区');
		
		$this->t();
	}
	
	function taglist()
	{
		$this->page = array('title'=>'我的TAG','tags'=>'我的TAG,买家社区','desc'=>'我的买家 大家,大家的分享社区');
		
		$this->t();
	}
}

 
?>