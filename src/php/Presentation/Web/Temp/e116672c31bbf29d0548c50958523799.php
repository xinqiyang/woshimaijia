<?php if (!defined('BUDDY_PATH')) exit();?><tagLib name="cx,html" /><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv='Refresh' content='<?php if(isset($waitSecond)) { echo ($waitSecond); }  ?>;URL=<?php if(isset($jumpUrl)) { echo ($jumpUrl); }  ?>'><title>我是买家 提醒</title><style>body {
	color:#000;
	font-size:12px;
	line-height:20px;
	background:#fff url(../Public/images/bg.gif);
	/*background:inherit; w3 css检测中出现 你没有为你的(前景)颜色设置背景色 可用该语句解决*/
	font-family: 'Lucida Grande','宋体','新宋体',arial,verdana,sans-serif;
  }


*{ padding:0; margin:0px}
.clear:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;}
img{border:0px; margin:0px;}
.c{ height: 1px; overflow: hidden; clear: both;}
ul,li{ list-style:none;}
a{color:#0000FF; text-decoration:none}
a:hover{color:#0033CC;}

#message{height:auto!important;height:200px;padding:10px;border:2px solid #c0c0c0;width:40%; margin:auto auto; margin-top:200px; background-color:#FFFFFF;}
.error{ color:#FF0000; font-size:14px; margin:10px;font-weight:800}
</style></head><body><h1>发生错误了，跳转到首页</h1></body></html>