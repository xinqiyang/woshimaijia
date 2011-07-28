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
	alt="<?php if(isset($uinfo["enname"])) { echo ($uinfo["enname"]); }  ?>"  /></a></div><?php endif; ?></div></div><div id="content"><h1><?php if(isset($page["title"])) { echo ($page["title"]); }  ?></h1><div class="grid-16-8 clearfix"><div class="amain"><div class="signin"><strong>我是买家<span>买家分享社区</span></strong><div><b>534个城市</b><b><?php if(isset($page["num"]["0"])) { echo ($page["num"]["0"]); }  ?>个买家</b><b>逛了<?php if(isset($page["num"]["1"])) { echo ($page["num"]["1"]); }  ?>家购物站</b><br><em>晒了<?php if(isset($page["num"]["2"])) { echo ($page["num"]["2"]); }  ?>个购物单,建了<?php if(isset($page["num"]["1"])) { echo ($page["num"]["1"]); }  ?>个侃侃组,聊了<?php if(isset($page["num"]["0"])) { echo ($page["num"]["0"]); }  ?>个话题</em><br /><a href="<?php echo U('signup/index');?>" >加入我们 注册</a></div></div><div><div class="clear"></div><h2>今天大家常去的地方· · · · · ·<span class="pl">(<a  href="__URL__/gomore" >更多</a>)</span></h2><?php if(is_array($gogo)): $i = 0; $__LIST__ = $gogo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="mblock"><a class="goods_photo"
	href="<?php echo U('gogo/showurl',array('id'=>$vo['id']));?>"><img class="artist_s"
	alt="<?php if(isset($vo["title"])) { echo ($vo["title"]); }  ?>" src="<?php echo getImage($vo['image_id'],'m_');?>" title="<?php if(isset($vo["title"])) { echo ($vo["title"]); }  ?>"></a><div style="width: 100%;" class="ll"><a
	href="<?php echo U('gogo/showurl',array('id'=>$vo['id']));?>"><?php if(isset($vo["title"])) { echo ($vo["title"]); }  ?></a></div><div class="pl">(<?php if(isset($vo["gonum"])) { echo ($vo["gonum"]); }  ?>人逛过,
<?php if(($vo["category_id"] == 1) or ($vo["category_id"] == 3) ): ?><?php if(isset($vo["buynum"])) { echo ($vo["buynum"]); }  ?>买过
<?php else: ?><?php if(isset($vo["goodnum"])) { echo ($vo["goodnum"]); }  ?>推荐<?php endif; ?>)
</div></div><?php endforeach; endif; else: echo "" ;endif; ?><div class="clear"></div><h2>今天推荐大家一起买的· · · · · ·<span class="pl">(<a href="__URL__/gomore/">更多</a>)</span></h2><?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="gblock"><a class="goods_photo"
	href="<?php echo U('show/showgoods',array('id'=>$vo['gid']));?>"><img class="artist_s"
	alt="<?php if(isset($vo["title"])) { echo ($vo["title"]); }  ?>" src="<?php echo getImage($vo['image_id']);?>" title="<?php if(isset($vo["title"])) { echo ($vo["title"]); }  ?>"></a><div style="width: 100%;" class="ll"><a
	href="<?php echo U('show/showgoods',array('id'=>$vo['gid']));?>"><?php  echo (msubstr($vo["title"],0,24));  ?></a></div><div class="pl">(<?php if(isset($vo["likenum"])) { echo ($vo["likenum"]); }  ?>人喜欢,<?php if(isset($vo["wantnum"])) { echo ($vo["wantnum"]); }  ?>想买)</div></div><?php endforeach; endif; else: echo "" ;endif; ?><div class="clear"></div><h2>今天刚刚来的各位· · · · · ·<span class="pl">(<a href="__URL__/newhere">更多</a>)</span></h2><?php if(is_array($newusers)): $i = 0; $__LIST__ = $newusers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><dl class="oblock"><dt><a href="<?php echo U('people/space',array('id'=>$vo['id']));?>" class="nbg"><img
		src="<?php echo getImage($vo['image_id'],'m_');?>" class="m_sub_img"
		alt="<?php if(isset($vo["cnname"])) { echo ($vo["cnname"]); }  ?>"></a></dt><dd><a href="<?php echo U('people/space',array('id'=>$vo['id']));?>"><?php  echo (msubstr($vo["cnname"],0,6));  ?></a><br><span class="pl">(<?php  echo (($vo["city"])?($vo["city"]):'火星');  ?>)</span></dd></dl><?php endforeach; endif; else: echo "" ;endif; ?><div class="clear" ></div><h2>今天大家看过的品牌· · · · · ·<span class="pl">(<a href="__URL__/gomore/">更多</a>)</span></h2><?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="mblock"><a class="goods_photo"
	href="<?php echo U('show/showbrand',array('id'=>$vo['id']));?>"><img class="artist_s"
	alt="<?php if(isset($vo["title"])) { echo ($vo["title"]); }  ?>" src="<?php echo getImage($vo['image_id']);?>" height="50" width="70" title="<?php if(isset($vo["title"])) { echo ($vo["title"]); }  ?>"></a><div style="width: 100%;" class="ll"><a
	href="<?php echo U('show/showbrand',array('id'=>$vo['id']));?>"><?php if(isset($vo["title"])) { echo ($vo["title"]); }  ?></a></div><div class="pl">(<?php if(isset($vo["supportnum"])) { echo ($vo["supportnum"]); }  ?>人支持,<?php if(isset($vo["buynum"])) { echo ($vo["buynum"]); }  ?>买过)</div></div><?php endforeach; endif; else: echo "" ;endif; ?><div class="clear"></div></div></div><div class="aside"><?php if(empty($uinfo['id'])): ?><div class="login"><form id="form1" name="form1" method="post" action="<?php echo U('login/checklogin');?>"><fieldset><legend>登陆  我是买家</legend><div class="item"><label for="form_email">E-mail</label><input name="email" id="email" value="<?php if(isset($mail)) { echo ($mail); }  ?>" size="30" type="text" class="width170" tabindex="1"><a href="<?php echo U('signup/index');?>" >快速注册</a></div><div class="item"><label for="form_password">密码</label><input name="password" id="password" class="text" size="20" type="password" class="width170" tabindex="2"><a href="<?php echo U('login/forgetpass');?>">忘记密码</a></div><div class="iteml"><label for="form_remember"><input name="autologin" type="checkbox" id="autologin" class="mt5" />                记住我</label></div><div class="iteml"><input value="登   陆" type="submit" class="btn-submit"></div></fieldset></form></div><?php else: ?><?php if(empty($uinfo['id'])): ?><a href="<?php echo U('signin/index');?>" class="ulinkcss">&gt; 加入我是买家</a><br><br><a href="<?php echo U('login/index');?>" class="ulinkcss">&gt; 登陆我是买家</a><br><br><?php else: ?><div class="noticeblock"><a href="" class="ulinkcss" >用户信息提醒,比如头像等</a><br></div><div class="cat-col5"><a href="<?php echo U('gogo/url');?>" class="linkcss" title="大家去过的好的网站,网店 分享出来吧">&gt; 分享好地方</a><br><br><a href="<?php echo U('show/goods');?>" class="linkcss" title="想推荐大家一起买,晒晒我买的">&gt; 晒晒好东西</a><br><br><a href="<?php echo U('show/brand');?>" class="linkcss" title="我喜欢 的品牌我推荐,赶快行动!">&gt; 提交酷品牌</a><br><?php if((strtolower(ACTION_NAME) == 'showgroup')): ?><a href="<?php echo U('group/group');?>" class="ulinkcss">&gt; 新建侃侃组</a><br><br><a href="<?php echo U('group/topic',array('group_id'=>$gg['id']));?>" class="ulinkcss">&gt; 我要发言</a><br><br><a href="<?php echo U('group/join',array('group_id'=>$gg['id']));?>" class="ulinkcss">&gt; 加入<?php if(isset($vo["groupname"])) { echo ($vo["groupname"]); }  ?></a><br><br><br><a href="<?php echo U('group/quite',array('group_id'=>$gg['id']));?>" class="ulinkcss">&gt; 退出本组</a><br><br><?php endif; ?></div><div class="clear"></div><?php endif; ?><?php if((strtolower(ACTION_NAME) == 'showtopic') OR (strtolower(ACTION_NAME) == 'topic')): ?><a href="<?php echo U('group/topic',array('group_id'=>$topic['group_id']));?>" class="ulinkcss">&gt; 我要发言</a><br><br><a href="<?php echo U('group/showgroup',array('id'=>$topic['group_id']));?>" class="ulinkcss">&gt; 返回 <?php  echo (getGroupname($topic["group_id"]));  ?></a><br><br><?php endif; ?><?php endif; ?><?php if(!empty($uinfo['id'])): ?><h2>我说.....</h2><div id="commentdo" class="commentblock"><form id="sayform" name="sayform" method="post" action="<?php echo U('account/deal');?>"><div class="item"><textarea name="content" rows="1"></textarea></div><div><input type="hidden" name="actm" value="say" /><input type="hidden" name="ajax" value="1" /><input class="btn-submit" type="button" onclick="dopost()" value="发 表"><span id="sayresult" ></span></div></form></div><script type="text/javascript">
