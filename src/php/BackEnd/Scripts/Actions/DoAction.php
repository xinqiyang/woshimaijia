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
 * do action run the crontab
 * run cli mode process
 * @author xinqiyang
 *
 */
class DoAction extends Action
{
	
	public function todo()
	{
		$taskname = !empty($_SERVER['argv'][3]) ? $_SERVER['argv'][3] : 'error';
		$r = false;
		switch ($taskname)
		{
			case 'pub::actsetmessage':
				$r = PubLogic::actSetMessage();
				break;
			case 'store::actSetRecommendProduct':
				$ids = array(
					13195606792893491,
					13195606792814922,
					13195606792738420,
					13195606792662181,
				);
				$r = StoreLogic::actSetRecommendProduct($ids);
				break;
			case 'error':
				echo "Input Param is error,please check!\n";
				break;
			
		}
		if(!$r)
		{
			logNotice("RUN $taskname Error,please check \n");
		}
		
	}
}