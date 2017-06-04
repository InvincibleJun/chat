<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<title>用户中心</title>
<link href="/css/bootstrap.min.css" title="" rel="stylesheet" />
<link title="" href="css/style1.css" rel="stylesheet" type="text/css"  />
<link title="blue" href="css/dermadefault.css" rel="stylesheet" type="text/css"/>
<link title="green" href="css/dermagreen.css" rel="stylesheet" type="text/css" disabled="disabled"/>
<link title="orange" href="css/dermaorange.css" rel="stylesheet" type="text/css" disabled="disabled"/>
<link href="css/templatecss.css" rel="stylesheet" title="" type="text/css" />
<script src="/js/jquery.min.js"></script>
<script src="script/jquery.cookie.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>
<nav class="nav navbar-default navbar-mystyle navbar-fixed-top">
  <div class="navbar-header">
    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
     <span class="icon-bar"></span> 
     <span class="icon-bar"></span> 
     <span class="icon-bar"></span> 
    </button>
    <a class="navbar-brand mystyle-brand"><span class="glyphicon glyphicon-home"></span></a> </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="li-border"><a class="mystyle-color" href="/administration">管理控制台</a></li>   
    </ul>
    
    <ul class="nav navbar-nav pull-right">
       <li class="li-border">
          <a href="#" class="mystyle-color">
            <span class="glyphicon glyphicon-bell"></span>
            <span class="topbar-num">0</span>
          </a>
      </li>
 
      <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">{{$name}}<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/admin">退出</a></li>
        </ul>
      </li>
      <li class="dropdown"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">换肤<span class="caret"></span></a>
        <ul class="dropdown-menu changecolor">
          <li id="blue"><a href="#">蓝色</a></li>
          <li class="divider"></li>
          <li id="green"><a href="#">绿色</a></li>
          <li class="divider"></li>
          <li id="orange"><a href="#">橙色</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div class="down-main">
  <div class="left-main left-full">
    <div class="sidebar-fold"><span class="glyphicon glyphicon-menu-hamburger"></span>
    </div>
    <div class="subNavBox">
      <div class="sBox">
        <ul class="navContent" style="display:block">
          <li class="active">
            <a href=""><span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">主页</span></a> 
          </li>
          <li>
            <a href="javascript:toAriticle()"><span class="sublist-icon glyphicon glyphicon-book"></span><span class="sub-title">帖子管理</span></a> </li>
          <li>
          <li>
            <a href="javascript:toRepot()"><span class="sublist-icon glyphicon glyphicon-folder-open"></span><span class="sub-title">回复管理</span></a> </li>
          <li>
            <a href="javascript:toUser()"><span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">用户管理</span></a>
          </li>
          <li>
            <a href="javascript:toAdmin()"><span class="sublist-icon glyphicon glyphicon-th-list"></span><span class="sub-title">管理员权限</span></a>
          </li>
          <li>
            <a href="javascript:toMessage()"><span class="sublist-icon glyphicon glyphicon-envelope"></span><span class="sub-title">站内信</span></a></li>
        </ul>
      </div>

      <div class="sBox">
        
      </div>
    </div>
  </div>
