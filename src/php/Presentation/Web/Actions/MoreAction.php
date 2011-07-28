<?php
/**
 * 开放数据库服务
 * @author Jonathan
 *
 */
class MoreAction extends AppBaseAction
{
	/**
	 * 获取数据
	 */
	public function Get()
	{
		//获取参数  模型model   类型type  	 数量 count
		if(isset($_GET['type']) && ($_GET['count']))
		{
			//
			switch($_GET['type'])
			{
				case '':
					
					break;
			}	
		}
		
		
		$this->t();
	}
	
}