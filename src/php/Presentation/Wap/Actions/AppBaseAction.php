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
 +------------------------------------------------------------------------------
 * AppBaseAction
 +------------------------------------------------------------------------------
 * @category
 * @package
 * @subpackage
 * @author   xinqiyang <517577550@qq.com>
 +------------------------------------------------------------------------------
 */
class AppBaseAction extends Action
{

	protected  $uid = 0;
	protected  $uinfo = array();
	protected $page = array();

	function _initialize()
	{
		//do set one time
		$uid = Session::get('uid');
		if(!empty($uid) && $uid>0){
			$this->uid = $uid;	
		}
	}
	


	/**
	 * router function to get the function action to deal
	 *
	 */
	public  function _empty()
	{
		//@TODO:  if not exist,what we will do
		$this->display('Public/404');
	}
	
	/**
	 * set user info of the system
	 * Enter description here ...
	 */
	public function setUser()
	{
		$uinfo = Session::get('uinfo');
		
		$this->page['user'] = empty($uinfo) ? AccountService::defaultUser() : json_decode($uinfo,true);
	}
	
	

	/**
	 * deal all request 
	 */
	public function deal()
	{
		//var_dump($_POST);
		//common post request method,deal login/unlogin example
		$data = Validate::validates();
		//var_dump($data['data']);die;
		$data = is_array($data) ? $data : array();
		$this->t($data,'');
		
	}





	/**
	 * layout show the template
	 * @param templatename $t
	 * @param templateinfo $info
	 */
	protected function t($r='',$tpl='')
	{
		//var_dump($r);die;
		//do ajax to return 
		if($this->isAjax())
		{
			//var_dump($r);
			$this->dataReturn($r);
		}
		//to display 
		if(isset($r['data']) && is_array($r['data']))
		{
			//var_dump($r['data']);
			$this->page = array_merge($r['data'],$this->page);
		}
		
		//set page head
		//@todo need to replace the keywords  title,tags,desc
		$this->page['head'] = C('head.'.MODULE_NAME.':'.ACTION_NAME);
		//
		if(isset($this->page['data']['title']) && isset($this->page['data']['tags']) && isset($this->page['data']['desc']))
		{
			$this->page['head']['title'] = $this->page['data']['title'];
			$this->page['head']['tags'] = $this->page['data']['tags'];
			$this->page['head']['desc'] = $this->page['data']['desc'];
		}
		//set user info
		$this->setUser();
		//all data to set the page array to display
		$this->page['resurl'] = C('RESURL');
		//var_dump($this->page);
		//assign the page array prepare to display
		$this->assign('page',$this->page);
		//var_dump($this->page);die;
		$tpl = (isset($r['info']) && $r['info'] === 'Bad Request') ? 'Public/404' : $tpl;
		//display
		$this->display($tpl);
	}
		

}