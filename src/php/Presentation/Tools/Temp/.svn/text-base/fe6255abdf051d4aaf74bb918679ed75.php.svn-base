<?php if (!defined('BUDDY_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>PHP MVC Code Generator - by xinqiyang</title><link href="http://res.dev.woshimaijia.com/css/tools.css" rel="stylesheet" type="text/css" /><script src="http://res.dev.woshimaijia.com/js/jquery.min.js" type="text/javascript"></script><script>   
$(document).ready(function(){
    $("#build").click(function() {
		$.ajax({
		   type: "POST",
		   url: "/index/returnr",
		   data: $('#dbg').serialize(),
		   success: function(msg){
			 $("#result").html(msg);
		     $("#result").focus();
		   }
		});
   });
   $("#baction").click(function() {
		$.ajax({
		   type: "POST",
		   url: "/index/returna",
		   data: $('#dbg').serialize(),
		   success: function(msg){
			 $("#result").html(msg);
		     //alert( "Data Saved: " + msg );
		     $("#result").focus();
		   }
		});
   });
   $("#mbuild").click(function() {
		$.ajax({
		   type: "POST",
		   url: "/index/returnm",
		   data: $('#dbg').serialize(),
		   success: function(msg){
			 $("#result").html(msg);
		     //alert( "Data Saved: " + msg );
		     $("#result").focus();
		   }
		});
   });
});


function checkaction(v){ 
	if(v==0){ 
		tourl="/index/returnm";
	}else{ 
		tourl="/index/returna"; 
	} 
	this.click(function() {
		$.ajax({
		   type: "POST",
		   url: "/index/returnm",
		   data: $('#dbg').serialize(),
		   success: function(msg){
			 $("#result").html(msg);
		     //alert( "Data Saved: " + msg );
		     $("#result").focus();
		   }
		});
   });
	//dbform.submit();
	alert(tourl); 
} 

</script></head><body><div class="mainpage"><h1>PHP MVC Code Generator -- by xinqiyang</h1><div class="pleft"><h2>生成结果</h2><textarea id="result" rows="30" cols="80" style="background-color:#ffcc00;"></textarea></div><div class="pright"><h2>操作面板内容<a style="margin-left:10px;" href="/" style="color:black">刷新生成器</a></h2><h2>数据库表结构信息 </h2><form action="/index/index" method="post">	当前表<span style="color:red;"><?php if(isset($dbname)) { echo ($dbname); }  ?></span><select id="mn" name="mn"><?php if(is_array($dbtable)){ $i = 0; $__LIST__ = $dbtable;if( count($__LIST__)==0 ) { echo "" ; }else{ foreach($__LIST__ as $key=>$tb){ ++$i;$mod = ($i % 2 );?><option value="<?php if(isset($tb)) { echo ($tb); }  ?>"><?php if(isset($tb)) { echo ($tb); }  ?></option><?php } } } ?></select><input type="submit" name="tabname" value="提交选定表" /></form><br /><h2><a  id="baction" href="javascript:void()">生成ACTION代码</a><a style="margin-left:20px;" id="mbuild" href="javascript:void()">MODEL代码</a><a style="margin-left:20px;" id="build" href="javascript:void()">VIEW代码</a></h2><div id="db"><form id="dbg" name="dbg" action="/index/returnr" method="post" ><h2>数据库操作 <input type="radio" name="orp" value="1" checked />Add <input type="radio" name="orp" value="2" />Update <input type="radio" name="orp" value="3" />All </h2>   	模板页操作 <input type="radio" name="tt" value="list" />列表 <input type="radio" name="tt" value="add" />添加 <input type="radio" name="tt" value="edit" checked />编辑   <input style="padding-left:10px;" type="checkbox" name="adminc"  />后台编辑 <br /><input type="hidden" value="<?php if(isset($dbname)) { echo ($dbname); }  ?>" name="dbtable" /><?php if(is_array($var)){ $i = 0; $__LIST__ = $var;if( count($__LIST__)==0 ) { echo "" ; }else{ foreach($__LIST__ as $key=>$f){ ++$i;$mod = ($i % 2 );?><ul><li><span  name="Field"><?php if(isset($f["Field"])) { echo ($f["Field"]); }  ?></span><span  name="Comment"><?php  echo (($f["Comment"])?($f["Comment"]):'null');  ?></span><select  name="c<?php if(isset($f["Field"])) { echo ($f["Field"]); }  ?>"><option value="none">NONE</option><option value="input">INPUT</option><option value="select">SELECT</option><option value="radio" >RADIO</option><option value="textarea" >TextArea</option><option value="show" >Show</option><option value="validate" >Validate</option><option value="auto" >Auto</option></select></li></ul><?php } } } ?></form></div></div></div><div class="clear" /></body></html>