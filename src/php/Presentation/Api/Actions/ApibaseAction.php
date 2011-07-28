<?php
/**
 * Apibase Action 
 * ALL Api Base ACTION
 * @author xinqiyang
 *
 */
class ApibaseAction extends Action
{
	public function __construct()
	{
		/*
		//security check
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(!isset($_POST['checkcode']))
			{
				$this->redirect('error/index');
			}
		}elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
			if(!isset($_GET['checkcode']))
			{
				$this->redirect('error/index');
			}
		}
		*/
	}
	
	//
	public function input()
	{
		//if isset type then to judge the object type
		if(isset($_POST['type']))
		{
			$objtype = array_keys(C('object_type'));
			if(in_array($_POST['type'],$objtype))
			{
				$obj = storeM('object');
				//to insert
				if(isset($_POST['id']) && intval($_POST['id']) >0)
				{
					//
					
				}
				
				return true;
			}
		}
		return false;
	}
	
	
}