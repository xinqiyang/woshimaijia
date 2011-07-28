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
		$this->setHead();
		$this->setUser();
		
	}
	


	/**
	 * router function to get the function action to deal
	 *
	 */
	public function _empty()
	{
		
	}
	
	/**
	 * set user info of the system
	 * Enter description here ...
	 */
	public function setUser()
	{
		//get the uinfo from session
		$uinfo = Session::get('uinfo');
		$this->page['user'] = empty($uinfo) ? array('uid'=>0,'screenName'=>'','icon'=>C('site.defaultIcon')) : $uinfo;
	}
	
	/**
	 * set page info of the page
	 * get pageinfo the set the data to $this->page
	 */
	public function setHead()
	{
		$this->page['head'] = C('head.'.MODULE_NAME.':'.ACTION_NAME);
	}

	/**
	 * deal post actions
	 * if user post then deal the post request 
	 */
	public function deal()
	{
		debug_start('test');
		//var_dump($_GET);
		//common post request method,deal login/unlogin example
		$r = Validate::validates();
		var_dump($r);
		if($this->isAjax())
		{
			$this->dataReturn($r);
		}
		$this->t($r);
		debug_end('test');
	}



	public function upload($module='',$thumb=true,$width=120,$height=120){
		$module= $module==''?'temp':$module;
		$path=C(ATTACHDIR).'/'.$module.'/mpic/';
		$spath = C(ATTACHDIR).'/'.$module.'/spic/';
		if (!is_dir($path))	@mk_dir($path);
		if (!is_dir($spath))	@mk_dir($spath);
		import("ORG.Net.UploadFile");
		$upload = new UploadFile();

		$upload->maxSize=3145728; //3M
		$upload->allowExts=array('jpg','gif','png','jpeg');
		$upload->savePath=$path;
		$upload->saveRule='uniqid';

		if($thumb)
		{
			$upload->thumb = true;
			$upload->thumbPrefix   =  '';
			$upload->thumbPath = $spath;
			$upload->thumbMaxWidth = $width;
			$upload->thumbMaxHeight = $height;
		}
		if(!$upload->upload()){
			//捕获上传异常
			$upl = $upload->getErrorMsg();
		}else{
			$upl = $upload->getUploadFileInfo();
		}
		//判断结果,插入数据库
		if(is_array($upl))
		{
			//插入图片表
			$img = M('image');
			
			$imgdata['model'] = $module;
			$imgdata['createtime'] = time();
			$imgdata['status'] = '1';
			$imgdata['url'] = C('ATTACHDIR');
			$imgdata['user_id'] = $this->getuid();
			$count = count($upl);
			//dump($count);
			if($count==1)
			{
				$imgdata['filename'] = $upl[0]['savename'];
				$imgid = $img->add($imgdata);
				return $imgid;
			}else{
				$str = '(';
				$counts = 0;
				for($i=0;$i<$count;$i++)
				{
					//dump($upl[$i]['savename']);
					$imgdata['filename'] = $upl[$i]['savename'];
					$imgid = $img->add($imgdata);
					if($imgid)
					{
						$str .= "'".$imgid."',";
						$counts ++;
					}
				}
				if($counts){
					//更新图片表
					return substr($str,0,-1).')';
				}
			}
		}else{
			//返回上传出错信息
			return $upl;
		}
	}


	/**
	 * layout show the template
	 * @param templatename $t
	 * @param templateinfo $info
	 */
	protected function t($r)
	{
		$t = ($r['info'] === 'Bad Request') ? 'Public/404' : '';
		//generate the data then display
		$this->page['data'] = $r['data'];
		//all data to set the page array to display
		$this->page['resurl'] = C('RESURL');
		//assign the page array prepare to display
		$this->assign('page',$this->page);
		$this->display($t);
	}
	
	/**
	 * 返回URL
	 */
	public function getReturnUrl()
	{
		return __URL__.'?'.C('VAR_MODULE').'='.MODULE_NAME.'&'.C('VAR_ACTION').'='.C('DEFAULT_ACTION');
	}

	

}