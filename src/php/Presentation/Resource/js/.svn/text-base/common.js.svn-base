//定义一个全局变量
var followids = [] ;

function test()
{
    var url = $.consts.root;
    var newurl = $.consts.mname +'/'+ $.consts.aname;
    alert (url);
}

function openwin(url) { 
    window.open(url,"","width=100%,height=100%");
} 

var btnreply = 0;
function reply(id)
{
    if(btnreply == 1){
        $("#postreply").hide();
        btnreply = 0;
    }else{
        //请求ajax
        //调用评论显示列表
        getreplylist(id);
        //这里得去请求评论
        var postform = "<form id='postreply' action='/post/deal' method='post' name='postreply'>" +
        "<input type='hidden' value='postreply' name='form' />" +
        "<input id='postreplycontent' type='text' value='' name='content' style='width:400px' /> " +
        "<input type='hidden' value='" + id +"' name='object_id' /> " +
        "<input type='button' value='发送' onclick=\"userpostreply('"+ id +"')\" /> " +
        "</form>";
        $("#ureply_"+id).html(postform);
        btnreply = 1;
    }
}

function usercopy(id)
{
    if(btnreply == 1){
        $("#postreply").hide();
        btnreply = 0;
    }else{
		
        //这里得去请求评论
        var postform = "<form id='postreply' action='/post/deal' method='post' name='postreply'>" +
        "<input type='hidden' value='postreply' name='form' />" +
        "<input id='postreplycontent' type='text' value='//转发' name='content' /> " +
        "<input type='hidden' value='" + id +"' name='object_id' /> " +
        "<input type='button' value='发送' onclick=\"usercopyreply('"+ id +"')\" /> " +
        "</form>";
        $("#ureply_"+id).html(postform);
        btnreply = 1;
    }
}



function usercopyreply(id)
{
    var content = $('#postreplycontent').attr('value');
    $.ajax({
        type: "POST",
        url: '/input/deal',
        data: "object_id="+id+"&form=usercopy&content="+content,
        success: 
        function(msg){
            $return = eval('('+ msg + ')');
            if($return.status == 0)
            {
                //回复+1
                $("#postreply").hide();
                var usercopynum = parseInt($("#usercopynum_"+id).html());
                usercopynum = usercopynum + 1;
                $("#usercopynum_"+id).html(usercopynum);
                btnreply = 0;
            }
            return true;
        }
    });
}

function usaction(form,action,gid,hash)
{
    var btnaction = "#" +action;
    $("#result").hide();
    var btnnow =parseInt($(btnaction).html());
	
    $.ajax({
        type: "POST",
        url: '/input/deal',
        data: "id="+gid+"&type="+action+"&form=useraction&__hash__="+hash,
        success: 
        function(msg){
            var obj = eval( "(" + msg + ")" );
            $("#result").html(obj.data);
            $("#result").slideDown("slow",function(){
                if(obj.info)
                {
                    $(btnaction+"list").append($("#userico").clone());
                }
            });
			 
        }
		   
    });
    //reflash page 
    window.location.reload(); 
}

//post all the data to server
function doPost(form,content,hash)
{
    $.ajax({
        type: "POST",
        url: '/input/deal',
        data: "content="+content+"&form="+form+"&__hash__="+hash,
        success:
        //reflash page 
        window.location.reload()
    });
		
}

function getreplylist(id)
{
    if(!id){
        return false;
    }
    $.ajax({
        type: "POST",
        url: '/input/deal',
        data: "id="+id+"&form=postreplylist",
        success:
        function(msg){
            var rreturn = eval('('+ msg + ')');
            if(rreturn.status == 0)
            {
                var content ='<ul id="preply_"'+id+'>';
                $.each(rreturn.data,function(n,value){
					   
                    content += "<li>"+value.screenname +" 说："+value.content + "  " + value.time + "</li>"
                });
                content += '</ul>';
                $('#replylist_'+id).html(content);
            }
            return true;
        }
    });
		
}


function userpostreply(id)
{
    var content = $('#postreplycontent').attr('value');
    $.ajax({
        type: "POST",
        url: '/input/deal',
        data: "object_id="+id+"&form=postreply&content="+content,
        success: 
        function(msg){
            var ureturn = eval('('+ msg + ')');
            if(ureturn.status == 0)
            {
                //回复+1
                $("#postreply").hide();
                var replynum = parseInt($("#replynum_"+id).html());
                replynum = replynum + 1;
                $("#replynum_"+id).html(replynum);
                var licontent = "我 说： " + content+" 刚刚..<br />";
                $("#replynew_"+id).html(licontent);
                btnreply = 0;
            }
            return true;
        }
    });
}


