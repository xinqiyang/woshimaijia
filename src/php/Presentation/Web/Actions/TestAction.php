<?php
// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://www.woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <517577550@qq.com>
// +----------------------------------------------------------------------
/**
 * 测试模型
 * @author xinqiyang
 * @date   2010-5-31
 *
 */

class TestAction extends AppBaseAction {

	function showsql()
	{
		$d = D('user');
		$arr = $d->field('id,cnname,enname,password')->limit(10)->order('id desc')->select();
		dump($d->getLastSQL());
		dump($arr);
	}
	
	function showuuid()
	{
		$id = uuid();
		echo $id;
		echo "<br />";
		
	}
	
	function showauthcode()
	{
		$uid = bid();
		$password = md5('123456');
		$encode = authcode($uid, "ENDODE");
		$encodepass = authcode($password,"ENCODE");
		echo "<br />";
		var_dump($encode,$encodepass);
		echo "<br />";
		debug_start('decode');
		$decode = authcode($encode);
		$decodepass = authcode($encodepass);
		debug_end('decode');
		var_dump($decode,$decodepass);
	}
	
	function showbid()
	{
		$bigint = bid();
		echo $bigint;
		echo "<br />";
		echo date('Y-m-d H:i:s',substr($bigint, 0,10));
	}
	
	function testmd()
	{
		$m = new Memcached();
		$m->addServer('localhost', 11211);
		
		$items = array(
		    'key1' => 'value1',
		    'key2' => 'value2',
		    'key3' => 'value3'
		);
		$m->setMulti($items);
		$result = $m->getMulti(array('key1', 'key3', 'badkey'), $cas);
		var_dump($result, $cas);
	}
	
	function testmemcached()
	{
		import('Think.Util.Cache.CacheMemcached');
		$m = new CacheMemcached();
		
		var_dump($m->set('noexpire','aaaaass'));
		echo $m->get('noexpire');
		
		$m->set('int', 99);
		$m->set('string', 'a simple string');
		$m->set('array', array('aa'=>'bb', 12));
		/* expire 'object' key in 5 minutes */
		$m->set('object', new stdclass, time() + 300);
		
		
		var_dump($m->get('int'));
		var_dump($m->get('string'));
		echo "<br />";
		var_dump($m->get('array'));
		echo "<br />";
		var_dump($m->get('object'));
				
	}
	
	function testmemcachedshow()
	{
		import('Think.Util.Cache.CacheMemcached');
		$m = new CacheMemcached();
		
		//var_dump($m->set('testsss','aaaaass',3));
		echo $m->get('testssstt');
	}
	
	function index()
	{
		header('Content-Type:text/html;charset=utf-8');

//		$str = "<script>alert('aa');</script>";
//		
//		dump(tag('果汁'));
		

		//$str = '';
		//debug_start('test');

//		$d = D('image');
//		$ids = array(array('id'=>13),array('id'=>14),array('id'=>15));
//		
//		dump($d->mget(arraytostr($ids)));

//		$str = '[url]http://www.baidu.com/[/url]  我是买家 http://woshimaijia.com';
//		echo(ubb($str));

		//echo U('gogo/showurl',array('id'=>1));
		//echo getImage('100','m_');
		//$d = D('url');
		
		//$one = $d->find(144);
		//$d->cache->set('tests',$one);
		//$cache = $d->get(13);
		
//		$model = 'url';
//		$type = 'buynum' ;
//		$id = '1';
//		D($model)->setInc($type,"id=$id");
		
//		$str = 1284480000;
//		echo date('y-m-d',$str);
		//var_dump($cache);
		
		//debug_end('test');
		
//		$i = 0;
//		while (true)
//		{
//			$i++;
//			sleep(1);
//			echo  $i;
//			if($i > 10)
//			{
//				break;
//			}
//		}
		//
		$num = 0;
		$d = M('say');
		//dump($d);
		$_POST['ssss'] = 32323;
		//$_POST['user_id'] = 1;
		$_auto = array(
			array ('status','1'),
			array ('user_id','5'),
			array ('createtime','time',1,'function'),
		);
		
		$_validate =  array(
			array ('ssss','require','内容不能为空',1,'',1),
		);
		
		$_map = array(
			'ssss'=>'content',
		);
		$d->setProperty('_map', $_map);
		$d->setProperty('_auto', $_auto);
		$d->setProperty('_validate', $_validate);
		//dump($d);
		$d->getField('id');
		if($d->create())
		{
			$num = $d->add();
		}else{
			dump($d->getError());
		}
		dump($d->getLastSql());
		//dump('aaaaaaa');
		dump($num);
		
		
	}
	
	function showpost()
	{
		//dump($_POST);
		//dump($_POST['locationid']);
		dump(__SELF__);
	}

	function upp()
	{
		dump($_FILES['upfile']['tmp_name']);
		$rel = $this->upload('Group',true,200,200);
		dump($rel);
	}
	
	function test()
	{
		$d = D('tags');
		dump($d->getTags('人人'));
		dump($d->getLastSQL());
	}
	
	function testxml()
	{
		$d=D('user');
		$r = $d->field('id,enname,email')->limit(10)->select();
		//dump($r);
		$status = 0;
		if($r)
		{
			$status = 1;
		}
		dump($this->ajaxReturn($r,'','1','XML'));
	}
	
	function testhttpcws()
	{
		$a = httpcws('我确实比较喜欢来这个网店购物  i love you ,this site is so wonderful');
		var_dump($a);
	}
}


?>