</div>
  <div class="right-product my-index right-full" style="padding-top: 50px;z-index:100" >
     <div class="container-fluid" id="index">
  	   <div class="info-center">
              <div class="info-title">
                <div class="pull-left">
                  <h4><strong>{{$name}}</strong></h4>
                  <p>欢迎登录管理系统！</p>
                </div>
                <div class="time-title pull-right">
                    <div class="year-month pull-left">
                      <p id="date_d"></p>
                      <p id="date_e"><span>2016</span>年8月23日</p>
                    </div>
                    <div class="hour-minute pull-right">
                       <strong id="date_t"></strong>
                    </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="content-list">
                 <div class="row">
                   <div class="col-md-3">
                      <div class="content">
                         <div class="w30 left-icon pull-left">
                            <span class="glyphicon glyphicon-file blue"></span>
                         </div>
                         <div class="w70 right-title pull-right">
                         <div class="title-content">
                             <p>总帖数</p>
                             <h3 class="number">{{$article}}</h3>
                        
                         </div>
                         </div>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                    <div class="col-md-3">
                      <div class="content">
                         <div class="w30 left-icon pull-left">
                            <span class="glyphicon glyphicon-file violet"></span>
                         </div>
                         <div class="w70 right-title pull-right">
                         <div class="title-content">
                             <p>用户数</p>
                             <h3 class="number">{{$user}}</h3>
                 
                         </div>
                         </div>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                    <div class="col-md-3">
                      <div class="content">
                         <div class="w30 left-icon pull-left">
                            <span class="glyphicon glyphicon-file orange"></span>
                         </div>
                         <div class="w70 right-title pull-right">
                         <div class="title-content">
                             <p>回复数</p>
                             <h3 class="number">{{$message}}</h3>
                         </div>
                         </div>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                    <div class="col-md-3">
                      <div class="content">
                         <div class="w30 left-icon pull-left">
                            <span class="glyphicon glyphicon-file green"></span>
                         </div>
                         <div class="w70 right-title pull-right">
                         <div class="title-content">
                             <p>今日访问量</p>
                             <h3 class="number">{{$today}}</h3>
                         </div>
                         </div>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                 </div>
         </div>			
  	 </div>
  </div>


  <div style="padding:20px;display: none" id="user">
    <h3>用户管理</h3>
    <div class="table-responsive">
      <table class="table">
          <tr>
            <th>用户名</th>
            <th>注册邮箱</th>
            <th>状态</th>
            <th>修改密码</th>
            <th>禁言</th>
            <th>删除</th>
          </tr>
          @foreach ($users as $user)
          <tr id="{{$user->user_name}}">
            <td>{{$user->user_name}}</td>
            <td>{{$user->user_mail}}</td>
            <td>{{$user->status}}</td>
            <td><button type="button" class="button success update">修改</button></td>
            <td><button type="button" class="button success Close">禁言</button></td>
            <td><button type="button" class="button success del">删除</button></td>
          </tr>
          @endforeach
      </table>
    </div>
  </div>
  <div id="Admin" style="padding:20px;display: none">
    <h3>管理员管理</h3>
    <div class="table-responsive">
       <table class="table" id="admin_t">
        <tr>
          <th>用户名</th>
          <th>注册邮箱</th>
          <th>删除
            <button type="button" class="btn" onclick="newAdmin()">新建管理员</button>
          </th>
        </tr>
        @foreach ($roots as $root)
        <tr id="">
          <td>{{$root->root_name}} 高级管理员</td>
          <td>{{$root->root_email}}</td>
          <td><button type="button" class="button success">无法删除</button></td>
        </tr>
        @endforeach
        @foreach ($admins as $admin)
        <tr id="{{$admin->admin_name}}">
          <td>{{$admin->admin_name}}</td>
          <td>{{$admin->admin_email}}</td>
          <td><button type="button" class="button success" onclick="delAdmin(this)">删除权限</button></td>
        </tr>
        @endforeach
       </table> 
    </div>
  </div>
  <div id="article" style="padding:20px;display: none">
    <h3>帖子管理</h3>
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>标题</th>
          <th>作者</th>
          <th>时间</th>
          <th>置顶</th>
          <th>加精</th>
          <th>删除</th>
        </tr>
        @foreach ($articles as $article)
        <tr id="{{$article->id}}">
          <td>{{$article->title}}</td>
          <td>{{$article->auth}}</td>
          <td>{{$article->time}}</td>
          @if ($article->top==1)
            <td>置顶中
              <button type="button" class="btn btn-info" onclick="cancelTop(this)">取消置顶</button>
            </td>         
          @else
            <td>正常
              <button type="button" class="btn btn-success" onclick="toTop(this)">置顶</button>
            </td>
          @endif
          @if ($article->good==1)
            <td>精品
              <button type="button" class="btn btn-success" onclick="cancelGood(this)">取消精品</button>
            </td>         
          @else
            <td>正常
              <button type="button" class="btn btn-warning" onclick="toGood(this)">加为精品</button>
            </td>
          @endif
          <td><button type="button" class="btn btn-danger" onclick="delart(this)">删除</button></td>
        </tr>
        @endforeach

      </table>
    </div>
  </div>

  <div id="message" style="padding:20px;display: none">
    <h3>站内信</h3>
      <form>
        <div class="form-group">
          <label for="exampleInputEmail1">收件人</label>
          <input type="text" id="rePerson" class="form-control" id="exampleInputEmail1" placeholder="请输入接收人，多个收件人以;隔开" style="width:300px">
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" id="all" value="" checked="true">
            所有用户
          </label>
        </div>
      </form>
      <label for="exampleInputEmail1">内容</label>
      <textarea class="form-control" rows="3" style="width: 400px;height:300px;"></textarea>
      <button type='button' class="btn btn-success" onclick="messagePost()">
      点击发送</button>
  </div>

  <div id="repot" style="padding:20px;display: none">
    <h3>回复管理</h3>
      <div class="table-responsive">
      <table class="table">
        <tr>
          <th>作者</th>
          <th>内容</th>
          <th>时间</th>
          <th>删除</th>
        </tr>
        @foreach ($talks as $talk)
        <tr id="{{$talk->id}}">
          <td>{{$talk->user_name}}</td>
          <td>{{$talk->text}}</td>
          <td>{{$talk->time}}</td>
          <td><button type="button" class="btn btn-danger" onclick="delre(this)">删除</button></td>
        </tr>
        @endforeach

      </table>
    </div>
  </div>