function dopost()
{

	$("#sayresult").hide();
	$.ajax({
		   type: "POST",
		   url: '<?php echo U('account/deal');?>',
		   data: $("#sayform").serialize(),
		   success: 
		   function(msg){
			 var obj = eval( "(" + msg + ")" );
			 $("#sayresult").html(obj.info);
			 $("#sayresult").slideDown("slow",function(){
				   //alert(obj.info);
				 //alert( "Data Saved: " + msg );
			 });
			 document.forms['sayform'].reset();
		   }
		});
}
</script><?php endif; ?><div class="cat-col5" style="margin-top:10px;"><a href=""><!-- <img src="__ROOT__/Resource/images/gg/1.png" />  --></a></div><h2>大家刚刚说 · · · · · <span class="pl">(<a href="/labels/">更多</a>)</span></h2><div style="float:left;width:100%;margin-bottom:3em"><?php if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><ul class="rblockul"><li class="mbtl"><a href="<?php echo U('people/space',array('id'=>$vo['uid']));?>"><img class="artist_s"
	alt="<?php  echo (msubstr($vo["cnname"],0,6));  ?>" src="<?php echo getImage($vo['image_id'],'m_');?>" title="<?php  echo (msubstr($vo["cnname"],0,6));  ?>" /></a></li><li class="mbtrmini"><a href="<?php echo U('people/space',array('id'=>$vo['uid']));?>"><?php if(isset($vo["cnname"])) { echo ($vo["cnname"]); }  ?></a><span class="pl">对 <a href="<?php echo U($module.'/show'.$model,array('id'=>$vo['gid']));?>" onclick=""><?php if(isset($vo["title"])) { echo ($vo["title"]); }  ?></a></span>说<br><div class="indentrec"><p style="word-break : break-all; word-wrap: break-word;"><?php  echo (nl2br(htmlspecialchars(msubstr($vo["content"],0,70))));  ?></p></div></li></ul><?php endforeach; endif; else: echo "" ;endif; ?></div></div><div class="extra"></div></div></div><div id="footer"><div class="fr"><a class="opt" style="margin-left:40px;" href="#top">返回顶部</a></div><div class="gray-link"><a href="<?php echo U('about/show',array('w'=>'aboutus'));?>">关于我是买家</a>|<a href="<?php echo U('about/show',array('w'=>'joinus'));?>">加入团队</a>|<a href="<?php echo U('about/show',array('w'=>'contactus'));?>">联系我们</a>|<a href="<?php echo U('about/show',array('w'=>'agreement'));?>">使用协议</a>|<a href="<?php echo U('about/show',array('w'=>'help'));?>">看看帮助</a>|<a href="<?php echo U('group/showgroup',array('id'=>'1'));?>">提提意见</a>|<a href="#" onclick="javascript:window.external.AddFavorite('__APP__','我是买家首页','我是买家首页');" rel="sidebar">加入收藏</a>|<a id="report" style="color:#c0c0c0" href="#">举报不良信息</a>		|<a  href="http://blog.woshimaijia.com/" target="_blank">我是买家官方博客</a></div><div style="float:right" class="gray-link">Copyright © woshimaijia.com 2010 All rights reserved.<a target="_blank" href="http://www.miibeian.gov.cn" >浙ICP备09035551号</a></div></div></div></body></html>