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

class SearchAction extends AppBaseAction
{
	//search
	public function dosearch()
	{
		$r = array();
		if(!empty($_GET['search_text'])){
			$query = $_GET['search_text'];
			$cl = SphinxClient::instance('search');
			//用户关键字写入到list
			SearchService::actStoreKeywords($query,userID());
			$result = $cl->query($query);
			/*
			print("<pre>");
			print_r($cl->GetLastError());
			print_r($cl->GetLastWarning ());
			//print_r($res);
			print("<pre>");
			*/
			//var_dump($result);die;
			$objids = array();
			if($result['status'] == 0){
				$count = $result['total_found'];
				$r['count']  = $count;
				//var_dump($result['matches']);
				
				if($count)
				{
					$matches = $result['matches'];
					//$wordinfo = $result['words']; // [docs][hits]
					//var_dump($wordinfo);
					
					$r['title'] = '搜索：'.htmlspecialchars($query);
					
					foreach ($matches as $one){
						$objids[] = $one['attrs']['oid'];
					}
					$r['size'] = 5;
					$p = (isset($_GET['p']) && intval($_GET['p'])>0) ? $_GET['p'] : 1;
					$offset = ($p-1)*$r['size'];
					$objids = array_slice($objids, $offset,$r['size']);
					arsort($objids);
					foreach ($objids as $one)
					{
						$object = SearchService::queryField('object', "id=$one", 'object');
						$arr = SearchService::get($object, '','*',"id=$one and status=0");
						if($arr){
							$arr['object'] = $object;
							$r['search'][$one] = $arr;
						}
					}
					if(!empty($r['search']))
					{
						$r['user'] = AccountLogic::getUsers($r['search'],'user_id');
					}
					//var_dump($r['result'],$objids);
				}else{
					$r['title'] = "关键词:".htmlspecialchars($query)."搜索无结果，共搜索次数：0";
				}
			}
			
		}
		//var_dump($r);die;
		$return['data']['data'] = $r;
		$this->t($return);
	}
	
	public function group()
	{
		$return = array();
		if (!empty($_GET['keyword']))
		{
			$query = $_GET['keyword'];
			//@TODO这里对缓存结果做cache还是比较必要的,先去取cache,存在则读cache 不存在则去搜索
			
			$cl = SphinxClient::instance('group');
			$result = $cl->query($query);
			/*
			print("<pre>");
			print_r($cl->GetLastError());
			print_r($cl->GetLastWarning ());
			//print_r($res);
			print("<pre>");
			*/
			//var_dump($result);
			$objids = array();
			if($result['status'] == 0){
				$count = $result['total_found'];
				$r['count']  = $count;
				//var_dump($result['matches']);
				
				if($count)
				{
					$matches = $result['matches'];
					//$wordinfo = $result['words']; // [docs][hits]
					//var_dump($wordinfo);
					if(isset($result['words']["$query"]))
					{
						$r['title'] = '关键词：'.htmlspecialchars($query).'有 '.$result['words']["$query"]['docs']."搜索结果，共搜索次数：".$result['words']["$query"]['hits'];
					}else{
						$r['title'] = '搜索关键词：'.htmlspecialchars($query);
					}
					foreach ($matches as $one){
						$objids[] = $one['attrs']['oid'];
					}
					$r['size'] = 5;
					$p = (isset($_GET['p']) && intval($_GET['p'])>0) ? $_GET['p'] : 1;
					$offset = ($p-1)*$r['size'];
					$objids = array_slice($objids, $offset,$r['size']);
					$ids = strin($objids);
					$r['result'] = GroupLogic::getGroupByIds($ids);
					//var_dump($r['result'],$objids);
				}else{
					$r['title'] = "关键词:".htmlspecialchars($query)."搜索无结果，共搜索次数：0";
				}
			}
			
		}
		$return['data']['data'] = $r;
		$this->t($return);
	}

}