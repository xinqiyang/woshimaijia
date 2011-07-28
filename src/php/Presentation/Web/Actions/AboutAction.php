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
 * About模块
 * @author xinqiyang
 * @date   2010-7-17
 *
 */

class AboutAction extends AppBaseAction
{

	/**
	 * 显示模板信息
	 */
	public function show()
	{
		$type = $_GET['w'];
		$d = D('content');
		$content = $d->where("module='About' and action='$type' and status=1")->find();
		
		$this->assign('vo',$content);
		$this->page = $content;
		$this->t();
	}
	
}
 
?>