</div>

<script type="text/javascript">




function messagePost(){
   let status = document.getElementById("all").checked;
   if (status){
      if(!$("textarea").val() ){
         alert("内容为空");
         return
      };
      let obj = {
          user:"all",
          text:$("textarea").val()
      }
      $.post("/messagePost",obj,function(d){

      })
   } else if ( !$("#rePerson").val() ){
      return 
   } else {
      if(!$("textarea").val() ){
         alert("内容为空");
         return
      };
      let obj = {
          user:$("#rePerson").val(),
          text:$("textarea").val()
      }
      $.post("/messagePost",obj,function(d){

      })
   }
}


function newAdmin(){
  var str1=prompt("输入账号");
  if (str1) {
    var str2=prompt("输入昵称");
    if(str2){
      var str3=prompt("输入密码");
      if(!str3){
        return
      }
    }else{
      return
    }
  }else{
    return
  }
  var obj = {
      s:str1,
      m:str2,
      p:str3
  }
  $.post("/newAdmin",obj,function(d){
      if(d==1){
        $("#admin_t").append("<tr id='str2'><td>"+str2+"</td><td>"+str1+"</td><td><button type='button' class='button success' onclick='delAdmin(this)'>删除权限</button></td></tr>");
      }else{
        alert("管理员权限不足");
      }
  }) 
}


function delAdmin(o){
    let that = $(o);
    let obj = $(o).parent().parent()
    let id = obj.attr("id");
    $.get("/delAdmin?id="+id,function(d){
      if (d == 1){
         obj.remove();
      } else{
         alert("管理员权限不足");
      }
    })
}


function delart(o){
    let that = $(o);
    let obj = $(o).parent().parent()
    let id = obj.attr("id");
    $.get("/delart?id="+id,function(d){
      if (d == 1){
         obj.remove();
      } else{
         alert("删除失败");
      }
    })
}
function delre(o){
    let that = $(o);
    let obj = $(o).parent().parent()
    let id = obj.attr("id");
    $.get("/delre?id="+id,function(d){
      if (d == 1){
         obj.remove();
      } else{
         alert("删除失败");
      }
    })
}
function cancelTop(o){
    let that = $(o);
    let obj = $(o).parent().parent()
    let id = obj.attr("id");
    $.get("/cancelTop?id="+id,function(d){
      if (d == 1){
         that.parent().html("正常<button type='button' class='btn btn-success' onclick='toTop(this)'>置顶</button>");
      } else{
         alert("取消失败");
      }
    })
}

function toTop(o){
    let that = $(o);
    let obj = $(o).parent().parent()
    let id = obj.attr("id");
    $.get("/toTop?id="+id,function(d){
      if (d == 1){
         that.parent().html("置顶中<button type='button' class='btn btn-info' onclick='cancelTop(this)'>取消置顶</button>");
      } else{
         alert("置顶失败");
      }
    })
}

function toGood(o){
    let that = $(o);
    let obj = $(o).parent().parent()
    let id = obj.attr("id");
    $.get("/toGood?id="+id,function(d){
      if (d == 1){
         that.parent().html("精品<button type='button' class='btn btn-success' onclick='cancelGood(this)'>取消加精</button>");
      } else{
         alert("加精失败");
      }
    })
}

function cancelGood(o){
    let that = $(o);
    let obj = $(o).parent().parent()
    let id = obj.attr("id");
    $.get("/cancelGood?id="+id,function(d){
      if (d == 1){
         that.parent().html("正常<button type='button' class='btn btn-warning' onclick='toGood(this)'>精品</button>");
      } else{
         alert("加精失败");
      }
    })
}

function toRepot(){

  $("#repot").show()
  $("#article").hide(); 
  $("#Admin").hide();
  $("#index").hide();
  $("#user").hide();
  $("#message").hide();

}


function toMessage(){
  $("#article").hide(); 
  $("#Admin").hide();
  $("#index").hide();
  $("#user").hide();
  $("#message").show();
  $("#repot").hide()

}

function toAriticle(){
  $("#article").show(); 
  $("#Admin").hide();
  $("#index").hide();
  $("#user").hide();
  $("#message").hide();
  $("#repot").hide()


}

function toUser(){
  $("#Admin").hide();
  $("#index").hide();
  $("#user").show();
  $("#article").hide();
  $("#message").hide();
  $("#repot").hide()

}

