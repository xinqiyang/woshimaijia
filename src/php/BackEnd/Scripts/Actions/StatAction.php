<?php

class StatAction extends Action
{
	/**
	 * 创建统计数据库
	 * 
	 */
	public function createtable()
	{
		$sql = "CREATE TABLE bd_metadata_%s like bd_metadata";
		$db = storeM('userinfo','mysql_01');
		for($i=0;$i<100;$i++)
		{
			$r = $db->execute(sprintf($sql,$i));
			if($r)
			{
				echo "create $i success\n";
			}
		}
		
		
	}
}
