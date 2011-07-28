<?php
/**
 * Account Service
 * do all logic here
 * all the logic of the system,it include  3 table's in the db and many keys  in the redis
 * @author xinqiyang
 *
 */
class AccountService extends BaseService
{
	
	/**
	 * sign up proccess logic
	 * 
	 * @param unknown_type $array
	 */
	public static function signUp($array)
	{
		$r = storeR();
		$id = objid();
		$array['id'] = $id;
		$key ='u:'.$id;
		$result = $r->hmSet($key,$array);
		if($result === true)
		{
			//add to object tree
			$objecttree = $r->lPush('objecttree',$key);
			//set email to id
			$emailset = $r->set('e:'.$array['email'],$id);
			if(!$emailset)
			{
				//@todo:LOG the fatal error
				
			}
			//set session
			self::setSession($array);
			//add to event queue then deal it
			self::addToEventQueue($array,__METHOD__);
			return true;
		}
		return false;
	}
	
	/**
	 * set user session info 
	 * 
	 * @param array $array
	 */
	public static function setSession($array)
	{
		Session::set('screen_name', $array['screen_name']);
		Session::set('id', $array['id']);
	}
	
	
	public static function updateProfile($array)
	{
		$r = storeR();
		$key = 'u:'.$array['id'];
		$result = $r->hmSet($key,$array);
		self::addToEventQueue($array,__METHOD__);
		if($result === true)
		{
			return true;
		}
		return false;
	}
	

	
	/**
	 * end Session 
	 * end session and then set cookie null
	 */
	public static function endSession($array)
	{
		//@TODO:set cookie set null
		$array = array();
		$array['id'] = Session::get('id');
		$array['logoutTime'] = time();
		self::addToEventQueue($array,__METHOD__);
		Session::destroy();
		cookie::setnull('autologin');
		return true;
	}
	
	
	/**
	 * forget password
	 * 
	 * @param unknown_type $array
	 */
	public static function changePassword($array)
	{
		$r = storeR();
		$key = 'u:'.$array['id'];
		$password = $r->hGet($key,'password');
		if($array['password'] === $password)
		{
			//set new password
			$result = $r->hSet($key,'password',$array['newpassword']);
			if($result)
			{
				self::addToEventQueue($array,__METHOD__);
				return true;
			}
		}
		return false;
		
	}
	
	
	public static function forgetPassword($array)
	{
		$r = storeR();
		$key = 'u:'.$array['id'];
		//get email or get id 
		$email = $r->hGet($key,'email');
		if($email)
		{
			self::addToEventQueue($array,__METHOD__);
			//@TODO:to send mail and to other logic
			
			return true;
		}
		return false;
		
	}
	
	/**
	 * @todo:checklogin
	 * tologin
	 * @param $status  0 not in   1 success  2 password error
	 */
	public static function checkLogin($array)
	{
		//user not in the system
		$status = 0;
		$r = storeR();
		$emailkey='e:'.$array['email'];
		$id = $r->get($emailkey);
		if($id)
		{
			$key = 'u:'.$id;
			$arr = array_keys($array);
			$arr['screen_name'] = 'screen_name';
			$user = $r->hmGet($key,$arr);
			if(md5($array['password']) == $user['password'])
			{
				$array['screen_name'] = $user['screen_name'];
				self::setSession($array);
				$status = 1;
			}else{
				//password error
				$status = 2;
			}
		}
		self::addToEventQueue($array,__METHOD__);
		return $status;
	}
	
	
	
	public static function forbidAccount($array)
	{
		$r = storeR();
		//set status to 1 means forbidden
		$array['status'] = 1;
		$key='u:'.$array['id'];
		$result = $r->hmSet($key,$array);
		if($result)
		{
			return true;
		}
		return false;
	}
	
	
	/*********** privacy **********/
	
	public static function updatePrivacy($array)
	{
		$r = storeR();
		$key = 'u:'.$array['id'];
		unset($array['id']);
		$arr = array('privacy'=>Json::encode($array));
		$result = $r->hmSet($key,$arr);
		if($result)
		{
			return true;
		}
		return false;
	}
	
	public static function getPrivacy($array)
	{
		$r = storeR();
		$key = 'u:'.$array['id'];
		$arr = $r->hGet($key,'privacy');
		return $arr;
	}
	
	
	/**
	 * use user id 
	 * 
	 * @param unknown_type $array
	 */
	public static function fetch($array)
	{
		$r = storeR();
		$key = 'u:'.$array['id'];
		unset($array['id']);
		return  $r->hmGet($key,$array); 
	} 
	
	
	
	/**
	 * return suggestion to user
	 * 
	 * @param $array
	 */
	public static function suggestions($array)
	{
		
	}
	
	
	public static function setSuggestions($array)
	{
		
	}
	
	
	/**
	 * get focus friends list and the last sweet
	 * @param array $array
	 */
	public static function followed($array)
	{
		
	}
	
	/**
	 * get followers
	 * @param $array
	 */
	public static function followers($array)
	{
		
	}
	
	
}