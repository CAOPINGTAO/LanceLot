<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>LanceLot</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/LanceLot/Public/front/css/style.css" rel="stylesheet" type="text/css"/>
		<link href="/LanceLot/Public/front/css/public.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="/LanceLot/Public/front/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/LanceLot/Public/front/js/move.js"></script>
	</head>
	<body>
		<!-- 个人中心菜单结束 -->
		
		<script type="text/javascript">
	//左侧通用导航栏
	$(function(){
		$(window).scroll(function(){
			//获取个人中心的top位置
			var ptop = $("#person_menu").css("top");
			//改变头的位置和透明度
			$("#header .h_top").css({ position:"relative", top:$(window).scrollTop()+"px"});
			if($(window).scrollTop()>1){
				$("#header .h_top").css({ opacity:"0.7", filter:"Alpha(opacity=70)"});
			} else {
				$("#header .h_top").css({ opacity:"1", filter:"Alpha(opacity=100)"});
			}

			//动态改变个人中心的位置
			if($(window).scrollTop()>100){
				$("#person_menu").css({ top:$(window).scrollTop()+60+"px"});
			} else {
                $("#person_menu").css({ top:ptop});
			}
		})
	});
</script>
<script type="text/javascript" src="/LanceLot/Public/front/js/totop.js"></script>
<script type="text/javascript" src="/LanceLot/Public/front/js/thickbox_plus.js"></script>
<link rel="stylesheet" type="text/css" href="/LanceLot/Public/front/css/thickbox.css"/>
<!-- head页头部分开始-->
<div id="header">
    <div class="h_top">
        <div class="con">
            <ul class="left">
                <li><a href="/LanceLot/index.php/Index/index" class="title"></a></li>
            </ul>
            <ul class="right">
                <?php if(empty($_SESSION['loginuser'])): ?><li class="disuser"><a href="/LanceLot/index.php/Login/ShowLogin.html?height=245;width=600" style="border-radius:0px 0px 0px 10px" class="thickbox"  title="登录">登录</a></li>
                <li><a href="/LanceLot/index.php/Register/register" style="border-radius:0px 0px 10px 0px">注册</a></li>
                <?php else: ?>
                <li class="disuser"><a href="/LanceLot/index.php/User/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>" style="color:#fff;border-radius:0px 0px 0px 10px"><?php echo ($_SESSION['loginuser']['username']); ?></a></li>
                <li><a href="/LanceLot/index.php/Login/loginout" style="border-radius:0px 0px 10px 0px">退出</a></li><?php endif; ?>
            </ul>
        </div>
    </div>
    <!--搜索logo-->
    <div class="h_center">
        <div class="con">
            <div class="logo">
                <a href="/LanceLot/index.php/Index/index"><span>LanceLot</span></a>
            </div>
            <div class="search">
                <form action="/LanceLot/index.php/Index/search" method="post">
                    <input type="text" class="inp" placeholder="电影、分类" style="font-size: 12px;padding-left: 13px;" name="key" />
                    <input type="submit" class="sub" value="" />
                </form>
            </div>
        </div>
    </div>
    <!--menu菜单-->
    <div class="h_down">
        <div class="menu">
            <ul>
                <li><a href="/LanceLot/index.php/Index/index">首页</a></li>
                <li><a href="/LanceLot/index.php/News/news">影讯</a></li>
                <li><a href="/LanceLot/index.php/List/movielist">评分榜</a></li>
                <li><a href="/LanceLot/index.php/List/index">影评</a></li>
                <li><a href="/LanceLot/index.php/Typelist/index">分类</a></li>
                <li><a href="/LanceLot/index.php/Prevue/index">预告片</a></li>
            </ul>
        </div>
    </div>
