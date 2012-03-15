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

class CtAction extends Action
{
	/*
	 * 常用的01号的监控任务进行推送消息的操作
	 * 2 * 1000000/40000 = 50/s 每秒50个的处理并发占CPU大概1.7
	 * 
	 */
	public function ct001()
	{
		$max = 2;
		G('ct001');
		$queuename = 'event';
		$queue = Base::instance('Queue');
		while (true)
		{
			//for执行多少次
			for($i=0;$i<$max;$i++)
			{
				//从队列取出来
				$r = $queue->get($queuename);
				if(!empty($r) && $r !== 'HTTPSQS_GET_END'){
					echo $r."\n";
					$arr = json_decode($r,true);
					//执行操作，然后unset,执行逻辑操作过程
					$method = $arr['method'];
					unset($arr['method']);
					//执行处理过程
					if(method_exists('CttaskDealService', $method))
					{
						$r = CttaskDealService::$method($arr);
						if(!$r){
							logNotice($method." DEAL ERROR DATA:".$r);
						}
					}
				}
			}
			usleep(40000);
		}
		logNotice(__FUNCTION__." TASK IS STOP,RUN TIME IS :".G('ct001','end'));
		exit(1);
	}
	
	public function ct001test()
	{
		$max = 2;
		$start = time();
		//进行推送的操作
		while (true)
		{
			$queue = Base::instance('Queue');
			//for执行多少次
			for($i=0;$i<$max;$i++)
			{
				$array = array(array($i.'_'.mt_rand(0, 100000)),'method'=>'aaaa/bbb');
				//从队列取出来
				$r = $queue->put('event',json_encode($array));
				//执行操作，然后unset 
				echo time()."NUM:$i   $r  \n";
			}
			usleep(40000);
		}
		
	}
	
	public function ct001getview()
	{
		$queue = Base::instance('Queue');
		$r = $queue->status('event');
		var_dump($r);
	}
	
}