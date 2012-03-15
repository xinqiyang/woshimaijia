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

/**
 * Test Suite for woshimaijia project 
 * run a testcase :   php TestSuite.php TestAction 
 * run all testcase :   php TestSuite.php
 * 
 */
require 'TestHelper.php';
//get the dir of the this, then run the test

//if have the var of the script then run the one file
if(isset($_SERVER['argv'][1]) && isset($_SERVER['argv'][2]))
{
	$file = $_SERVER['argv'][1].DIRECTORY_SEPARATOR.$_SERVER['argv'][2].'.php';
	if(is_file($file)){
		echo "RUN TEST START： ".$file ."\n";
		echo "----------------------------------------------------------------------------\n";
		echo shell_exec('phpunit --colors '.$file);
		echo "----------------------------------------------------------------------------\n";
		die;
	}
	echo "{$_SERVER['argv'][1]} FILE NOT FIND ,PLEASE CHECK \n";
	die;
}

//run all tests of the project
$path = dirname(__FILE__);
//@TODO if add the documents then add to here
$dirs = array('BuddyTests','ServicesTests','WoshimaijiaTests');

$testFiles = array();
foreach ($dirs as $val)
{
	$files = getAllFiles($path.DIRECTORY_SEPARATOR.$val);
	$testFiles = array_merge($testFiles,$files);
}

//fun test get the all files of 
if(!empty($testFiles))
{
	//run all the test cases 
	foreach ($testFiles as $key=>$file)
	{
		echo "RUN TEST START： $file \n";
		echo "----------------------------------------------------------------------------\n";
		echo shell_exec("phpunit $file");
		echo "----------------------------------------------------------------------------\n";
		
	}
	echo "ALL TEST CASE RUN COMPLETE！ ^_^ \n";
}
