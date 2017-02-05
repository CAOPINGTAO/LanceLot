<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>用户空间</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/LanceLot/Public/front/css/public.css" rel="stylesheet" type="text/css"/>
		<link href="/LanceLot/Public/front/css/bo.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="/LanceLot/Public/front/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/LanceLot/Public/front/js/move.js"></script>
		<script type="text/javascript">
			//定义发布心情函数
			function doreply(form){
				//获得表单添加数据
				var message = $("textarea").val();
	
				if(message.length<1){
					alert("至少说几个字");
					return false;
				}
				
				if(message.length>70){
					alert("不能超过70个字");
					return false;
				}
	
				//执行ajax
				$.ajax({
					url:"http://localhost:8080/LanceLot/index.php/Pmood/doinsert",
					type:"post",
					data:{ content:message},
					dataType:"text",
					success:function(res){
						if(res=="nologin"){
							alert("请先登录！");
							return false;
						}
						
						if(res=="true"){
							form.reset();
							$("#mytextcontent").html(message);
							$("#js_message_p").html("此时此刻，恰如彼时彼刻......");
							$("#js_message_textarea").html("");
						}else{
							alert("添加失败，稍后再试!");
						}
					}
				});
				return false;
			}
			
			//定义关注函数
			function doatt(bid){
				//执行Ajax
				$.ajax({
					url:"http://localhost:8080/LanceLot/index.php/Friend/doatt",
					type:"get",
					data:{ bid:bid},
					dataType:"text",
					success:function(res){
						if(res == "nologin"){
							alert("请先登录");
							return false;
						}else if(res == "self"){
							alert("无法添加自己");
							return false;
						}else if(res == "already"){
							alert("已添加过该好友");
						}else if(res == "true"){
							alert("添加成功");
							$("#gzbut").html("<a href='javascript:noatt(<?php echo ($vo["id"]); ?>)' >漠视他</a>");
						}else{
							alert("无法添加");
						}
					},
					error:function(){
						alert("无法添加");
					}
					
				});
			}
			
			//定义取消关注函数
			function noatt(bid){
				//执行Ajax
				if(confirm("真的要取消关注此好友么?")){
					$.ajax({
						url:"http://localhost:8080/LanceLot/index.php/Friend/noatt",
						type:"get",
						data:{ bid:bid},
						dataType:"text",
						success:function(res){
							if(res == "nologin"){
								alert("请先登录");
								return false;
							}else if(res == "true"){
								alert("取消关注成功");
								$("#gzbut").html("<a href='javascript:doatt(<?php echo ($vo["id"]); ?>)'>关注他</a>");
							}else{
								alert("还不是您的好友");
							}
						},
						error:function(){
							alert("还不是您的好友");
						}
					});
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
					 	<?php if(empty($_SESSION['loginuser'])): ?><li class="disuser"><a href="/LanceLot/index.php/Login/ShowLogin.html?height=245;width=600" class="thickbox" style="border-radius:0px 0px 0px 10px"  title="登录">登录</a></li>
						<li><a href="/LanceLot/index.php/Register/register" style="border-radius:0px 0px 10px 0px">注册</a></li>
						<?php else: ?>
					
						<li class="disuser"><a href="/LanceLot/index.php/User/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>"  style="color:#fff; border-radius:0px 0px 0px 10px"><?php echo ($_SESSION['loginuser']['username']); ?></a></li>
						<li><a href="/LanceLot/index.php/Login/loginout" style="border-radius:0px 0px 10px 0px">退出</a></li><?php endif; ?>
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
		
		<div class="nav"></div>
		
		<!-- 主体部分开始	-->
		<div id="pmain">
		
			<!-- 左侧内容 -->
			<div id="pmain_left">
				<!-- 左侧心情签名 -->
				<div id="psign">
					<div id="psmallimg">
						<img src="/LanceLot/Uploads/User/Headpic/<?php echo ($vo["headpic"]); ?>" />
					</div>
					<div id="ptext">
						<div id="mytext">
							<span id="mytexttitle">个性签名：</span>
							<?php if(!empty($vo['pmood'][0]['content'])): ?><span id="mytextcontent"><?php echo ($vo["pmood"]["0"]["content"]); ?><span>
							<?php else: ?>
								<span id="mytextcontent" style="color:#ccc;">快来记录自己的第一条心情<span><?php endif; ?>
						</div>
						<?php if(($_GET['uid']) == $_SESSION['loginuser']['id']): ?><form onsubmit="return doreply(this)">
							<p id="js_message_p">此时此刻，恰如彼时彼刻......</p>
								<div id="psignarea">
									<textarea rows=3 cols=68 id="js_message_textarea"></textarea>
								</div>
								<div id="psignbut">
									<input type="submit" class="btn-submit" value="发布心情"></button>
								</div>
							</form><?php endif; ?>
					</div>
				</div>
				<!-- 左侧当前用户最新影评 -->
				<div class="plist">
					<div class="plist_title">最新影评</div>
					<div class="review_list">
						<?php if(empty($vo['longreview'][0]['filmname'])): ?><div class="nothing">快去添加自己的第一条影评吧...</div>
						<?php else: ?>
							<div class="rl">
								<a href="/LanceLot/index.php/Review/index/id/<?php echo ($vo["longreview"]["0"]["id"]); ?>" target="_blank">
									<img src="/LanceLot/Uploads/Movie/Cover/b_<?php echo ($vo["longreview"]["0"]["picname"]); ?>" />
								</a>
							</div>
							<div class="rr">
								<div class="title">
									<a href="/LanceLot/index.php/Review/index/id/<?php echo ($vo["longreview"]["0"]["id"]); ?>" target="_blank">
										<?php echo ($vo["longreview"]["0"]["title"]); ?>
									</a>
									<span class="titletime"><?php echo (date("Y-m-d H:i:s",$vo["longreview"]["0"]["ptime"])); ?></span>
								</div>
								<div class="acthor">
									 <?php echo ($vo["username"]); ?> 评论: <a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["longreview"]["0"]["fid"]); ?>" target="_blank"><?php echo ($vo["longreview"]["0"]["filmname"]); ?> </a>
								</div>
								<div class="content">
									<?php if($vo['longreview'][0]['content'] != '......'): echo ($vo["longreview"]["0"]["content"]); ?>
									<?php else: ?>
										暂无影评<?php endif; ?>
								</div>
							</div><?php endif; ?>
					</div>
				</div>
				
				<!-- 左侧当前用户最新短评 -->
				<div class="plist">
					<div class="plist_title">最新短评</div>
					<div class="review_list">
					<?php if(empty($vo['shortreview'][0]['picname'])): ?><div class="nothing">快去添加自己的第一条短评吧...</div>
					<?php else: ?>
						<div class="rl">
							<a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["shortreview"]["0"]["fid"]); ?>" target="_blank">
								<img src="/LanceLot/Uploads/Movie/Cover/b_<?php echo ($vo["shortreview"]["0"]["picname"]); ?>" />
							</a>
						</div>
						<div class="rr">
							<div class="title">
								<a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["shortreview"]["0"]["fid"]); ?>" target="_blank">
									最新的短评
								</a>
								<span class="titletime"><?php echo (date("Y-m-d H:i:s",$vo["shortreview"]["0"]["rtime"])); ?></span>
							</div>
							<div class="acthor">
								 <?php echo ($vo["username"]); ?> 评论: <a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["shortreview"]["0"]["fid"]); ?>" target="_blank"><?php echo ($vo["shortreview"]["0"]["filmname"]); ?> </a>
							</div>
							<div class="content">
								<?php if(!empty($vo['shortreview'][0]['content'])): echo ($vo["shortreview"]["0"]["content"]); ?>
								<?php else: ?>
									暂无短评<?php endif; ?>
							</div>
						</div><?php endif; ?>
					</div>
				</div>
				
				<!-- 左侧当前用户最新回复 -->
				<div class="plist">
					<div class="plist_title">最新回复</div>
					<div class="review_list">
					<?php if(empty($vo['reviewreply'][0]['picname'])): ?><div class="nothing">快去添加自己的第一条回复吧...</div>
					<?php else: ?>
						<div class="rl">
							<a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["reviewreply"]["0"]["fid"]); ?>" target="_blank">
								<img src="/LanceLot/Uploads/Movie/Cover/b_<?php echo ($vo["reviewreply"]["0"]["picname"]); ?>" />
							</a>
						</div>
						<div class="rr">
							<div class="title">
								<a href="/LanceLot/index.php/Review/index/id/<?php echo ($vo["reviewreply"]["0"]["rid"]); ?>">
								最新的影评回复
								</a>
								<span class="titletime"><?php echo (date("Y-m-d H:i:s",$vo["reviewreply"]["0"]["rtime"])); ?></span>
							</div>
							<div class="acthor">
								 <?php echo ($vo["username"]); ?> 评论:  <a href="/LanceLot/index.php/Review/index/id/<?php echo ($vo["reviewreply"]["0"]["rid"]); ?>" target="_blank"><?php echo ($vo["reviewreply"]["0"]["retitle"]); ?> </a>
							</div>
							<div class="content">
								<?php if($vo['reviewreply'][0]['content'] != '......'): echo ($vo["reviewreply"]["0"]["content"]); ?>
								<?php else: ?>
									暂无回复<?php endif; ?>
							</div>
						</div><?php endif; ?>
					</div>
				</div>
				
				<!-- 左侧当前用户最新日记 -->
				<div class="plist">
					<div class="plist_title">最新日记</div>
					<div class="review_list">
					<?php if($vo['diary'][0]['content'] == '......'): ?><div class="nothing">快去添加自己的第一篇日志吧...</div>
					<?php else: ?>
						<div class="rl">
							<a href="/LanceLot/index.php/Diary/mydiary/uid/<?php echo ($_GET['uid']); ?>/id/<?php echo ($vo["diary"]["0"]["id"]); ?>" target="_blank">
								<img src="/LanceLot/Public/front/images/diary.jpg" />
							</a>
						</div>
					
						<div class="rr">
							<div class="title">
								<a href="/LanceLot/index.php/Diary/mydiary/uid/<?php echo ($_GET['uid']); ?>/id/<?php echo ($vo["diary"]["0"]["id"]); ?>">
								<?php echo ($vo["diary"]["0"]["title"]); ?>
								</a>
								<span class="titletime"><?php echo (date("Y-m-d H:i:s",$vo["diary"]["0"]["addtime"])); ?></span>
							</div>
							<div class="acthor">

							</div>
							<div class="content">
								<?php if($vo['diary'][0]['content'] != '......'): echo ($vo["diary"]["0"]["content"]); ?>
								<?php else: ?>
									暂无日志<?php endif; ?>
							</div>
						</div><?php endif; ?>
					</div>
				</div>
				
				<!-- 左侧当前用户最新留言 -->
				<div class="plist">
					<div class="plist_title">最新留言</div>
					<div class="review_list">
					<?php if($vo['message'][0]['content'] == '......'): ?><div class="nothing">快去添加自己的第一条留言吧...</div>
					<?php else: ?>
						<div class="rl">
							<a href="/LanceLot/index.php/Diary/mydiary/uid/<?php echo ($_GET['uid']); ?>/id/<?php echo ($vo["diary"]["0"]["id"]); ?>" target="_blank">
								<img src="/LanceLot/Public/front/images/message.jpg" />
							</a>
						</div>
					
						<div class="rr">
							<div class="title">
								<a href="/LanceLot/index.php/Umessage/index/uid/<?php echo ($_GET['uid']); ?>/">
									最新留言
								</a> 
								<span class="titletime"><?php echo (date("Y-m-d H:i:s",$vo["diary"]["0"]["addtime"])); ?></span>
							</div>
							<div class="acthor">
								 <?php echo ($vo["message"]["0"]["username"]); ?> 留言:
							</div>
							<div class="content">
								<?php if($vo['message'][0]['content'] != '......'): echo ($vo["message"]["0"]["content"]); ?>
								<?php else: ?>
									暂无留言<?php endif; ?>
							</div>
						</div><?php endif; ?>
					</div>
				</div>
				
				<!-- 左侧当前用户的好友 -->
				<div class="plist">
					<div class="plist_title">我的好友</div>
					<div>
						<div class="plist_content_pic">
							<?php if(is_array($myfriendlist)): foreach($myfriendlist as $key=>$myfriend): if(($myfriend["id"]) != $_GET['uid']): ?><a href="/LanceLot/index.php/User/index/uid/<?php echo ($myfriend["id"]); ?>">
										<img src="/LanceLot/Uploads/User/Headpic/<?php echo ($myfriend["headpic"]); ?>" alt="<?php echo ($myfriend["username"]); ?>" />
									</a><?php endif; endforeach; endif; ?>
						</div>
					</div>
				</div>
				
				<!-- 左侧当前用户的相册 -->
				<div class="plist">
					<div class="plist_title">我的相册</div>
					<div>
						<div class="plist_content_pic">
							<?php if(is_array($photolist)): foreach($photolist as $key=>$vp): ?><a href="/LanceLot/index.php/Uphotoalbum/albumdetail/uid/<?php echo ($_GET['uid']); ?>/pid/<?php echo ($vp["id"]); ?>">
									<img src="/LanceLot/Uploads/Photoalbum/Small/<?php echo ($vp["coverpic"]); ?>" width="120" height="120"/>
								</a><?php endforeach; endif; ?>
						</div>
					</div>
				</div>
				
				
			</div>
			
			<!-- 右侧内容 -->
			<div id="pmain_right">
				<div class="pinfoboxtop">
					<p class="prighttitle"><?php echo ($vo["username"]); ?></p>
					
					<div id="rpic">
						<div id="psmallimg">
							<img src="/LanceLot/Uploads/User/Headpic/<?php echo ($vo["headpic"]); ?>" />
						</div>
					</div>
					
					<ul class="prightcc">
						<li>
							<em><?php echo ($vo["iattnum"]); ?></em>
							关注
						</li>
						<li>
							<em><?php echo ($vo["attmenum"]); ?></em>
							粉丝
						</li>
						<li>
							<em><?php echo ($vo["hufennum"]); ?></em>
							互粉
						</li>
					</ul>
					
					<div class="nav"></div>
					<p>积分：<?php echo ($vo["score"]); ?></p>
					<p>等级：<?php echo ($vo["levelname"]); ?></p>
				</div>
				
				<?php if(($_GET['uid']) != $_SESSION['loginuser']['id']): ?><div class="ucaozuo">
						<p class="caozuotitle">操作</p>
						
						<ul>
							<li id="gzbut">
								<?php if($vo['attstatus'] != 'true'): ?><a href="javascript:doatt(<?php echo ($vo["id"]); ?>)">关注他</a>
								<?php else: ?>
									<a href="javascript:noatt(<?php echo ($vo["id"]); ?>)" >漠视他</a><?php endif; ?>
							</li>
						</ul>
					</div><?php endif; ?>
				
				<div class="pinfobox">
					<p class="prighttitle">个人标签(<?php echo ($vo["mytypenum"]); ?>)</p>
					
					<ul>
						<?php if(is_array($mytypes)): $i = 0; $__LIST__ = array_slice($mytypes,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="mytag"><a href="/LanceLot/index.php/Typelist/tags/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["typename"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				
				<div class="pinfobox">
					<p class="prighttitle">最近访客</p>
					
					<ul>
						<?php if(is_array($vlist)): foreach($vlist as $key=>$visitor): ?><li class="mytag"><a href="/LanceLot/index.php/User/index/uid/<?php echo ($visitor["id"]); ?>" title="<?php echo (date('Y-m-d H:i:s',$visitor["vtime"])); ?>"><?php echo ($visitor["visitorname"]); ?></a></li><?php endforeach; endif; ?>
					</ul>
				</div>
				
				<div class="pinfobox">
					<p class="prighttitle">好友生日</p>
					
					<ul>
						<?php if(is_array($birthdaylist)): foreach($birthdaylist as $key=>$birday): ?><li class="mytag"><a href="/LanceLot/index.php/User/index/uid/<?php echo ($birday["id"]); ?>" title="<?php echo (date('Y-m-d H:i:s',$birday["birthday"])); ?>"><?php echo ($birday["username"]); ?></a></li><?php endforeach; endif; ?>	
					</ul>
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

		
		<script type="text/javascript">
			//发布框js
			var oP = document.getElementById("js_message_p");
			var oT = document.getElementById("js_message_textarea");
				
			var ie = !-[1,];
			var bBtn = true;
			var timer = null;
			var iNum = 0;
			//获取焦点事件
			oT.onfocus = function(){
				if(bBtn){
					oP.innerHTML = "用文字定格时间...... <a>还可以输入</a><span id='textnum'>70</span>字";
				}
				
			};
			//失去焦点事件
			oT.onblur = function(){
				
				if(oT.value==''){
					oP.innerHTML = '这里需要你的痕迹......';
				}
			};
			//进行ie兼容性判断
			if(ie){
				oT.onpropertychange = toChange;
			}else{
				oT.oninput = toChange;
			}
			//单个字符改变事件
			function toChange(){
				var num = Math.ceil(getLength(oT.value)/2);
				var oSpan = document.getElementById("textnum");
				var opa=oP.getElementsByTagName("a")[0];
				
				if(!oSpan){ return}
				
				if(num<=70){
					opa.innerHTML="还可以输入";
					oSpan.innerHTML = 70 - num;
					oSpan.style.color = '#d20000';
				}else{
					opa.innerHTML="已超出";
					oSpan.innerHTML = num-70;
					oSpan.style.color = 'red';
				}
				
			}
			//获取字符的长度转换汉字进制数
			function getLength(str){
				return String(str).replace(/[^\x00-\xff]/g,'aa').length;
			}
		</script>
		
	</body>
</html>