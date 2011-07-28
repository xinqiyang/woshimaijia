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
 * city module
 * @author xinqiyang
 * @date   2010-4-14
 *
 */
class CityAction extends AppBaseAction {
	

	/**
	 * 显示地区列表
	 */
	public function index()
	{
		$m = D('district');
		
		$this->page = array('title'=>'城市','tags'=>'城市,我是买家城市','desc'=>'我是买家城市');
		$this->assign('city',$m->getDistrict());
		$this->t();
			
	}


	/**
	 * 地区方法
	 */
	public function location()
	{
		
		$this->page = array('title'=>'所在地','tags'=>'所在地,城市,我是买家城市','desc'=>'我是买家城市');
		$this->t();
	}

	/**
	 * 加载地区数据信息
	 * type 国 0    省1    市2 区3
	 * parent 父ID
	 */
	public function cityload()
	{
		$type   = !empty($_REQUEST['type'])   ? intval($_REQUEST['type'])   : 0;
		$parent = !empty($_REQUEST['parent']) ? intval($_REQUEST['parent']) : 0;

//		$arr['target']  = !empty($_REQUEST['target']) ? stripslashes(trim($_REQUEST['target'])) : '';
//		$arr['target']  = htmlspecialchars($arr['target']);
//		$arr['type']    = $type;
//		$arr['regions'] = $this->result('region',"regiontype='$type' and parentid='$parent'",'','regionid,regionname');

		$this->ajaxReturn($arr);

	}
}


?>