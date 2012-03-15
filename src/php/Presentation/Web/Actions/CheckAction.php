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

/**
 * check action
 * @author xinqiyang
 *
 */
class CheckAction extends AppBaseAction
{
	
	public function signUpCheckAccount()
	{
		echo !empty($_REQUEST['account']) ? CheckLogic::check(__FUNCTION__, $_REQUEST['account']) : '不能为空';
	}
	
	public function signUpCheckEmail()
	{
		echo !empty($_REQUEST['email']) ? CheckLogic::check(__FUNCTION__, $_REQUEST['email']) : '不能为空';
	}
	
	
	public function checkSpam()
	{
		echo !empty($_REQUEST['content']) ? CheckLogic::check(__FUNCTION__, $_REQUEST['content']) : '内容不能为空';
	}
	
	public function checkScreenname()
	{
		echo !empty($_REQUEST['screenname']) ? CheckLogic::check('checkSpam', $_REQUEST['screenname']) : '用户名称不能为空';
	}
	
	public function checkGroupName()
	{
		echo !empty($_REQUEST['title']) ? CheckLogic::check(__FUNCTION__, $_REQUEST['title']) : '群名称不能为空';
	}
	
	
	
	public function checkGroupEnname()
	{
		echo !empty($_REQUEST['enname']) ? CheckLogic::check(__FUNCTION__, $_REQUEST['enname']) : '组名不能为空';
	}
	
	public function checkTopicName()
	{
		echo !empty($_REQUEST['title']) ? CheckLogic::check(__FUNCTION__, $_REQUEST['title']) : '标题不能为空';
	}
	
	public function checkAccountSay()
	{
		echo !empty($_REQUEST['say']) ? CheckLogic::check('checkSpam', $_REQUEST['say']) : '个性签名不能为空';
	}
	
	public function checkBrandName()
	{
		//must use the utf-8 charset
		echo !empty($_REQUEST['title']) ? CheckLogic::check(__FUNCTION__, $_REQUEST['title']) : '不能为空';
	}
	
	public function checkProductName()
	{
		//must use the utf-8 charset
		echo !empty($_REQUEST['title']) ? CheckLogic::check(__FUNCTION__, $_REQUEST['title']) : '不能为空';
	}
	
	
	
	public function checkBrandEnname()
	{
		//must use the utf-8 charset
		echo !empty($_REQUEST['titleextend']) ? CheckLogic::check(__FUNCTION__, $_REQUEST['titleextend']) : '不能为空';
	}
	
}