</div>
    <!--header页头部分结束-->

     <div class="nav"></div>

    <!--个人中心菜单开始-->
    <script type="text/javascript">
        //个人中心滑动特效
        $(function(){
            $("#person_menu ul li").each(function(){
                if(this.className.indexOf("current_page")==-1){
                    var color;
                    $(this).find('a').css({ left:"-90px", opacity:"0.6"});
                    $(this).hover(function(){
                        $(this).find('a').animate({ left:"0px", opacity:"1"}, "normal");
                    },function(){
                        $(this).find('a').animate({ left:"-90px",opacity:"0.6"}, "normal");
                    });
                }
            });
        });
        //点击个人中心进行判断
         function personCheckLogin(){
             var uid = "<?php echo ($_SESSION['loginuser']['id']); ?>";
             if(uid.length>0){
                 window.location = "/LanceLot/index.php/User/index/id/"+uid;
             } else {
                 alert_display_block("你还没有登录!");
             }
         }
    </script>
    <div id="person_menu">
        <ul>
            <li class="nav0 current_page"><a href="javascript:personCheckLogin();">个人中心</a></li>
            <li class="nav1"><a title="首页" href="/LanceLot/index.php/Index/index">首页</a></li>
            <li class="nav2"><a title="影讯" href="/LanceLot/index.php/News/news">影讯</a></li>
            <li class="nav3"><a title="评分榜" href="/LanceLot/index.php/List/movielist">评分榜</a></li>
            <li class="nav4"><a title="影评" href="/LanceLot/index.php/List/index">影评</a></li>
            <li class="nav5"><a title="分类" href="/LanceLot/index.php/Typelist/index">分类</a></li>
            <li class="nav6"><a title="预告片" href="/LanceLot/index.php/Prevue/index">预告片</a></li>
            <li class="nav7"><a title="网站地图" href="/LanceLot/index.php/Map/map">网站地图</a></li>
        </ul>
    </div>
    <!--个人中心提示菜单结束-->

    <!--弹出提示框-->
    <div id="define_my_alert_bg"></div>
    <div id="define_my_alert">
        <div class="close"></div>
        <div class="alert_msg">
            我是弹框提示信息
        </div>
    </div>
    <script type="text/javascript">
        //弹框js
        //点击弹出div层
        function alert_display_block(msg){
            var aw = ($(window).outerWidth() - $("#define_my_alert").width()) / 2;
            var ah = ($(window).outerHeight() - $("#define_my_alert").height()) / 2;
            //输入内容
            $("#define_my_alert .alert_msg").html(msg);
            $("#define_my_alert_bg").fadeIn("fast");
            $("#define_my_alert").fadeIn("fast").css({ top:$(window).scrollTop()+ah+"px",left: aw+"px"});
        }

        //点击关闭隐藏div层
        $("#define_my_alert .close").click(function(){
            $("#define_my_alert_bg").fadeOut("fast");
            $("#define_my_alert").fadeOut("fast");
        });

        var aw = ($(window).outerWidth() - $("#define_my_alert").width()) / 2;
        var ah = ($(window).outerHeight() - $("#define_my_alert").height()) / 2;
        //滚动窗口时跟随滚动
        $(window).scroll(function(){
            $("#define_my_alert_bg").css({ top:$(window).scrollTop()+"px"});
            $("#define_my_alert").css({ top:$(window).scrollTop()+ah+"px"});
        });
    </script>


			
		<!-- 个人中心菜单结束 -->
		
		<!-- 主体部分开始	-->
		<div id="main">
		
			<!-- 左侧内容 -->
			<div id="review_main_left">
				<script type="text/javascript">
					//长评举报
					 function doLreport(id){
						$.ajax({
							url:"/LanceLot/index.php/Detail/lreport",
							data:{ id:id},//短评id
							type:"get",
							dataType:"text",
							success:function(data){
								if(data==1){
									alert_display_block("举报成功！");
								}else{
									alert_display_block("出错了，休息会吧！");
								}
							}
						});
					 }
				</script>
				<!-- 影评内容 -->
				<div class="movie_review_detail">
					<div class="title">
						<?php echo ($review["title"]); ?>
					</div>
					<div class="author">
						<div class="pic">
							<img src="/LanceLot/Uploads/User/Headpic/<?php echo ($review["user"]["headpic"]); ?>" alt="<?php echo ($review["user"]["username"]); ?>" width="30" height="30"/>
						</div>
						<a href="/LanceLot/index.php/User/index/uid/<?php echo ($review["uid"]); ?>"><?php echo ($review["user"]["username"]); ?></a>
						<span>
							<?php echo (date("Y-m-d H:i:s",$review["ptime"])); ?>
						</span>
						<a href="javascript:doLreport(<?php echo ($review["id"]); ?>);" class="r">举报</a>
						<a href="javascript:doDel(<?php echo ($review["id"]); ?>);" class="r deledit">删除</a>
						<a href="javascript:doEdit(<?php echo ($review["id"]); ?>);" class="r deledit">编辑</a>
					</div>
					<div class="re_detail">
						<?php echo ($review['content']); ?>
					</div>
				</div>
				
				<div class="nav"></div>
				
				<!-- 影评留言框 -->
				<div class="message" id="js_message">
					<p id="js_message_p">这里需要你的脚印......</p>
					<form action="" method="post" onsubmit="return false;">
						<textarea name="message"  cols="65" rows="6"></textarea>
						<input type="submit"  value="回复" id="de_review_input" class="sub" style="float:right;margin-right:50px;"/>
					</form>
				</div>
				<script type="text/javascript">
						//删除
						function doDel(id){
							
								$.ajax({
									url:"http://localhost:8080//LanceLot/index.php/Review/judge",
									type:"get",
									data:{ id:id},
									dataType:"text",
									success:function (data){
										switch(data){
											case "1":
												alert_display_block("传说：别人的东西不可以乱动！");
												break;
											case "2":
												if(confirm("确定要删除吗？")){
													window.location="http://localhost:8080//LanceLot/index.php/Review/del/id/"+id;
												}
												break;
										}
									}
								});
							
							
						}
						function doEdit(id){
							$.ajax({
								url:"/LanceLot/index.php/Review/judge",
								type:"get",
								data:{ id:id},
								dataType:"text",
								success:function (data){
									switch(data){
										case "1":
											alert_display_block("传说：别人的东西不可以乱动！");
											break;
										case "2":
											window.location="/LanceLot/index.php/Review/edit/id/"+id;
											break;
									}
								}
							});
						}
				
						//发布框js
				
						var oDiv=document.getElementById("js_message")
						var oP = document.getElementById("js_message_p");
						var oT = document.getElementsByTagName("textarea")[0];
						var oA = oDiv.getElementsByTagName('input')[0];
							
						var ie = !-[1,];
						var bBtn = true;
						var timer = null;
						var iNum = 0;
						//获取焦点事件
						oT.onfocus = function(){
							if(bBtn){
								oP.innerHTML = "这里需要你的脚印......<a>还可以输入</a><span>140</span>字";
								bBtn = false;
							}
							
						};
						//失去焦点事件
						oT.onblur = function(){
							
							if(oT.value==''){
								oP.innerHTML = '这里需要你的脚印......';
								bBtn = true;
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
							var oSpan = oDiv.getElementsByTagName('span')[0];
							var opa=oP.getElementsByTagName("a")[0];
							
							if(!oSpan){ return}
							
							if(num<=140){
								opa.innerHTML="还可以输入";
								oSpan.innerHTML = 140 - num;
								oSpan.style.color = '#d20000';
							}else{
								opa.innerHTML="已超出";
								oSpan.innerHTML = num-140;
								oSpan.style.color = 'red';
							}
							
							if(oT.value=='' || num>140){
								oA.className = 'sub';
							}else{
								oA.className = '';
							}
							
						}
						//获取字符的长度转换汉字进制数
						function getLength(str){
							return String(str).replace(/[^\x00-\xff]/g,'aa').length;
						}
						//点击事件
						oA.onclick = function(){		
							if(this.className == 'sub'){
								alert_display_block("字数有点问题！");
							}else{
								var str=oT.value;
								//去除两侧的空白字符
								if($.trim(str)==""){
									alert_display_block("字数不能为空！");
									return;
								}
							
								var rid="<?php echo ($review["id"]); ?>";//影评id
								var content=$("#js_message_textarea").val();//短评内容
								var message=$("textarea[name=message]").val();
								
								if(message.length<10){
									alert_display_block("字数不能小于10个！");
									return false;
								}	
								$.ajax({
									url:"/LanceLot/index.php/Review/rinsert",
									data:{ content:message,rid:rid},
									type:"post",
									dataType:"json",
									success:function(data){
										if(data.error==1){
											alert_display_block("请先登录！");
											return;
										}
										var str="<div class='review_list' id='rplist"+data.id+"'>";
										str+="<div class='acthor'>";
										str+="<div class='l'>";
										str+="<a href='/LanceLot/index.php/User/Index/uid/"+data.uid+"'>"+data.username+"</a>"+data.rtime;
										str+="</div><div class='r'>";
										str+="<a href='javascript:delReply("+data.id+");'>删除</a></div></div>";
										str+="<div class='content'>"+data.content+"</div></div>";
										//清空表单
										$("#review_main_left .message textarea").val("");
										if(oT.value==''){
											oP.innerHTML = '这里需要你的痕迹......';
											bBtn = true;
										}
										
										$("#review_main_left .movie_review_reply .nobody").css("display","none");
										
										//更新内容 添加成功后刷新列表
										tmp_data=new Array();
										doPageLoad(0);
										$("#review_main_left .movie_review_reply .fy").css("display","block");//显示分页
									}
								});
										
										
							}
						}

					</script>
				
				
				<div class="nav"></div>
		
			
				<div class="movie_review_reply">
					<!-- 影评回复列表 -->
					<div class="review_head">
						<span>点点滴滴留言墙......</span>
						<a class="post">看看大家说了什么</a>
					</div>
					
					<!-- ajax回复列表 -->
					<script type="text/javascript">
					var id="<?php echo ($review["id"]); ?>";//影片id
					var page=1;//当前页号
					var totalpage=0;//页总数
					var maxrows=0;//总数
					var tmp_data=new Array();//缓存数组
					//加载分页函数
					function doPageLoad(m){
						//如果为0 跳到首页
						page+=m;
						//ajax请求 开启缓存会报错
						if(tmp_data[page]==undefined){
							$.ajax({
								url:"/LanceLot/index.php/Review/pageload",
								data:{ p:page,id:id},
								type:"get",
								async:false,//设置同步
								dataType:"json",
								success:function(res){
									tmp_data[page]=res;
									
									
								}
							});
						}
						
						data=tmp_data[page]["list"];	
						totalpage=tmp_data[page]["totalpage"];
						maxrows=tmp_data[page]["maxrows"];
						if(data!=null){
							
							var str="";
							for(var i=0;i<data.length;i++){
								str+="<div class='review_list' id='rplist"+data[i].id+"'>";
								str+="<div class='acthor'>";
								str+="<div class='l'>";
								str+="<a href='/LanceLot/index.php/User/Index/uid/"+data[i].uid+"'>"+data[i].username+"</a>"+data[i].rtime;
								str+="</div><div class='r'>";
								str+="<a href='javascript:delReply("+data[i].id+");'>删除</a></div></div>";
								str+="<div class='content'>"+data[i].content+"</div></div>";
							}
							//防止越界
							if(page>totalpage){
								page=totalpage;
							}
							if(page<1){
								page=1;
							}
							//有数据就隐藏提示
							if(data.length>0){
								$("#review_main_left .movie_review_reply .nobody").css("display","none");
							}
							
							//显示页码
							$("#review_main_left .movie_review_reply .fy").css("display","block");
							$("#ajax_page_show").html("第&nbsp;"+page+"/"+totalpage+"&nbsp;页&nbsp;共"+maxrows+"条");
							$("#ajax_reply_list").html(str);
						}else{
								$("#ajax_reply_list").html("");//防止str没有数据时报错
								$("#review_main_left .movie_review_reply .nobody").css("display","block");
								$("#review_main_left .movie_review_reply .fy").css("display","none");
						}
						
						
					}
					//显示当前页面
					$(function(){
						doPageLoad(0);
					});
					
					//删除回复信息 ajax请求
						function delReply(id){
							if(confirm("确定删除吗！")){
								$.ajax({
									url:"/LanceLot/index.php/Review/delete",
									datatype:"text",
									data:{ id:id},
									type:"post",
									success:function(data){
										if(data=="true"){
											//删除一次清除缓存 防止页面刷新无效
											tmp_data=new Array();
											doPageLoad(0);
											
										}else{
											alert_display_block("没有操作权限！");
										}
										
									},
									error:function(){
										alert_display_block("删除失败，请稍后再试！");
									}
								});
							}
						}
					</script>
					<div id="ajax_reply_list"></div>
					
					<div class="nobody">
						还没有人回复哦,快来抢占沙发吧！！！
					</div>
					

					
					<!-- 分页显示短评 -->
					<div class="fy">
						<a id="ajax_page_show"></a>
						
						<a href="javascript:doPageLoad(-1);">上一页</a>
						<a href="javascript:doPageLoad(1);">下一页</a>
					
					</div>
					
					
				</div>	
				
				
				<div class="nav"></div>
			
			</div>
			
			<!-- 右侧内容 -->
			<div id="review_main_right">
				<!-- 右侧经典台词 -->
				<div class="movie_alert">
					<div class="word_title">
						温馨提示
					</div>
					<div class="word_con">
						本评论版权属于作者<?php echo ($review["username"]); ?>，并受法律保护。除非评论正文中另有声明，未经合法书面许可任何人不得转载或使用整体或任何部分的内容。特此提示。
					</div>
				</div>
				
				<div class="nav"></div>
				
				<!-- 评论的影片信息 -->
				<div class="relative_movie">
					<ul>
						<li class="ut"><a href="/LanceLot/index.php/Detail/index/id/<?php echo ($review["movie"]["id"]); ?>">><?php echo ($review["movie"]["filmname"]); ?></a></li>
						<li><a href="/LanceLot/index.php/Detail/index/id/<?php echo ($review["movie"]["id"]); ?>"><img src="/LanceLot/Uploads/Movie/Cover/c_<?php echo ($review["movie"]["picname"]); ?>" alt="" /></a></li>
						<li>上映时间：<?php echo (date("Y年",$review["movie"]["showtime"])); ?></li>
						<li>
							<?php if(is_array($review['movie']['types'])): foreach($review['movie']['types'] as $key=>$typename): echo ($typename["typename"]); ?>/<?php endforeach; endif; ?>
						</li>
						<li>导演:<?php echo ($review["movie"]["director"]); ?></li>
						<li>主演: 
							<?php if(is_array($review['movie']['actors'])): foreach($review['movie']['actors'] as $key=>$actors): ?><a href="aid/<?php echo ($actors["id"]); ?>"><?php echo ($actors["cname"]); ?></a>/<?php endforeach; endif; ?>
						</li>
						
						<li class="ut"><a href="/LanceLot/index.php/List/index/id/<?php echo ($review["movie"]["id"]); ?>">更多 <?php echo ($review["movie"]["filmname"]); ?> 影评</a></li>
					</ul>
					<ul class="relative_review">
						<?php if(is_array($reviewlist)): foreach($reviewlist as $key=>$relist): ?><li class="retop"><a href="/LanceLot/index.php/Review/index/id/<?php echo ($relist["id"]); ?>"><?php echo ($relist["title"]); ?></a></li>
						<li>来自 <?php echo ($relist["username"]); ?></li><?php endforeach; endif; ?>
					</ul>
				</div>
	
				<div class="nav"></div>
				
				<!-- 友情链接 -->
				<div class="movie_link">
					<div class="link_head">
						<span>友情链接</span>
					</div>
					<div class="link_list">
						<ul>
							<?php if(is_array($link)): foreach($link as $key=>$l): ?><li><a href="<?php echo ($l["url"]); ?>"><img src="/LanceLot/Uploads/News/mypic/c_<?php echo ($l["picname"]); ?>"/></a></li><?php endforeach; endif; ?>
						</ul>
					</div>
				</div>
				
				<div class="nav"></div>
			</div>
			
		</div>
		
		<!-- 主体部分结束	-->
		
		<div class="nav"></div>
		
		<!-- 页脚部分开始 -->
		
		<include file="Public/foot">
		
		<!-- 页脚不封结束 -->
		
		
	</body>
</html>