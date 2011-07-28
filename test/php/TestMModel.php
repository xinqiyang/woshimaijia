<?php
require_once '../../src/php/Buddy/Functions.php';
require_once '../../src/php/Buddy/MModel.php';

//load CONFIG
C(include '../../src/php/Config/dev/data.conf.php');

/**
 * this Test will test all the public and used functions in the class
 *
 * @author xinqiyang
 *
 */
class MModelTest extends PHPUnit_Framework_TestCase
{
	public function testM()
	{
		$m = storeM('testtable');
		$this->assertEquals(true,is_object($m));
	}

	public function testS()
	{
		$s = storeS('testtable');
		$this->assertEquals(true,is_object($s));
	}

	public function testobjid()
	{
		$bigint = objid();
		$this->assertNotEmpty($bigint);
	}

	public function testadd()
	{
		$m = storeM('testtable');
		$num = mt_rand(100, 200);
		$time = time();
		$data = array('col1'=>$num,'col2'=>$num,'sort'=>1,'time'=>$time,'enable'=>1);
		$r = $m->add($data);
		$this->assertEquals(true,is_int($r));
	}

	public function testaddall()
	{

		$m = storeM('testtable');
		for($i=0;$i<2;$i++)
		{
			$num = mt_rand(100, 200);
			$time = time();
			$data[] = array('col1'=>$num,'col2'=>$num,'sort'=>1,'time'=>$time,'enable'=>1);
		}
		$r = $m->addAll($data);
		$this->assertEquals(true,is_int($r));

	}

	public function testcommit()
	{

	}

	public function testcreate()
	{

	}

	public function testdata()
	{

	}

	public function testdelete()
	{
		$m = storeM('testtable');
		$num = mt_rand(100, 200);
		$time = time();
		$data = array('col1'=>$num,'col2'=>$num,'sort'=>1,'time'=>$time,'enable'=>1);
		$m->add($data);
		$id = $m->getLastInsID();
		//del primary key value
		$r = $m->delete($id);
		$this->assertEquals(true,(is_int($r) && $r>0));
	}

	public function testexecute()
	{
		$m = storeM('testtable');
		//get last id
		$id = $m->order('id DESC')->getField('id','id>0');

		$str = mysql_escape_string('UPDATE'.date('Ymd H:i:s',time()));
		$sql = "UPDATE testtable SET col2='$str' WHERE id=$id";
		$r = $m->execute($sql);
		$this->assertEquals(true,(is_int($r) && $r>0));


	}

	public function testfind()
	{
		$m = storeM('testtable');
		//get last id
		$id = $m->order('id DESC')->getField('id','id>0');

		$r = $m->find($id);
		$this->assertEquals(true,(is_array($r) && isset($r['id']) && ($r['id']>0)));

	}

	public function testgetField()
	{
		$m = storeM('testtable');
		//get last id
		$id = $m->getField('id','id>0 ORDER BY id DESC');
		//var_dump($m->getLastSQL());
		$this->assertEquals(true,($id>0));
	}


	public function testgetLastInsID()
	{
		$m = storeM('testtable');
		$num = mt_rand(100, 200);
		$time = time();
		$data = array('col1'=>$num,'col2'=>$num,'sort'=>1,'time'=>$time,'enable'=>1);
		$last = $m->add($data);
		//
		$id = $m->getLastInsID();
		$this->assertEquals(true,($id>0 && $id===$last));
	}

	public function testgetModelName()
	{
		$modelname = 'testtable';
		$m = storeM($modelname);
		$getmodelname = $m->getModelName();
		$this->assertEquals(true,($modelname === $getmodelname));
	}

	public function testgetPk()
	{
		$pk = 'id';
		$m = storeM('testtable');
		$this->assertEquals(true,($pk === $m->getPk()));
	}

	public function testgettableame()
	{
		$modelname = 'testtable';
		$m = storeM($modelname);
		$gettablename = $m->getTableName();
		$this->assertEquals(true,($modelname === $gettablename));
	}

