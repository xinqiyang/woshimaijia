<?php

class ErrorAction extends Action
{
	public function index()
	{
		//$this->display();
		echo '
		<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>API REQUERST ERROR </title></head><body><div style="margin:0 auto;text-align:center;margin-top:200px;"><h1>BAD REQUEST！PLEASE CHECK！</h1></div></body></html>
		';
	}
}