<?php

class KeyAction extends Action
{
    public function index()
    {
	$result = '';

	$key='key';
	$value = 'value';

	$r = StoreR();
	//对象存储
	//谁 + 什么     哪个对象+属性 这个困难是string,list,set,zset,hashes
	
	//key 主要有
	//goods:100000000000000001   //实体key 使用hashset存储
	$objname = "goods:100000000000000001";
	$r->delete($objname);

	//$r->hSet($objname,$key,$value);
	$objArr = array('id','name','title','desc');
	$id = objId();
	var_dump($objname,$id);
	foreach($objArr as $key)
	{
		$value = mt_rand(0,10000);
		$re = $r->hSet($objname,$key,$value);       
		if($re !==1)
		{
		  //log the error
		  echo 'save error';
		}
		
	}
        //get a property of the object
	echo "get the properties of the object \n";
	var_dump($r->hmGet($objname,array('id','name')));	
  
	//get the instance
        echo "get the instance of the object \n";
	var_dump($r->hGetAll($objname));die;



        $rowkey = "id:$objname:id";

	$stringkey = "";

	$listkey = "list:$objname:follows:";

	$setkey = "";

	$zsetkey = "";

	
	var_dump($result);

    }

    //create instance
    public function createInstance()
    {
	//

	//


    }	
}