function toAdmin(){
  $("#Admin").show();
  $("#index").hide();
  $("#user").hide();
  $("#article").hide();
  $("#message").hide();
  $("#repot").hide()

}





$(".Close").click(function(){
    var returned = window.confirm("你确认禁言该用户？");
    if (returned){
        var name = $(this).parent().parent().attr("id");
        var o = $(this);
        $.get("/close?name="+name,function(d){
             if(d == 1){
                o.parent().prev().prev().html("禁言中");
                 alert("禁言成功");
              }else{
                 alert("禁言失败");
              }
        })
    }
})

$(".del").click(function(){
    var returned = window.confirm("你确认删除该用户？");
    if (returned) {
          var name = $(this).parent().parent().attr("id");
          var o = $(this).parent().parent();
          $.get("/del?name="+name,function(d){
              if(d == 1){
                  o.remove();
              }else{
                 alert("删除失败");
              }
         })
    }
})

$(".update").click(function(){
     var str=prompt("输入密码");
     var name = $(this).parent().parent().attr("id");
     if (str.length <6) { 
          alert("长度不够");      
     }else{
          $.get("/changePwd?pwd="+str+"&name="+name,function(d){
              if(d == 1){
                  alert("更改成功");
              }else{
                 alert("删除失败");
              }
          })
     }
})




$(function(){
/*换肤*/
$(".dropdown .changecolor li").click(function(){
	var style = $(this).attr("id");
    $("link[title!='']").attr("disabled","disabled"); 
	$("link[title='"+style+"']").removeAttr("disabled"); 

	$.cookie('mystyle', style, { expires: 7 }); // 存储一个带7天期限的 cookie 
})
var cookie_style = $.cookie("mystyle"); 
if(cookie_style!=null){ 
    $("link[title!='']").attr("disabled","disabled"); 
	$("link[title='"+cookie_style+"']").removeAttr("disabled"); 
} 
/*左侧导航栏显示隐藏功能*/
$(".subNav").click(function(){				
			/*显示*/
			if($(this).find("span:first-child").attr('class')=="title-icon glyphicon glyphicon-chevron-down")
			{
				$(this).find("span:first-child").removeClass("glyphicon-chevron-down");
			    $(this).find("span:first-child").addClass("glyphicon-chevron-up");
			    $(this).removeClass("sublist-down");
				$(this).addClass("sublist-up");
			}
			/*隐藏*/
			else
			{
				$(this).find("span:first-child").removeClass("glyphicon-chevron-up");
				$(this).find("span:first-child").addClass("glyphicon-chevron-down");
				$(this).removeClass("sublist-up");
				$(this).addClass("sublist-down");
			}	
		// 修改数字控制速度， slideUp(500)控制卷起速度
	    $(this).next(".navContent").slideToggle(300).siblings(".navContent").slideUp(300);
	})
/*左侧导航栏缩进功能*/
$(".left-main .sidebar-fold").click(function(){

	if($(this).parent().attr('class')=="left-main left-full")
	{
		$(this).parent().removeClass("left-full");
		$(this).parent().addClass("left-off");
		
		$(this).parent().parent().find(".right-product").removeClass("right-full");
		$(this).parent().parent().find(".right-product").addClass("right-off");
		
		}
	else
	{
		$(this).parent().removeClass("left-off");
		$(this).parent().addClass("left-full");
		
		$(this).parent().parent().find(".right-product").removeClass("right-off");
		$(this).parent().parent().find(".right-product").addClass("right-full");
		
		}
	})	
 
  /*左侧鼠标移入提示功能*/
		$(".sBox ul li").mouseenter(function(){
			if($(this).find("span:last-child").css("display")=="none")
			{$(this).find("div").show();}
			}).mouseleave(function(){$(this).find("div").hide();})	
})



var myDate = new Date();
var day = myDate.getDay();
var d="星期";
  switch(day){
                        case 0:d+="日";break;
                        case 1:d+="一";break;
                        case 2:d+="二";break;
                        case 3:d+="三";break;
                        case 4:d+="四";break;
                        case 5:d+="五";break;
                        case 6:d+="六";break;
                      }
                      $("#date_e").html("<span>"+myDate.getFullYear()+'</span>年'+(myDate.getMonth()+1)+"月"+myDate.getDate()+"日");
                      $("#date_d").html(d);
                      $("#date_t").html(myDate.getHours()+":"+myDate.getMinutes())
                      setInterval(function(){
                        $("#date_t").html(myDate.getHours()+":"+myDate.getMinutes())
                      },60000);

</script>
</body>
</html>