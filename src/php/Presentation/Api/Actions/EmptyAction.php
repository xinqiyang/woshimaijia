<?php

class EmptyAction extends Action
{
	public function index()
	{
		echo MODULE_NAME.ACTION_NAME.' NOT FIND';
	}
}