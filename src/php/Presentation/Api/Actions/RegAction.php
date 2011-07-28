<?php

class RegAction extends ApibaseAction
{
	public function add()
	{
		
		$array = array('screen_name'=>'xdff','name'=>'3333','location'=>'1','password'=>'xxxx');
		
		$r = AccountService::signUp($array);
		$s = Session::get('id');
		$ss = Session::get('screen_name');
		//if is true  return ajax info to jump  to the index 
		//or otherwise return false and then dump the error
		var_dump($s,$ss);
		var_dump($r);
	}
	
}