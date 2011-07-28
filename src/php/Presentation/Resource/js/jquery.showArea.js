//-----------------------
//作者：亮亮
//邮件：ljlyy[@]126.com
//博客：www.94this.com.cn
//欢迎修改，有什么问题请到博客留言或邮件交流
//修改by xinqiyang ,重新设置了加载的省份和信息,设置Input的ID值
//-----------------------
function showArea(){
	$("#addr").remove();
	var iptName=$(this).attr("id");
	var iptOffSet=$(this).offset();
	var iptLeft=iptOffSet.left-160;
	var iptTop=iptOffSet.top+20;
	var str="<div id='addr'><span>请选择地点<a id='fh'>返回省份列表</a><a id='gb'>[&nbsp;关闭&nbsp;]</a></span><ul></ul><div style='clear:both;'></div></div>";
	areasLen=provinceArr.length;
	var str2="";
	//获取省份的列表
	for(var i=0;i<areasLen;i++){
		str2=str2+"<li id='p"+provinceArr[i][0]+"'>"+provinceArr[i][1]+"</li>";
	}
	//body里面添加一个节点
	$("body").append(str);
	//添加省份
	$("#addr ul").append(str2);
	$("#addr").css({left:iptLeft+"px",top:iptTop+"px"});
	//绑定点击事件,点击返回省份列表的操作
	$("#addr span a#fh").bind("click",function(){
		$("#addr ul").empty();
		$("#addr ul").append(str2);
		//点击省份的操作
		$("#addr ul li").bind("click",{iptn:iptName},liBind);
	});
	//点击关闭的操作
	$("#addr span a#gb").bind("click",function(){
		$("#addr").remove();
	});
	//绑定单击事件
	$("#addr ul li").bind("click",{iptn:iptName},liBind);
}
function setVal(event){
	var setipt2=event.data.ipt2;
	var iptText=$(this).text();
	var iptVal=$(this).attr("id");
	$("#locationid").val(iptVal.substring(1,5));
	$("#"+setipt2).val(iptText);
	//alert(iptText);
	$("#addr").css("display","none");
}
function liBind(event){
	var setipt=event.data.iptn;
	var liId=$(this).attr("id");
	var liText=$(this).text();
	var pArr=eval(liId);
	pLen=pArr.length;
	if(pLen==0){
		//截取前5位设置
		//perNativeVal 设置隐藏域的值
		$("#locationid").val(liId.substring(1,5));
		//设置当前input的value值
		$("#"+setipt).val(liText);
		//移除d
		$("#addr").css("display","none");
		}
	else{
		listr="";
		for(j=0;j<pLen;j++){
			listr=listr+"<li id='c"+pArr[j][0]+"'>"+pArr[j][1]+"</li>";
			}
			$("#addr ul").empty();
			$("#addr ul").append(listr);
			$("#addr ul li").bind("click",{ipt2:setipt},setVal);
		}	
}