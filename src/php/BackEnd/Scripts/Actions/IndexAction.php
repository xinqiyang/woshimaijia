<?php
/**
 * demo
 * @author yangxinqi
 *
 */
class IndexAction extends Action
{
	public function index()
	{
		echo "Hello BUDDY !\n";
		echo "Please input the ModuleName and The ActionName like this: index.php Index index\n";
		debug_start('objid');
		for($i=0;$i<40000;$i++)
		{
			echo objid()."\n";
		}
		debug_end('objid');
	}
	
	
	public function phpinfo()
	{
		phpinfo();
	}
	
	
}