function userfollow(uid,type)
{
    $.ajax({
        type: "POST",
        url: '/input/deal',
        data: "id="+uid+"&form=userfollow&type=" + type,
        success: 
        function(msg){
            $return = eval('('+ msg + ')');
            if($return.status == 0)
            {
                if (type == 'follow') {
                    $(".focus_"+uid).html('<a href="javascript:void(0)" onclick="userfollow('+uid+', \'unfollow\')">取消关注</a>');
                } else {
                    $(".focus_"+uid).html('<a href="javascript:void(0)" onclick="userfollow('+uid+', \'follow\')">关注</a>');
                }
            }
            return true;
        }
    });
}

/**
 * @param id
 * @param type
 */
function clickaction(id,type)
{
    if(uid == "")
    {
        $(".result").html("请先<a href='/login'>登录</a>");
        return false;
    }
	
    if(id == "" || type == "")
    {
        return false;
    }
	
    $.ajax({
        type: "POST",
        url: '/input/deal',
        data: "id="+id+"&form=userdoaction&type=" + type,
        success: 
        function(msg){
            var ret = eval('('+ msg + ')');
            if(ret.status == 0)
            {
                if(ret.data == 1) {
                    var btnaction = "#" +type+'num';
                    var btnnow =parseInt($(btnaction).html());
                    $(".result").html('操作成功');
                    if(type == 'like' || type == 'own' || type=='willbuy'){
                        $(btnaction).html(btnnow + 1 );
                        $("#"+type+"list").append($("#userico").clone());
                    }
                    $("#"+type+"_"+id).hide();
                }
				   
                if(ret.data == 1 && (type == 'del' || type=='tcdel')){
                    $("#reply_"+id).hide();
                }
				   
                if(type == 'tdel' && ret.data == 1){
                    self.location = '/group';
                }
				   
                if(type == 'top'){
                    $(".result").html('<a href="javascript:void(0)" onclick="userfollow('+uid+', \'unfollow\')">取消关注</a>');
                }
				   
                if(type == 'lock'){
                    $(".lock").html('<a href="javascript:void(0)" onclick="userfollow('+uid+', \'unfollow\')">取消关注</a>');
                }
            }
            return true;
        }
    });
}


//一个用户只取一次做页面上
function usercheckfollow(paramuid)
{
    if(paramuid == "")
    {
        return false;
    }
    var index = $.inArray(paramuid,followids);
    if(index == -1 && (paramuid != uid)){
        $.ajax({
            type: "POST",
            url: '/input/deal',
            data: "id="+paramuid+"&form=usercheckfollow",
            success: 
            function(msg){
                var data = eval('(' + msg + ')');
                if (data.data == '1') {
                    $(".focus_"+paramuid).html('');
                } else if(data.data == '2') {
                    $(".focus_"+paramuid).html('<a href="javascript:void(0)" onclick="userfollow('+paramuid+', \'unfollow\')">取消关注</a>');
                }else if(data.data =='3'){
                    $(".focus_"+paramuid).html('<a href="javascript:void(0)" onclick="userfollow('+paramuid+', \'follow\')">关注</a>');
                }
                followids.push(paramuid);
                return true;
            }
        });
    }
    return false;
}



//------------------------------------------------------
//传入一个触发的代码
function allpostaction(form)
{
    var formaction = "#" +form;
    $("#result").hide();
    $("#mybtn").click(function()//提交表单
    {
        alert("ddd");
        var options = {
            target:'#result', //后台将把传递过来的值赋给该元素
            url:'/input/deal', //提交给哪个执行
            type:'POST', 
            resetForm:true,
            success: function(msg){
                var obj = eval( "(" + msg + ")" );
                //完成后更新页面
                $("#result").html = obj.info;
                alert(obj);
            } //显示操作提示
        }; 
        $(formaction).submit(function() { $(this).ajaxSubmit(options); return false; });
    }); 
}

//@TODO 锁住点击的按钮
function lockclickbutton()
{

}



function addtag(tag)
{
    $("#ccontent").append("#"+tag+"#");
}


function postData()
{
    var content = $("#ccontents").val();
    var lableform = $('#form').attr('value');
    $.ajax({
        type: "POST",
        url: '/input/deal',
        data: "content="+content+"&form="+lableform,
        success: 
        function(msg){
            webreturn = eval('('+ msg + ')');
            if(webreturn.status == 0)
            {
                $("#result").html('发布成功 ^_^');
                $("#ccontents").val('');
            }else{
                $("#result").html(webreturn.info);
            }
            return true;
        }
    });
}