<?php
//日志分析类
//date_default_timezone_set('UTC');

function timeFormat($time)
{
	$str = str_replace('/', '-', $time);
	$str[11] = " ";
	return strtotime($str);
}

function skip_mod($val, $mod)
{
	return $val - ($val % $mod);
}

function format_custom_log($line)
{
	$ary =  explode(' ', $line, 7);
	if ($ary[5] == '-') {
		$ary[5] = 'xxx.com';
	}
	$site = $ary[5]; 
	$p = strrpos($site, ':');
	if ($p !== false)
	{
		$site = substr($site , 0, $p);
	}

	return array( 'time' => substr($ary[3], 1,17)
			, 'level' => 'custom'
			, 'site'=> $site );
}

function insert_ary($time, &$ary, $count)
{
	/*
	   if (!isset($ary[$time])) {
	   $ary[$time] = 1;
	   } else {
	   $ary[$time] += 1;
	   }
	 */
	$ary[$time] += $count;
}

function any_log($input)
{
	$fp = fopen($input, 'r');
	if (!$fp) {
		echo "can't open $input to read\n";
		exit;
	}

	$hourTable = array();
	$dayTable = array();
	$minTable = array();

	$oldtime = '';	
	$tf = '';	
	$min = '';	
	$hour = '';	
	$day = '';	

	$cnt=array();	

	while (!feof($fp)) {
		$line = fgets($fp, 2048);
		if (!$line) {
			continue;
		}
		$ary = format_custom_log(trim($line)); 

		if ($ary == null) {
			continue;
		}
		if ( $oldtime != $ary['time'] ) {
			$oldtime = $ary['time'];
			$min = timeFormat($ary['time']);
			//$min = skip_mod($tf, 60);
			$hour = skip_mod($tf, 3600);
			$day = skip_mod($tf, 86400);
		}
		$cnt[$ary['site']]++;
	}
	foreach ($cnt as $site=>$s_cnt) {
		insert_ary($hour, $hourTable[$site], $s_cnt);
		insert_ary($day, $dayTable[$site], $s_cnt);
		insert_ary($min, $minTable[$site], $s_cnt);
	}

	fclose($fp);

	var_dump($hourTable);
	var_dump($dayTable);
	var_dump($minTable);

}

$count=50000;
$t1=gettimeofday(true);
any_log($argv[1]);
$t2=gettimeofday(true);
echo $count/($t2-$t1);