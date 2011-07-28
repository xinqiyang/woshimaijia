<?php
/**
 * Service Base of the buddy
 * 
 * @author xinqiyang
 *
 */
class BaseService extends Base
{
	
	
	public static function setCount($key,$field,$count=1)
	{
		$r = storeR();
		return $r->hIncrBy($key,$field,$count);
	}
	
	
	
	/**
	 * get sys hot
	 * $array field  key from,number ,if number equal 0 means all
	 */
	public static function getList($array)
	{
		$key=$array['k'];
		$r = storeR();
		$from = $array['f'];
		$number = $array['n']-1;
		return $r->lRange($key,$from,$number);
	}
	
	
	
	/**
	 * Set the keys to The List key
	 * @param string $key 
	 * @param array $array
	 */
	public static function setList($key,$array,$listLength=500)
	{
		$rbol = true;
		$r = storeR();
		if(is_array($array))
		{
			foreach ($array as $val)
			{
				$length = $r->lSize($key);
				if($length >= $listLength)
				{
					$result = $r->rPop($key);
					if(!$result)
					{
						//LOG
					}
				}
				$result = $r->lPush($key,$val);
				if(!$result)
				{
					//LOG
				}
			}
		}else{
				$length = $r->lSize($key);
				if($length >= $listLength)
				{
					$result = $r->rPop($key);
					if(!$result)
					{
						//LOG
					}
				}
				$result = $r->lPush($key,$array);
				if(!$result)
				{
					$rbol = false;
				}
		}
		return $rbol;
	}
	
	
	public static function addToEventQueue($array,$method='')
	{
		$queue = new Queue();
		$array['module'] = $method;
		var_dump($array);
		$qr = $queue->put('event', Json::encode($array));
		return ;
	}
	
}