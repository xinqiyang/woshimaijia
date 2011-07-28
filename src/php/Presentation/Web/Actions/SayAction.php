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
 * 我说模块
 * @author xinqiyang
 * @date   2010-7-20
 *
 */
 
class SayAction extends AppBaseAction
{
	/**
	 * 我说模块首页
	 */
	public function index()
	{

		$this->page = array('title'=>'我说','tags'=>'我说,微博,我是买家微博','desc'=>'我是买家微博');
		$this->t();
	}
	
	public function comment()
	{
		$this->page = array('title'=>'点评','tags'=>'点评,我是买家点评','desc'=>'我是买家点评');
		$this->t();
	}
}
 
?>