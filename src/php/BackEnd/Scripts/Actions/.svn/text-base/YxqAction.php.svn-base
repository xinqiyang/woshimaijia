<?php
/*
 * @filename
 * @touch
 * @package
 * @author
 * @license
 * @version
 * @copyright (c) 2011, baidu.com
 */
class YxqAction extends Action
{
    function testlock()
    {
    	echo TEMP_PATH."\n";
       	$name = 'lockTest1';
		$lock = new Lock($name,TEMP_PATH.DIRECTORY_SEPARATOR);
		$lock->lock();
		echo "do action ok \n";
		$lock->unlock();
    }
    
    public function generate()
    {
    	$path = './words';
    	$r = allFiles($path);
    	$array = array();
    	foreach ($r as $file){
    		$rel = getFileContentToArray($file);
    		$array = array_merge($array,$rel);
    	}
    	$array = array_unique($array);
    	$content = '';
    	if(!empty($array)){
	    	foreach ($array as $one)
	    	{
	    		if(!empty($one)){
	    			$content .= $one."\n";
	    		}
	    	}
    	}
    	file_put_contents('keywords.txt', $content);
    	return true;
    }
    
    
    public function addadmin()
    {
    	$array['id'] = objid();
    	$array['account'] = 'admin';
    	$array['password'] = md5('admin');
    	$array['lastlogintime'] = time();
    	$array['createtime'] = time();
    	$groupid = C('missite.groupid');
    	$array['groupid'] = $groupid['admin'];
    	$r = BaseService::add('services', $array);
    	var_dump($r);
    	
    }
    

}