	public function testquery()
	{

		$condition = array('col1'=>"3",'sort'=>'1');
		foreach($condition as &$one)
		{
			$one = mysql_escape_string($one);
		}
		extract($condition);
		$m = storeM('testtable');
		$sql = sprintf("SELECT * from testtable WHERE col1>%s and sort=%s ORDER BY id DESC LIMIT 5",$col1,$sort);
		$r = $m->query($sql);
		$this->assertEquals(true,count($r)>0);
	}

	public function testselect()
	{
		$m = storeM('testtable');
		$r = $m->where('id>0')->select();
		$this->assertEquals(true,count($r)>0);
	}

	public function testcreateandadd()
	{
		$_POST['col1'] = 'col1199';
		$_POST['col2'] = 'col2199';
		$_POST['sort'] = 1;
		$_POST['time'] = time();
		$_POST['enable'] = 1;

		$m = storeM('testtable');
		$c = $m->create();
		if($c)
		{
			$id = $m->add();
			$this->assertEquals(true,$id>0);

		}else{
			var_dump($m->getError());
		}
	}

	public function testcreateandsave()
	{
		$_POST['id'] = 199;
		$_POST['col1'] = 'col1'.rand(100,300);
		$_POST['col2'] = 'col2199'.rand(100,300);
		//$_POST['sort'] = 1;
		//$_POST['time'] = time();
		//$_POST['enable'] = 1;

		$m = storeM('testtable');
		$c = $m->create();
		if($c)
		{
			$id = $m->save();
			$this->assertEquals(true,$id==1);
		}else{
			var_dump($m->getError());
		}
	}


	public function testcreateandvalidate()
	{
		/*
		 $_POST['col1'] = '192BB'; //TODO:change the value
		 $_POST['col2'] = 'col2199';
		 $_POST['sort'] = 1;
		 $_POST['time'] = time();
		 $_POST['enable'] = 1;

		 $m = storeM('testtable');
		 $validate = array(
			array('col1','','col1 is not unique',1,'unique'),
			array('col2','require','col2 is require',1,''),
			);
			$m->setProperty("_validate",$validate);
			if(!$m->create())
			{
			var_dump($m->getError());
			}else{
			$this->assertEquals(true,true);
			}
			*/

	}

	public function testautovalidaterule()
	{

		$_POST['col1'] = '192aa111';
		$_POST['col2'] = 'http://www.baidu.com/';
		$_POST['sort'] = 1;
		$_POST['time'] = time();
		$_POST['enable'] = 1;

		$m = storeM('testtable');
		//验证字段,验证规则,错误提示,验证条件（可选）,附加规则（可选）,验证时间（可选）
		//验证规则：结合附加条件 require email url currency number
		//验证条件：0存在及验证（默认）  1必须验证   2值不为空的时候验证
		//附加规则：regex （默认） function  callback  confirm equal in unique 这里可以扩展
		$validate = array(
		array('col1','','col1 is not unique',1,'unique'),
		//array('col2','require','col2 is require',1),
		array('col2','url','col2 is not url',1),
		);
		$m->setProperty("_validate",$validate);
		if(!$m->create())
		{
			var_dump($m->getError());
		}else{
			$id = 1;//$m->add();
			$this->assertEquals(true,$id>0);
		}

	}


	public function testautocomplete()
	{
		/*
		 $_POST['col1'] = '1211192BB'; //TODO:change the value
		 $_POST['col2'] = '22col2199';
		 $_POST['sort'] = 1;
		 $_POST['time'] = 1;
		 $_POST['enable'] = 1;

		 $m = storeM('testtable');
		 //填充字段，填充内容，填充条件，附加规则
		 //
		 $auto = array(
			array('col1','md5',1,'function'),
			array('time','time',1,'function'),
			);
			$m->setProperty("_auto",$auto);
			if(!$m->create())
			{
			var_dump($m->getError());
			}else{
			$id = $m->add();
			$this->assertEquals(true,$id>0);
			}
			*/

	}
}


