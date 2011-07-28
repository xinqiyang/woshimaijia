<?php
class IndexAction extends ApibaseAction
{
	public function index()
	{
		if(isset($_GET))
		{
			var_dump($_GET);
		}
		echo "ApiIndex";
	}

}