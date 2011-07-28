<?php

class EmptyAction extends Action
{
	
	public function emptyfunction()
	{
		//
		echo 'DEAL ERROR';
		DIE;
		//LOG
		//$this->redirect('public/error');
	}
	
}
