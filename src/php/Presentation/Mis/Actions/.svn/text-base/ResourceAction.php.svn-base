<?php
// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet 
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2011 http://woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <xinqiyang@gmail.com>
// +----------------------------------------------------------------------

class ResourceAction extends AppBaseAction
{

	public function index()
	{
		$this->t();
	}
	
	public function image()
	{
		if(!empty($_GET['p'])){
			$p = intval($_GET['p']);
		}
		$p = isset($p) && $p>=1 ? $p : 1;
		$pageSize = 10;
		$arr['data']['data']['image'] = BaseService::getsByPage('image', " id>0 ORDER BY ID DESC ", $p,$pageSize);
		$arr['data']['data']['size'] = $pageSize;
		$arr['data']['data']['count'] = StatService::getObjectCounts('image');
		$this->t($arr);
	}
}