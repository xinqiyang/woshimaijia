<?php
/**
 * cookie操作逻辑封装
 * 
 * @author xinqiyang
 *
 */
class Cookie
{	
	public static function set($name,$value, $option=null)
	{
		$value = json_encode($value);
		return cookie($name,$value);
	}
	
	public static function get($name)
	{
		return json_decode(cookie($name));
	}
	
	public static function append($name,$value, $option=null)
	{
		$listcount = C('COOKIE_LIST_COUNT');
		$list = array();
		$str = json_decode(cookie($name));
		if(is_array($str))
		{
			$list = $str;
		}
		if(is_array($value) && count($value))
		{
			$list = array_merge($value,$list);
			if(count($list) > $listcount)
			{
				$list = array_slice($list, 0,$listcount);
			}
		}else{
			$list[] = $value;
		}
		$str = json_encode($list);
		return cookie($name,$str, $option=null);
	}
	
	public static function clear()
	{
		return cookie(null);
	}
	
	public static function setnull($name)
	{
		return cookie($name,null);
	}
	
}