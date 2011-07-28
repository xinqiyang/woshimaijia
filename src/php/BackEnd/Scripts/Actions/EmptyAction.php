<?php

class EmptyAction extends Action
{
	public function  index()
	{
		var_dump($_GET);
		echo 'empty/index';
	}
	
	public function show()
	{
		echo 'empty/show';
	}
}