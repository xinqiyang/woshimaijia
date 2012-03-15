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

class IndexAction extends AppBaseAction
{
	
	public function index()
	{
		//get from index of the blog
		
		$sql = "SELECT post_title,guid,post_date FROM `yxq_posts` where post_status='publish' and post_author = 2 and post_type='post' order by id desc limit 4;";
		$m = $mysql = MMysql::instance('posts','blog');
		$r['data']['data'] = $m->query($sql);
		//display the articles 
		$this->t($r);
	}
}