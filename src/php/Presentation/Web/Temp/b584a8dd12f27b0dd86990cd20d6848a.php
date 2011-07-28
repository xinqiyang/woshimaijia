<?php if (!defined('BUDDY_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php if(isset($page["head"]["title"])) { echo ($page["head"]["title"]); }  ?> 我是买家</title><meta http-equiv="Pragma" content="no-cache" /><meta http-equiv="Expires" content="Sun, 6 Mar 2005 01:00:00 GMT" /><meta name="keywords" content="<?php if(isset($page["head"]["tags"])) { echo ($page["head"]["tags"]); }  ?>" /><meta name="description" content="<?php if(isset($page["head"]["desc"])) { echo ($page["head"]["desc"]); }  ?>" /><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/jquery-1.4.2.min.js"></script><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/common.js"></script><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/validity.js"></script><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/jquery.colorbox-min.js"></script><link rel="shortcut icon" href="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/favicon.ico"  type="image/x-icon" /><link href="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/css/wsmj.css" rel="stylesheet" type="text/css" /><script type="text/javascript">
$(document).ready(function(){
	$(".linkcss").colorbox({width:"980px", height:"550px", iframe:true});
});
</script><?php if(ACTION_NAME == 'goods'): ?><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/areaArr2.js"></script><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/jquery.showArea.js"></script><script type="text/javascript">
$(document).ready(function(){
	$("#perNative").click(showArea);
	
});
</script><?php endif; ?><?php if(ACTION_NAME == 'showtopic'): ?><script type="text/javascript">
$(document).ready(function(){
	
});
</script><?php endif; ?><?php if((ACTION_NAME == 'showurl') OR (ACTION_NAME == 'showgoods') OR (ACTION_NAME == 'showbrand')): ?><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/jquery.lightbox-0.5.min.js"></script><script type="text/javascript">
$(function() {
    $('#gallery a').lightBox();
});
function usaction(action,gid)
{
	var btnaction = "#" +action;
	
	$("#result").hide();
	var btnnow =parseInt($(btnaction).html());
	
	$.ajax({
		   type: "POST",
		   url: '<?php echo U('deal/relmodel');?>',
		   data: "id="+gid+"&action="+action+"&module=<?php echo constant("ACTION_NAME");?>",
		   success: 
		   function(msg){
			 var obj = eval( "(" + msg + ")" );
			 
			 $("#result").html(obj.data);
			 
				 $("#result").slideDown("slow",function(){
					 if(obj.info)
					 {
					 //复制下来的时候 IE 会保存原来的CSS 而FF CHROME也会复制CSS
					 $(btnaction+"list").append($("#userico").clone());
					 //操作成功完了+1
					 $(btnaction).html(btnnow + 1 );
					 }
				 });
			 
		   }
		});
	
}

function clickaction(gid,url)
{
	$.ajax({
		   type: "POST",
		   url: '<?php echo U('deal/clickaction');?>',
		   data: "id="+gid+"&url="+url+"&module=<?php echo constant("ACTION_NAME");?>",
		   success: 
		   function(msg){
			 return true;
		   }
		});
	
}

</script><?php endif; ?><?php if(ACTION_NAME == 'space'): ?><script type="text/javascript">
function dofocus(gid)
{
	
	$("#focusid").hide();
	$.ajax({
		   type: "POST",
		   url: '<?php echo U('deal/relmodel');?>',
		   data: "id="+gid+"&action=focus&module=showuser",
		   success: 
		   function(msg){
			 var obj = eval( "(" + msg + ")" );
			 
			 $("#focusid").html(obj.data);
			 
				 $("#focusid").slideDown("slow",function(){
					 if(obj.info)
					 {
						 $("#myfriendlist").append($("#userico").clone());
						 $("#btnfocus").hide();
					 }
				 });
			 
		   }
		});
	
}
</script><?php endif; ?></head><body><div class="top-nav"><div class="bd"><div class="top-nav-info"><?php if(empty($uinfo['id'])): ?>欢迎来到我是买家 <a href="<?php echo U('signup/index');?>"
	class="bn-radio" title="注册">注册</a><a href="<?php echo U('login/index');?>" class="bn-radio">登陆</a><?php else: ?><a href="<?php echo U('people/space',array('id'=>$uinfo['id']));?>" class="bn-radio">我的主页</a><a href="<?php echo U('mail/index');?>">消息<php>echo haveMail();</php></a><a
	href="<?php echo U('account/setting');?>"><?php if(isset($uinfo["enname"])) { echo ($uinfo["enname"]); }  ?>的设置</a><a
	href="<?php echo U('login/logout');?>">退出</a><?php endif; ?></div></div></div><div id="wrapper"><div id="header"><div class="site-nav"><div class="site-nav-logo pro-logo"><a href="__APP__" title="我是买家"><img
	src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/nav/logo.gif" alt="我是买家-买家分享社区"></a></div><form id="grobleform" name="ssform" method="post" action="<?php echo U('search/dosearch');?>"><div id="searbar" class="nav-srh"><span><input
	name="search_text" title="开始搜索" type="text" size="22"
	maxlength="60" value="" id="good_search" autocomplete="off"
	class="inputline"><input type="submit" value="搜 搜"
	class="btn-search"></span></div></form><div class="site-nav-items"><ul><li><a href="__APP__">首页</a></li><li><a href="<?php echo U('people/index');?>">大家</a></li><li><a href="<?php echo U('together/index');?>">一起</a></li><li><a href="<?php echo U('gogo/index');?>">逛逛</a></li><li><a href="<?php echo U('show/index');?>">晒晒</a></li><li><a href="<?php echo U('group/index');?>">侃侃</a></li></ul></div><?php if(empty($uinfo['id'])): ?><div class="user"><a id="userico" 
	href="__APP__/"><img
	src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/default/userdefault.gif" title="我是买家"
	alt="我是买家-买家体验社区"  /></a></div><?php else: ?><div class="user"><a id="userico"
	href="<?php echo U('people/space',array('id'=>$uinfo['id']));?>"><img
	src="<?php  echo (getImage($uinfo["image_id"],'m_'));  ?>" title="<?php if(isset($uinfo["enname"])) { echo ($uinfo["enname"]); }  ?>"
	alt="<?php if(isset($uinfo["enname"])) { echo ($uinfo["enname"]); }  ?>"  /></a></div><?php endif; ?></div></div><div id="content"><h1><?php if(isset($page["title"])) { echo ($page["title"]); }  ?></h1><div class="grid-16-8 clearfix">home
   </div></div><div id="footer"><div class="fr"><a class="opt" style="margin-left:40px;" href="#top">返回顶部</a></div><div class="gray-link"><a href="<?php echo U('about/show',array('w'=>'aboutus'));?>">关于我是买家</a>|<a href="<?php echo U('about/show',array('w'=>'joinus'));?>">加入团队</a>|<a href="<?php echo U('about/show',array('w'=>'contactus'));?>">联系我们</a>|<a href="<?php echo U('about/show',array('w'=>'agreement'));?>">使用协议</a>|<a href="<?php echo U('about/show',array('w'=>'help'));?>">看看帮助</a>|<a href="<?php echo U('group/showgroup',array('id'=>'1'));?>">提提意见</a>|<a href="#" onclick="javascript:window.external.AddFavorite('__APP__','我是买家首页','我是买家首页');" rel="sidebar">加入收藏</a>|<a id="report" style="color:#c0c0c0" href="#">举报不良信息</a>		|<a  href="http://blog.woshimaijia.com/" target="_blank">我是买家官方博客</a></div><div style="float:right" class="gray-link">Copyright © woshimaijia.com 2010 All rights reserved.<a target="_blank" href="http://www.miibeian.gov.cn" >浙ICP备09035551号</a></div></div></div></body></html>