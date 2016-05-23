<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>LanceLot-修改我的资料</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/LanceLot/Public/front/css/public.css" rel="stylesheet" type="text/css"/>
		<link href="/LanceLot/Public/front/css/bo.css" rel="stylesheet" type="text/css"/>
		<link href="/LanceLot/Public/time/my.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="/LanceLot/Public/front/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/LanceLot/Public/front/js/move.js"></script>
		<script type="text/javascript" src="/LanceLot/Public/time/my.js"></script>
		
		<script type="text/javascript">
			var info={ required:"&nbsp;&nbsp;<img src='/LanceLot/Public/front/images/req1.png'/>&nbsp;&nbsp;让更多的朋友了解你！",email:"&nbsp;&nbsp;<img src='/LanceLot/Public/front/images/req1.png'/>&nbsp;&nbsp;请输入正确email地址!",age:"&nbsp;&nbsp;<img src='/LanceLot/Public/front/images/req1.png'/>&nbsp;&nbsp;请输入正确的年龄哈!"};
			
			$(function(){
				//获取所有input输入框，并添加获取和失去焦点事件
				$("#name,#email,#age").focus(function(){
					//获取焦点事件处理
					$(this).next("span").remove();
					var cname=$(this).attr("classname");
					$(this).after("<span style='color:blue;font-size:12px;'>"+info[cname]+"</span>")		
				}).blur(function(){
					//失去焦点事件处理
					$(this).next("span").remove();
					//做验证
					var cname=$(this).attr("classname");
					switch(cname){
						case "required":
							if($(this).val()==null){
								$(this).after("<span style='color:red;font-size:12px;'>&nbsp;&nbsp;<img src='/LanceLot/Public/front/images/req3.png'/>&nbsp;&nbsp;姓名是必要的！</span>");
							}else{
								$("#name").after("<span>&nbsp;&nbsp;<img src='/LanceLot/Public/front/images/req2.png'/>&nbsp;&nbsp;会有更多的人认识你</span>");
							}
							break;
						case "email":
							if($(this).val().match(/^\w+@\w+(\.\w+)<?php echo (C("TMPL_L_DELIM")); ?>0,3<?php echo (C("TMPL_R_DELIM")); ?>$/)==null){
								$(this).after("<span style='color:red;font-size:12px;'>&nbsp;&nbsp;<img src='/LanceLot/Public/front/images/req3.png'/>&nbsp;&nbsp;邮箱地址错误！</span>");
							}else{
								$(this).after("<span>&nbsp;&nbsp;<img src='/LanceLot/Public/front/images/req2.png'/></span>");
							}
							break;
					}
					
				});
			});
				
			function doCheck(myform){
				//判断数据添加是否正确
				if($("#email").val().match(/^\w+@\w+(\.\w+)<?php echo (C("TMPL_L_DELIM")); ?>0,3<?php echo (C("TMPL_R_DELIM")); ?>$/)==null){
					alert("输入正确邮箱地址！");
					return false;
				}
					
				if($("#name").val()==null){
					alert("添加真实的姓名，交往真正的朋友");
					return false;
				}
			}
			
		</script>
	</head>
	<body>
		<!-- 页头开始 -->
		<script type="text/javascript">
		//左侧公共个人中心特效
		$(function(){
			$(window).scroll(function(){
				//获取个人中心的top位置
				var ptop=$("#person_menu").css("top");
				//改变头的位置和透明度
				$("#header .h_top").css({ position:"relative",top:$(window).scrollTop()+"px"});
				if($(window).scrollTop()>1){
					$("#header .h_top").css({ opacity:"0.7",filter:"Alpha(opacity=70)"});
				}else{
					$("#header .h_top").css({ opacity:"1",filter:"Alpha(opacity=100)"});
				}
				
				//动态改变个人中心的位置
				if($(window).scrollTop()>100){
					$("#person_menu").css({ top:$(window).scrollTop()+60+"px"});
				}else{
					$("#person_menu").css({ top:ptop});
				}
			})	
		});

	</script>
	
	<script type="text/javascript" src="/LanceLot/Public/front/js/totop.js"></script>
	<script type="text/javascript" src="/LanceLot/Public/front/js/thickbox_plus.js"></script>
	<link rel="stylesheet" type="text/css" href="/LanceLot/Public/front/css/thickbox.css"/>
	
	<!-- head页头部分开始 -->
		<div id="header">
			<div class="h_top">
				<div class="con">
					<ul class="left">
						<li><a href="/LanceLot/index.php/Index/index" class="title">LanceLot 电影之家</a></li>
					</ul>
					<ul class="right">
					 	<?php if(empty($_SESSION['loginuser'])): ?><li class="disuser"><a href="/LanceLot/index.php/Login/ShowLogin.html?height=245;width=600" class="thickbox"  title="登录">登录</a></li>
						<li><a href="/LanceLot/index.php/Reqister/reqister">注册</a></li>
						<?php else: ?>
					
						<li class="disuser"><a href="/LanceLot/index.php/User/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>"  style="color:#fff;"><?php echo ($_SESSION['loginuser']['username']); ?></a></li>
						<li><a href="/LanceLot/index.php/Login/loginout">退出</a></li><?php endif; ?>
					</ul>
				</div>
			</div>
			<!-- 搜索 logo -->
			<div class="h_center">
				<div class="con">
					<div class="logo">
						<a href="/LanceLot/index.php/Index/index"><span>LanceLot</span></a>
						<!-- <img src="/LanceLot/Public/front/images/logo.jpg" alt="" /> -->
					</div>
					<!-- 搜索 -->
					<div class="search">
						<form action="" method="get">
							<input type="text" class="inp" placeholder="电影、预告片、分类"/>
							<input type="submit" class="sub" value=""/>
						</form>
					</div>
					<div class="logoimg">
						<img src="/LanceLot/Public/front/images/logo.jpg" alt="" />
					</div>
				</div> 
			</div>
			<!-- menu菜单 -->
			<div class="h_down">
				<div class="menu">
					<ul>
						<li><a href="/LanceLot/index.php/User/index/uid/<?php echo ($_GET['uid']); ?>">空间首页</a></li>
						<li><a href="/LanceLot/index.php/User/mylongreview/uid/<?php echo ($_GET['uid']); ?>">影评</a></li>
						<li><a href="/LanceLot/index.php/Pmood/index/uid/<?php echo ($_GET['uid']); ?>">心情轨迹</a></li>
						<li><a href="/LanceLot/index.php/Diary/diarylist/uid/<?php echo ($_GET['uid']); ?>">日志</a></li>
						<li><a href="/LanceLot/index.php/Uphotoalbum/index/uid/<?php echo ($_GET['uid']); ?>">相册</a></li>
						<li><a href="/LanceLot/index.php/Uhistory/index/uid/<?php echo ($_GET['uid']); ?>">影迹</a></li>
						<li><a href="/LanceLot/index.php/Umessage/index/uid/<?php echo ($_GET['uid']); ?>">留言</a></li>
						<li><a href="/LanceLot/index.php/User/myinfo/uid/<?php echo ($_GET['uid']); ?>">个人资料</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- header页头部分结束 -->
		
		<div class="nav"></div>
		
		<!-- 个人中心菜单开始 -->
		<script type="text/javascript">
		//个人中心滑动特效
		$(function(){
			$("#person_menu ul li").each(function(){
				if(this.className.indexOf("current_page")==-1){
					var color;
					$(this).css({ left:"-90px",opacity:"0.6"});
					$(this).hover(function(){
						$(this).animate({ left:"0px",opacity:"1"},"normal");
					},function(){
						$(this).animate({ left:"-90px",opacity:"0.6"},"normal");
					});
				}
			});
		
	
		});
		</script>

		<?php if(empty($_SESSION['loginuser'])): else: ?>
		<div id="person_menu">
			<ul>
				<li class="nav1"><a href="/LanceLot/index.php/Index/index">网站首页</a></li>
				<li class="nav2"><a title="个人中心" href="/LanceLot/index.php/User/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">个人中心</a></li>
				<li class="nav3"><a title="新鲜事" href="/LanceLot/index.php/Unews/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">新鲜事</a></li>
				<li class="nav4"><a title="关注" href="/LanceLot/index.php/Friend/attlist/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">关注</a></li>
				<li class="nav5"><a title="我的收藏" href="/LanceLot/index.php/Ustore/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">我的收藏</a></li>
				<li class="nav6"><a title="猜你喜欢" href="/LanceLot/index.php/Umytype/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">猜你喜欢</a></li>
				<li class="nav7"><a title="本月上映" href="/LanceLot/index.php/Time/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>" target="_blank">本月上映</a></li>
				<li class="nav8"><a title="我的公告" href="/LanceLot/index.php/User/noticelist/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">我的公告</a></li>
				<li class="nav9"><a title="站内信" href="/LanceLot/index.php/User/letterlist/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">站内通知</a></li>
				<li class="nav10"><a title="资料修改" href="/LanceLot/index.php/User/changemyinfo/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">资料修改</a></li>
			</ul>
		</div><?php endif; ?>
		
		<!-- 个人中心菜单结束 -->
		<!-- 页头结束 -->
		
		<!-- 主体部分开始	-->
		<div id="pmain">
		
			<!-- 左侧内容 -->
			<div id="pmain_left">

				<!-- 用户资料修改 -->
				<div class="prlist">
					<div class="prlist_title">&nbsp;资料修改页<span id="changemyinfolink"><a href="/LanceLot/index.php/User/changepass/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">修改我的密码</a></span></div>
					
					<div class="myinfo">
						<form action="/LanceLot/index.php/User/dochangeinfo" method="post" onsubmit="return doCheck(this);">
							<input type="hidden" name="id" value="<?php echo ($_SESSION['loginuser']['id']); ?>"
							<div class="item">
								<label class="labelinp" ><b><span class="myinfotag">用户ID:</span></b></label>
								<label class="labelinp" ><?php echo ($vo["id"]); ?></label>&nbsp;&nbsp;
							</div>
							
							<div class="item">
								<label class="labelinp" ><b><span class="myinfotag">用户账号:</span></b></label>
								<label class="labelinp"><?php echo ($vo["username"]); ?></label>&nbsp;&nbsp;
							</div>
							
							<div class="item">
								<label class="labelinp"><b><span class="myinfotag">用户姓名:</span></b></label>
								<input style="color:#222;" id="name" name="name" class="basic-input" maxlength="60" value="<?php echo ($vo["name"]); ?>" type="text" classname="required">&nbsp;&nbsp;
							</div>
							
							<div class="item">
								<label class="labelinp"><b/><span class="myinfotag">用户邮箱:</span></b></label>
								<input style="color:#222;"id="email" name="email" class="basic-input" maxlength="60" value="<?php echo ($vo["email"]); ?>" type="text" classname="email">&nbsp;&nbsp;
							</div>
							
							<div class="item">
								<label class="labelinp"><b><span class="myinfotag">用户性别:</span></b></label>
								<?php if($vo["sex"] == 1): ?><label class="labelinp"><input type="radio" name="sex" value="1" checked />男</label>
								<label class="labelinp"><input type="radio" name="sex" value="0" />女</label>
								<?php else: ?>
								<label class="labelinp"><input type="radio" name="sex" value="1" />男</label>
								<label class="labelinp"><input type="radio" name="sex" value="0" checked />女</label><?php endif; ?>
							</div>
							
							<div class="item">
								<label class="labelinp" for="birthday"><b><span class="myinfotag">出生日期:</span></b></label>
								<input style="color:#222;" id="birthday" name="birthday" class="basic-input" maxlength="60" value="<?php echo ($vo["birthday"]); ?>"  type="text" classname="birthday">&nbsp;&nbsp;
							</div>
							
							<div class="item">
								<label class="labelinp"><b><span class="myinfotag">用户地址:</span></b></label>
								<input style="color:#222;" id="address" name="address" class="basic-input2" value="<?php echo ($vo["address"]); ?>" type="text">&nbsp;&nbsp;
							</div>
							
							<div class="item">
								<label class="labelinp">&nbsp;</label>
								<input value="修改" id="user_login" name="user_login" class="btn-submit" type="submit" classname="sub">&nbsp;&nbsp;
								<input value="重置" id="user_login" name="user_login" class="btn-submit" type="reset" classname="sub">
							</div>
						</form>
					</div>
				</div>
				
			</div>
			
		</div>
		
		<!-- 主体部分结束	-->
		
		<div class="nav"></div>	
		
		<!-- 导入页脚部分 -->
		<!--页脚部分开始-->
    <div id="footer">
        <div class="foot_top">
            <div class="foot_link">
                <a href="" target="_blank">公司简介</a> |
                <a href="" target="_blank">合作伙伴</a> |
                <a href="" target="_blank">诚聘英才</a> |
                <a href="" target="_blank">广告服务</a> |
                <a href="/LanceLot/index.php/Map/map" target="_blank">网站地图</a> |
                <a href="" target="_blank">保护隐私</a> |
                <a href="" target="_blank">版权信息</a> |
                <a href="" target="_blank">客户服务</a> |
                <a href="" target="_blank">联系我们</a> |
                <a href="" target="_blank">电影之家</a>
            </div>
        </div>
        <div class="foot_content">
            Copyright&#169;1996-2014  LanceLot
        </div>
    </div>
<!--页脚部分结束-->
		
	</body>
</html>