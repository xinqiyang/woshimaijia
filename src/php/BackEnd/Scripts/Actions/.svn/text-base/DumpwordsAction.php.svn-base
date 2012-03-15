<?php
// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet 
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2011 http://woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <xinqiyang@gmail.com>
// +----------------------------------------------------------------------

class DumpwordsAction extends Action{
	
	//全量导出
	public function dumptags()
	{
		//删除老的关键字文件
		$path = C('dictionay.tags');
		unlink($path);
		$tags = TagsLogic::gets('tags', "",'tag');
		foreach ($tags as $one)
		{
			$arr[] = $one['tag'];
		}
		$str = implode($arr, "\n");
		
		file_put_contents($path, $str);
		echo "DUMP TAGS OK\n";
		exit(0);
	}
}