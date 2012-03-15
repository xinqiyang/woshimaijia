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
 * fetch object from internet
 * fetch object is:
 * city product  
 * @author xinqiyang
 *
 */
class FetchobjectAction extends Action
{

	public function doWork()
	{
		$id = 13126189477784851;
		$urls = BaseService::get('url',$id,'openapi,fetchrule,domain');
		$seconds = 1;
		$city = Json::decode($urls['fetchrule']);
		foreach ($city['city'] as $key=>$val)
		{
			$fetchUrl = sprintf($urls['openapi'],$val['id']);
			var_dump($fetchUrl);
			$method = str_replace('.', '', getDomain($urls['domain']));
			//var_dump($method);
			$r = self::$method($fetchUrl,$id);
			//var_dump($r);die;
		}
	}
	
	public function dodp()
	{
		$url = "http://t.dianping.com/api.xml";
		$id = '11';
		var_dump($url);
		self::dianpingcom($url, $id);
	}
	
	/**
	 * fetch lashou website
	 * 
	 * @param unknown_type $url
	 * @param unknown_type $id
	 */
	public function lashoucom($url,$id)
	{
		$product = @self::fetch($url);
		$i = 0;
		if(is_array($product))
		{
			$allcount = $product["@attributes"]['count'];
			foreach ($product['url'] as $key=>$val)
			{
				$r = self::lashouProduct($val,$id);
				ProductLogic::add($r);
			}
		}else{
			logFatal('FetchURL ERROR:'.$url);
		}
	}
	
	
	
	/**
	 * lashou product
	 * 
	 * @param $val array product
	 */
	private function lashouProduct($val,$id)
	{
		$arrProduct = array();
		$arrProduct['id'] = objid();
		$arrProduct['title'] = $val['data']['display']['title'];
		$arrProduct['titleextend'] = $val['data']['display']['detail'];
		$arrProduct['tags'] = '';
		$arrProduct['desc'] = $val['data']['display']['title'];
		$arrProduct['status'] = '1';
		$arrProduct['createtime'] = time();
		$arrProduct['location'] = $val['data']['display']['city'];
		$arrProduct['image'] = $val['data']['display']['image'];
		$arrProduct['fromurl'] = $val['loc'];
		$arrProduct['user_id'] = '1';
		$arrProduct['brand_id'] = '1';
		$arrProduct['price'] = $val['data']['display']['value'];
		$arrProduct['newprice'] = $val['data']['display']['price'];
		$arrProduct['showtype'] = '1';
		$arrProduct['url_id'] = $id;
		$arrProduct['imageids'] = '';
		$arrProduct['starttime'] = $val['data']['display']['startTime'];
		$arrProduct['endtime'] = $val['data']['display']['endTime'];
		$arrProduct['website'] = $val['data']['display']['website'];
		$arrProduct['cate'] = $val['data']['display']['cate'];
		$arrProduct['rebate'] = $val['data']['display']['rebate'];
		$arrProduct['shops'] = self::lashoushops($val['data']['display']['shops']);
		return $arrProduct;
	}
	
	public function dianpingcom($url,$id)
	{
		$product = @self::fetch($url);
		$i = 0;
		if(is_array($product))
		{
			foreach ($product['url'] as $key=>$val)
			{
				$r = self::dianpingProduct($val,$id);
				$result = BaseService::add('product', $r);
				if($result){
					echo $id." INSERT OK\n";
				}
			}
		}else{
			logFatal('FetchURL ERROR:'.$url);
		}
	}
	
	public function dianpingProduct($val,$id)
	{
		$arrProduct = array();
		$arrProduct['id'] = objid();
		$arrProduct['title'] = isset($val['data']['display']['title']) ? $val['data']['display']['title'] : '';
		$arrProduct['titleextend'] = isset($val['data']['display']['description']) ? $val['data']['display']['description'] : '';
		$arrProduct['tags'] = '';
		$arrProduct['desc'] = isset($val['data']['display']['detail']) ? $val['data']['display']['detail']:'';
		$arrProduct['status'] = '0';
		$arrProduct['createtime'] = time();
		$arrProduct['location'] = isset($val['data']['display']['city']) ? $val['data']['display']['city'] : '';
		$arrProduct['image'] = isset($val['data']['display']['image']) ? $val['data']['display']['image']: '';
		$arrProduct['fromurl'] = isset($val['loc']) ? $val['loc'] : '';
		$arrProduct['user_id'] = '1';
		$arrProduct['brand_id'] = '1';
		$arrProduct['price'] = isset($val['data']['display']['value']) ? $val['data']['display']['value'] : '';
		$arrProduct['newprice'] = isset($val['data']['display']['price']) ? $val['data']['display']['price'] : '';
		$arrProduct['showtype'] = '1';
		$arrProduct['url_id'] = $id;
		$arrProduct['imageids'] = '';
		$arrProduct['starttime'] = isset($val['data']['display']['startTime']) ? $val['data']['display']['startTime']:'';
		$arrProduct['endtime'] = isset($val['data']['display']['endTime']) ? $val['data']['display']['endTime'] : '';
		$arrProduct['website'] = isset($val['data']['display']['website']) ? $val['data']['display']['website'] : '';
		return $arrProduct;
	}
	
	private function lashoushops($shops)
	{
		$str = '';
		if(!is_array($shops))
		{
			foreach ($shops as $key=>$val)
			{
				if(is_array($val))
				{
					foreach ($val as $subval)
					{
						$str .= $subval.'<br />';
					}
				}
			}
		}
		return $str;
	}
	
	
	
	private function saveCity($id)
	{
		$r = UrlService::get($id,'citylist');
		$arrCity = Json::encode(self::fetch($r['citylist']));
		$arr = array('id'=>$id,'fetchrule'=>$arrCity);
		return  UrlService::save($arr);
	}
	
	
	/**
	 * fetch url from internet ,then change xml to array
	 * Enter description here ...
	 * @param string $url URL
	 */
	private function fetch($url)
	{
		$i=0;
		while(true){
			$result = Curl::get($url);
			if(strlen($result)>0) {
				return @XML::toArray($result);
				break;
			}
			$i++;
			logFatal('TO Fetch URL  Error:'.$url);
			if($i>=5) {
				break;
			}
			//if can't add then sleep 10 sec
			sleep(10);
		}
	}
	
}