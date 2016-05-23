<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>LanceLot - 用户资料</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/LanceLot/Public/front/css/public.css" rel="stylesheet" type="text/css"/>
		<link href="/LanceLot/Public/front/css/bo.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="/LanceLot/Public/front/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/LanceLot/Public/front/js/move.js"></script>
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

				<!-- 左侧当前用户影评 -->
				<div class="prlist">
					<div class="prlist_title">&nbsp;<?php echo ($vo["username"]); ?>的资料
					<?php if(($vo["id"]) == $_SESSION['loginuser']['id']): ?><span id="changemyinfolink">
							<a href="/LanceLot/index.php/User/changemyinfo/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">修改我的资料或密码</a>
						</span><?php endif; ?>
					</div>
					
					<div class="myinfo">
						<table width="600" border="0" cellspacing="10">
							<tr>
								<th><span class="myinfotag">头像:</span></th>
								<td>
									<img src="/LanceLot/Uploads/User/Headpic/<?php echo ($vo["headpic"]); ?>"/>
								</td>
								<?php if($vo["id"] == $Think.session.loginuser.id): ?><td><span id="changepiclink"><a href="/LanceLot/index.php/User/changepic/uid/<?php echo ($_SESSION['loginuser']['id']); ?>">修改头像点这里</a></span></td><?php endif; ?>
							<tr>
							<tr>
								<th><span class="myinfotag">用户ID:</span></th>
								<td><?php echo ($vo["id"]); ?></td>
								<th><span class="myinfotag">用户账号:</span></th>
								<td><?php echo ($vo["username"]); ?></td>
							</tr>
							
							<tr>
								<th><span class="myinfotag">用户积分:</span></th>
								<td><?php echo ($vo["score"]); ?></td>
								<th><span class="myinfotag">用户级别:</span></th>
								<td><?php echo ($vo["level"]); ?></td>
							</tr>
							
							<tr>
								<th><span class="myinfotag">用户姓名:</span></th>
								<td><?php echo ($vo["name"]); ?></td>
								<th><span class="myinfotag">用户Email:</span></th>
								<td><?php echo ($vo["email"]); ?></td>
							</tr>
							
							<tr>
								<th><span class="myinfotag">用户性别:</span></th>
								<td><?php if($vo["sex"] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
								<th><span class="myinfotag">用户生日:</span></th>
								<td><?php echo ($vo["birthday"]); ?></td>
							</tr>
							
							<tr>
								<th><span class="myinfotag">注册时间:</span></th>
								<td><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td>
								<th><span class="myinfotag">最后一次登陆:</span></th>
								<td><?php echo (date("Y-m-d H:i:s",$vo["lastlog"])); ?></td>
							</tr>
								
							<tr>
								<th><span class="myinfotag">用户地址:</span></th>
								<td colspan="3"><?php echo ($vo["address"]); ?></td>
							</tr>

							<tr>
								<th><span class="myinfotag">登陆次数:</span></th>
								<td colspan="3"><?php echo ($vo["logtimes"]); ?></td>
							</tr>
						</table>
						
						<div class="recom_list">
							<div class="title">
								<a>喜欢的电影类型</a>
								<?php if(($_GET['uid']) == $_SESSION['loginuser']['id']): ?><span id="changmytype"><a href="/LanceLot/index.php/Umytype/mytype/uid/<?php echo ($_GET['uid']); ?>">修改喜欢的电影类型</a></span><?php endif; ?>
							</div>
							<div>
								<?php if(is_array($vo['mytypes'])): foreach($vo['mytypes'] as $key=>$filmtype): ?><span class="filmtype">
										<a href="/LanceLot/index.php/Typelist/tags/id/<?php echo ($filmtype["id"]); ?>"><?php echo ($filmtype["typename"]); ?></a>
									</span><?php endforeach; endif; ?>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
		
		<!-- 主体部分结束	-->
		
		<div class="nav"></div>
		
		<!-- 导入页脚部分 -->
		    <div id="footer">
        <div class="foot_top">
            <div class="foot_link">
                <a href="" target="_blank">网站地图</a> |
                <a href="" target="_blank">版权信息</a> |
                <a href="" target="_blank">联系我们</a> |
                <a href="" target="_blank">电影之家</a>
            </div>
        </div>
    </div>

		<!-- 页脚不封结束 -->
		
		
	</body>
</html>