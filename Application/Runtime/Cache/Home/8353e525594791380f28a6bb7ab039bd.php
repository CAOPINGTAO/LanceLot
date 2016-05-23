<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>LanceLot</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="/LanceLot/Public/front/css/style.css" rel="stylesheet" type="text/css"/>
		<link href="/LanceLot/Public/front/css/public.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="/LanceLot/Public/front/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/LanceLot/Public/front/js/move.js"></script>
		
		<!-- 编辑器文件导入 -->
		<script src="/LanceLot/Public/dwz/xheditor/xheditor-1.1.12-zh-cn.min.js" type="text/javascript"></script>		
		<script>
			$(function(){
				$("#text").xheditor({
					skin:'default',tools:'simple',
					upImgUrl:'/LanceLot/index.php/Review/upload',
					upImgExt:'jpg,jpeg,gif,png',
					html5Upload:false,
					width:800,
					height:280,
				});
			});
		</script>
		
	</head>
	<body>
	<!-- head页头部分开始 -->
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
                <?php if(empty($_SESSION['loginuser'])): ?><li class="disuser"><a href="/LanceLot/index.php/Login/ShowLogin.html?height=245;width=600" class="thickbox"  title="登录">登录</a></li>
                <li><a href="/LanceLot/index.php/Register/register">注册</a></li>
                <?php else: ?>
                <li class="disuser"><a href="/LanceLot/index.php/User/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>" style="color:#fff;"><?php echo ($_SESSION['loginuser']['username']); ?></a></li>
                <li><a href="/LanceLot/index.php/Login/loginout">退出</a></li><?php endif; ?>
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
                    <input type="text" class="inp" placeholder="电影、分类" style="font-size: 12px;padding-left: 5px;" name="key" />
                    <input type="submit" class="sub" value="" />
                </form>
            </div>
           <!--  <div class="logoimg">
                <img src="/LanceLot/Public/front/images/logo.jpg" alt=""/>
            </div> -->
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

	
	<!-- head页头部分结束 -->
		
		<!-- 主体部分开始	-->
		<div id="main">
			
			<!-- 左侧内容 -->
			<div id="detail_main_left">
				<!-- 电影详情 -->
				<div class="movie_detail">
					<div class="d_title">
						<?php echo ($movie["filmname"]); ?>
					</div>
					<div class="d_left01">
						<img src="/LanceLot/Uploads/Movie/Cover/c_<?php echo ($movie["picname"]); ?>" alt="<?php echo ($movie["filmname"]); ?>" />
					</div>						
					<div class="d_left02">
						<ul>
							<li>导演:<?php echo ($movie["director"]); ?></li>
							<li>编剧:<?php echo ($movie["editor"]); ?></li>
							<li>主演: 
								<?php if(is_array($movie['actorlist'])): $i = 0; $__LIST__ = $movie['actorlist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$alist): $mod = ($i % 2 );++$i;?><a href="/LanceLot/index.php/Detail/actor/id/<?php echo ($alist["id"]); ?>"><?php echo ($alist["cname"]); ?></a>/<?php endforeach; endif; else: echo "" ;endif; ?>

							</li>
							<li>类型: 
								<?php if(is_array($movie['typelist'])): $i = 0; $__LIST__ = $movie['typelist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tlist): $mod = ($i % 2 );++$i;?><a href="/LanceLot/index.php/Typelist/tags/id/<?php echo ($tlist["id"]); ?>"><?php echo ($tlist["typename"]); ?></a>/<?php endforeach; endif; else: echo "" ;endif; ?>
							</li>
							<li>国家/地区: <?php echo ($movie["nation"]); ?></li>
							<li>语言: <?php echo ($movie["language"]); ?></li>
							<li>上映日期: <?php echo (date("Y-m-d",$movie["showtime"])); ?>(中国大陆)</li>
							<li>片长: <?php echo ($movie["minutes"]); ?>分钟</li>
							<li>又名:<?php echo ($movie["petname"]); ?></li>
						</ul>
					</div>
					
					<div class="d_right">
						<ul>
						<li>综合评分: <span><?php echo (round($movie["score"],1)); ?>分</span></li>
							<li><a >(<?php echo ($movie["reviewtotal"]); ?>人评价)</a></li>
							<li>&nbsp;</li>
							<li>&nbsp;</li>
							<li><a>我来评分</a></li>
							<li id="pingfen">
								<ul>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
									<li></li>
								</ul>
							</li>
						</ul>
					</div>
					<script type="text/javascript">
						var oPf=document.getElementById('pingfen');
						var aLi=oPf.getElementsByTagName('li');
						var i=0;
						
						for(i=0;i<aLi.length;i++){
							aLi[i].index=i;
							aLi[i].onmouseover=function(){
								for(i=0;i<aLi.length;i++){
									if(i<=this.index)
									{
										aLi[i].style.background="url(/LanceLot/Public/front/images/star.gif) no-repeat 0 -29px";
									}
									else
									{
										aLi[i].style.background="url(/LanceLot/Public/front/images/star.gif) no-repeat 0 0";
									}
								}
							};
							
							aLi[i].onmousedown=function ()
							{	//ajax评分操作
								//alert('提交成功:'+(this.index+1)+'分');
								var score=(this.index+1)*2;
								var fid="<?php echo ($movie["id"]); ?>";
								$.ajax({
									url:"/LanceLot/index.php/Detail/score",
									type:"get",
									data:{ fid:fid,score:score},
									dataType:"text",
									success:function(data){
										switch(data){
											case "4":alert_display_block(score+"分,评分成功！");break;
											case "1":alert_display_block("记得先登录哦");break;
											case "2":alert_display_block("不能重复评分哦！");break;
											case "3":alert_display_block("休息一会，再试试吧！");break;
										}
									}
								});
							};
						}
					</script>

					<div class="d_down">
						<span ><t id="update_saw"><?php echo ($movie["onum"]); ?></t>人 </span><button class="l" onclick="doSaw(<?php echo ($movie["id"]); ?>);">看过</button>
						<span ><t id="update_see"><?php echo ($movie["snum"]); ?></t>人 </span><button class="l" onclick="doSee(<?php echo ($movie["id"]); ?>);">想看</button>
						<span ><t id="update_collect"><?php echo ($movie["collectnum"]); ?></t>人 </span><button href="" class="l c" onclick="doCollect(<?php echo ($movie["id"]); ?>)">收藏</button>
						<span ><t id="update_praise"><?php echo ($movie["pnum"]); ?></t>人 </span><button href="" class="l c" onclick="doPraise(<?php echo ($movie["id"]); ?>)">赞</button>
						
						 <button class="r alert_post_review">写影评</button>
					</div>

					<script type="text/javascript">
					 //短评举报
					 function doSreport(id){
						$.ajax({
							url:"http://localhost:8080/LanceLot/index.php/Detail/sreport",
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
					 
					 
					 //赞操作
					function doPraise(fid){
						$.ajax({
							url:"http://localhost:8080/LanceLot/index.php/Detail/dopraise",
							type:"post",
							data:{ fid:fid},
							dataType:"json",
							success:function(data){
								switch(data.stat){
									case 3:
										//更新页面想看数
										$("#update_praise").html(data.praisenum);
										alert_display_block("赞+1！");
									break;
									case 1:alert_display_block("记得先登录哦");break;
									case 2:alert_display_block("你已经赞过了！");break;
								}
							}
						});
					}
					 
					 //想看操作
					function doSee(fid){
						$.ajax({
							url:"http://localhost:8080/LanceLot/index.php/Detail/dosee",
							type:"post",
							data:{ fid:fid},
							dataType:"json",
							success:function(data){
								switch(data.stat){
									case 3:
										//更新页面想看数
										$("#update_see").html(data.seenum);
										$("#update_saw").html(data.sawnum);
										alert_display_block("想看+1！");
									break;
									case 1:alert_display_block("记得先登录哦");break;
									case 2:alert_display_block("我们已经想看过了！");break;
								}
							}
						});
					}
					
					//看过操作
					function doSaw(fid){
						$.ajax({
							url:"http://localhost:8080/LanceLot/index.php/Detail/dosaw",
							type:"post",
							data:{ fid:fid},
							dataType:"json",
							success:function(data){
								switch(data.stat){
									case 3:
									//更新页面看过数
										$("#update_saw").html(data.sawnum);
										$("#update_see").html(data.seenum);
										alert_display_block("看过+1！");
									break;
									case 1:alert_display_block("记得先登录哦");break;
									case 2:alert_display_block("你已经看过了！");break;
								}
							}
						});
					}
					 
					 
					 //收藏ajax操作
					function doCollect(fid){
						$.ajax({
							url:"http://localhost:8080/LanceLot/index.php/Detail/collect",
							type:"post",
							data:{ fid:fid},
							dataType:"text",
							success:function(data){
								switch(data){
									case "4":alert("收藏成功！");
										//更新页面收藏数
										var tmp=$("#update_collect").html();
										tmp=parseInt(tmp)+1;
										$("#update_collect").html("");
										$("#update_collect").html(tmp);
									break;
									case "1":alert_display_block("记得先登录哦");break;
									case "2":alert_display_block("不能重复收藏哦！");break;
									case "3":alert_display_block("休息一会，再收藏吧！");break;
								}
							}
						});
					}
					</script>
					 
				</div>
				
				<div class="nav"></div>
				
				<!-- 电影剧情 -->
				<div class="movie_plot">
					<div class="p_head">
						<?php echo ($movie["filmname"]); ?>的剧情简介  ·  ·  ·  ·  ·  ·
					</div>
					<div class="p_content">
					<?php echo ($movie["content"]); ?>
					</div>
			
				</div>
				<div class="nav"></div>
				<?php if(!empty($video['id'])): ?><!-- {if !empty($video.id)} -->
				<div class="prevue_video">
					
					<div class="video_item">
						<div class="t"><a href="/LanceLot/index.php/Prevue/play/id/<?php echo ($video["id"]); ?>" >预告片</a></div>
						<div class="c">
							<a href="/LanceLot/index.php/Prevue/play/id/<?php echo ($video["id"]); ?>">
							<img src="/LanceLot/Uploads/Prevue/b_<?php echo ($video["picname"]); ?>"  />
							<img src="/LanceLot/Public/front/images/play.jpg"  class="play"/>
							</a>
						<a href="/LanceLot/index.php/Prevue/play/id/<?php echo ($video["id"]); ?>" class="gk">立即观看</a>
						</div>
					</div>
				</div><?php endif; ?>
				<!-- {/if} -->
				<div class="nav"></div>
				
				<div class="relative_pic_title">
						影片剧照
				</div>
				<!--  影片相关图片 -->
				<div class="relative_pic" >
					<ul id="js_relative_pic">
						<?php if(is_array($movie['piclist'])): $i = 0; $__LIST__ = $movie['piclist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$plist): $mod = ($i % 2 );++$i;?><li><img src="/LanceLot/Uploads/Movie/mPhotos/<?php echo ($plist["picname"]); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				
			
				
				<!-- js	特效-->
				<script type="text/javascript">
					var ob=document.getElementById("js_relative_pic");
					var list=ob.getElementsByTagName("li");
					var minZindex=2;
					
						//1.布局转换
					for(i=0;i<list.length;i++)
					{
						list[i].style.left=list[i].offsetLeft+'px';
						list[i].style.top=list[i].offsetTop+'px';
					}
					
					for(i=0;i<list.length;i++)
					{
						list[i].style.position='absolute';
						list[i].style.margin='0';
					}
					
					
					for(var i=0;i<list.length;i++){
						list[i].onmouseover=function (){
							this.style.zIndex=minZindex++;
							startMove(this, { width: 200, height: 200, marginLeft: -50, marginTop: -50});
						};
						
						list[i].onmouseout=function (){
							startMove(this, { width: 100, height: 100, marginLeft: 0, marginTop: 0});
						};
					}
					
				</script>
			
				<div class="nav"></div>

				<script type="text/javascript">
					//ajax请求分页函数
					var page=1;//页码
					var totalpage=0;//页大小
					var maxrows=0;//总数据
					var fid="<?php echo ($movie["id"]); ?>";//获取电影id
					
					var tmp_data=new Array();//缓存数组
					function doPageLoad(m){
						page+=m;
						//判断是否有缓存 没有就加载
						if(tmp_data[page]==undefined){
							$.ajax({
								url:"/LanceLot/index.php/Detail/pageload",
								type:"get",
								data:{ fid:fid,p:page},
								dataType:"json",
								async:false,
								success:function(res){
									tmp_data[page]=res;
								}
							});
						}
						
						//遍历输出
						data=tmp_data[page]["list"];
						totalpage=tmp_data[page]["totalpage"];
						maxrows=tmp_data[page]["maxrows"];
						if(data!=null){
							var str="";
							for(var i=0;i<data.length;i++){
								
								str+="<div class='review_list'><div class='acthor'>";
								str+="<div class='l'><a href='/LanceLot/index.php/User/index/uid/"+data[i].uid+"'>"+data[i].username+"</a>"+data[i].rtime+"</div>";	
								str+="<div class='r'><span>&nbsp;&nbsp;</span><a href='javascript:doSreport("+data[i].id+");'>举报</a></div></div>";
								str+="<div class='content'>"+data[i].content+"</div></div>";
							}
							
							//越界判断
							if(page>totalpage){
								page=totalpage;
							}
							if(page<1){
								page=1
							}
							
							$("#detail_main_left .movie_short_review .nobody").css("display","none");//隐藏提示
							$("#detail_main_left .movie_short_review .fy").css("display","block");//显示页码
							$("#ajax_shortreview_list").html(str);//添加数据
							$("#detail_main_left .movie_short_review .fy span").html(maxrows+" 条记录 "+page+"/"+totalpage+" 页 ");
						}
					}
					$(function(){
						//加载页面自动显示默认页
						doPageLoad(0);
					});
						
				</script>
				
				<div class="movie_short_review">
					<div class="review_head">
						<span><?php echo ($movie["filmname"]); ?>的短评......</span>
						<a class="post">看看大家说了什么</a>
					</div>
					<!-- 短评列表 -->
					<div id="ajax_shortreview_list"></div>
					<div class="nobody">
						还没有人回复哦,快来抢占沙发吧！！！
					</div>
					<!-- 分页显示短评 -->
					<div class="fy">
					<span></span>
					<a href="javascript:doPageLoad(-1)">上一页</a>
					<a href="javascript:doPageLoad(1)">下一页</a>
					</div>
					
					<!-- 短评留言 -->
					<div class="message" id="js_message">
						<form action="" method="post" onsubmit="return false;">
							<p id="js_message_p">这里需要你的脚印......</p>
							<textarea name="message" id="js_message_textarea" cols="70" rows="6" style="resize:none;"></textarea>
							<button id="message_button" class="sub" />我来说两句</button>
						</form>
					</div>
					<script type="text/javascript">
						//发布框js
				
						var oDiv=document.getElementById("js_message")
						var oP = document.getElementById("js_message_p");
						var oT = document.getElementById("js_message_textarea");
						var oA = oDiv.getElementsByTagName('button')[0];
							
						var ie = !-[1,];
						var bBtn = true;
						var timer = null;
						var iNum = 0;
						//获取焦点事件
						oT.onfocus = function(){
							if(bBtn){
								oP.innerHTML = "风继续吹，不忍离去...... <a>还可以输入</a><span>140</span>字";
								bBtn = false;
							}
							
						};
						//失去焦点事件
						oT.onblur = function(){
							
							if(oT.value==''){
								oP.innerHTML = '这里需要你的痕迹......';
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
							
							if(num<10 || num>140){
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
								alert_display_block("字数要求在10-140个字之间哦！");
							}else{
								var str=oT.value;
								//去除两侧的空白字符
								if($.trim(str)==""){
									alert_display_block("字数不能为空！");
									return;
								}
								var fid="<?php echo ($movie["id"]); ?>";//影片id
								var content=$("#js_message_textarea").val();//短评内容
								
								//如果输入合法进行ajax请求
								$.ajax({
									url:"/LanceLot/index.php/Detail/insert",
									data:{ fid:fid,content:content},
									type:"post",
									dataType:"json",
									success:function(data){
										//用户没有登录提示
										if(data=="1"){
											alert_display_block("请先登录");
											return;
										}
										//添加失败
										if(data=="2"){
											alert_display_block("有点小问题，稍等一下！");
											return;
										}
										//回复成功 返回数组
										var str="";
										str+="<div class='review_list'><div class='acthor'>";
										str+="<div class='l'><a href='/LanceLot/index.php/User/index/uid/"+data.uid+"'>"+data.username+"</a>"+data.rtime+"</div>";	
										str+="<div class='r'><span>&nbsp;&nbsp;</span><a href='javascript:doSreport("+data.id+");'>举报</a></div></div>";
										str+="<div class='content'>"+data.content+"</div></div>";
										
										//回复成功 加载回复列表
										tmp_data=new Array();//清空缓存
										doPageLoad(0);
										//$("#detail_main_left .movie_short_review .review_head").after(str);
										$("#js_message_textarea").val("");//清空留言框短评内容
										//清空数字计数
										if(oT.value==''){
											oP.innerHTML = '这里需要你的痕迹......';
											bBtn = true;
										}
										
										
									}
								});
							}	
						};	
				
					</script>
				</div>	
				
				
				<div class="nav"></div>

				
				<!-- 最受欢迎的影评 -->
				<div class="movie_review">
					<div class="review_head">
						<span><?php echo ($movie["filmname"]); ?>的影评......</span>
						<a href="/LanceLot/index.php/List/index/fid/<?php echo ($movie["id"]); ?>">更多相关影评</a>
						<button  class="post alert_post_review">我来评论这部电影</button>
					</div>
					<?php if(is_array($viewlist)): $i = 0; $__LIST__ = $viewlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$review): $mod = ($i % 2 );++$i;?><div class="review_list">
							
							<div class="title">
								<div class="user_pic">
									<a href="/LanceLot/index.php/User/index/uid/<?php echo ($review["user"]["id"]); ?>"><img src="/LanceLot/Uploads/User/Headpic/<?php echo ($review["user"]["headpic"]); ?>" alt="" width="40" height="40"/></a>
								</div>
								<a href="/LanceLot/index.php/Review/index/id/<?php echo ($review["id"]); ?>">
								<?php echo ($review["title"]); ?>
								</a> 
							</div>
							<div class="acthor">
								  <a href="/LanceLot/index.php/User/index/uid/<?php echo ($review["user"]["id"]); ?>"><?php echo ($review["user"]["username"]); ?> </a> <?php echo (date("y-m-d H:i:s",$review["ptime"])); ?>
							</div>
							<div class="content">
								<?php echo ($review["content"]); ?>
							</div>
							<div class="point">
								<!-- <span>546/678&nbsp;&nbsp;有用</span> --><a href="/LanceLot/index.php/Review/index/id/<?php echo ($review["id"]); ?>">(<?php echo ($review["countreply"]); ?>人回复)</a>
							</div> 	
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="nobody">
						还没有人评论哦,快来抢占评论吧！！！
					</div>
<!-- 					</foreach>	 -->
				</div>
			
			</div>
			
			<!-- 右侧内容 -->
			<div id="main_right">
				<!-- 右侧经典台词 -->
				<div class="movie_word">
					<div class="word_title">
						经典台词
					</div>
					<div class="word_con">
						<p><?php echo ($dialogue["en_dialogue"]); ?></p>
						<p><?php echo ($dialogue["cn_dialogue"]); ?></p>
					</div>
					<div class="source">
						《<?php echo ($dialogue["source"]); ?>》
					</div>
				</div>
				
				<div class="nav"></div>
				
				<!--右侧分类列表 -->
				<div class="movie_sort">
					<div class="sort_head">
						影片分类
						<span style="float:right;padding-top:10px;"><a href="/LanceLot/index.php/Typelist/index">所有分类 >>></a></span>
					</div>
					<div class="sort_list">
						<ul>
							<?php if(is_array($mtype)): foreach($mtype as $key=>$vo): ?><li><a href="/LanceLot/index.php/Typelist/tags/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo['typename']); ?></a></li><?php endforeach; endif; ?>
						</ul>
					</div>
				</div>
				
				<div class="nav"></div>
				<!-- 评论榜 -->
				<div class="movie_rank">
					<div class="rank_head">
						<span>MyMovie热评榜</span><!-- 
						<span style="float:right;padding-top:10px;"><a href="">更多榜单 >>></a></span> -->
					</div>
					<div class="rank_list">
						<ul>
							<?php if(is_array($num)): foreach($num as $key=>$vo): ?><li>
								<span style="display:inline-block; width:200px;"><a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a></span>
								<span style="display:inline-block; width:50px; color:#8CB5C3;">评论数：</span>
								<span style="color:#8CB5C3;"><?php echo ($vo["replynum"]); ?></span>
							</li><?php endforeach; endif; ?>

							<!-- margin-left:120px;color:#8CB5C3; -->
							
						</ul>
					</div>
				</div>
				
				<div class="nav"></div>
				

				<!-- 电影top10-->
				<div class="movie_top">
					<div class="top_head">
						<span>电影Top10 </span>
						<span style="float:right;padding-top:10px;"><a href="/LanceLot/index.php/List/movietop">更多 >>></a></span>
					</div>
					<div class="top_list">
						<ul>
							<?php if(is_array($clicknum)): foreach($clicknum as $key=>$vo): ?><li style="height:140px;">
								<a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><img src="/LanceLot/Uploads/Movie/Cover/b_<?php echo ($vo["picname"]); ?>" alt="" /></a>
								<a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a>
							</li><?php endforeach; endif; ?>
						</ul>
					</div>
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
		
		<!-- 隐藏的弹框div -->
			<div  id="alert_review_bg"></div>
			<div id="words_edit">
				<img src="/LanceLot/Public/front/images/close.jpg" alt="关闭" />
				<div class="atitle">
					向大家分享下你对这部电影的感受吧......
				</div>
				<div class="acon">
				<form action="/LanceLot/index.php/Review/insert/fid/<?php echo ($movie["id"]); ?>" method="post" onsubmit="return reviewJudge();">
				
					标题:<input type="text" name="title" class="winput"/>
					<textarea name="content" id="text" style="resize:none;"   cols="70" rows="10" ></textarea>
	
					<input type="submit" value="发表影评" class="wsub"/>
				</form>
				</div>		
			</div>

		<!-- 发影评弹框页js -->
		<script type="text/javascript">
		//发布影评内容可标题不可以为空
		function reviewJudge(){
			
			if($('#words_edit .winput').val()==""){
				alert_display_block("标题不可以为空！");
				return false;
			}
			if($('#text').val()==""){
				alert_display_block("传说：一定要写几个字！");
				return false;
			}
			return true;
		}
		
		$(function(){
			//获取屏幕的宽高		
			
			var w=($(window).outerWidth()-$("#words_edit").width())/2;
			var h=($(window).outerHeight()-$("#words_edit").height())/2;
			var userid="<?php echo (session('loginuser')); ?>";
			
			//点击弹出div层
			$(".alert_post_review").click(function(){
				if(userid==""){
					alert_display_block("请先登录！");
					return;
				}
				$("#alert_review_bg").fadeIn("normal");
				$("#words_edit").slideDown("normal").css({ top:$(window).scrollTop()+h+"px",left:w+"px"});
			});
			
			//点击关闭隐藏div层
			$("#words_edit img").click(function(){	
				$("#alert_review_bg").fadeOut("normal");
				$("#words_edit").fadeOut("normal");
			});
			
			//滚动窗滚动跟随滚动
			$(window).scroll(function(){
				$("#alert_review_bg").css({ top:$(window).scrollTop()+"px"});
				$("#words_edit").css({ top:$(window).scrollTop()+h+"px"});
			});
			
			
		});
		</script>
		
		
		<div class="nav"></div>
		
		<!-- 页脚部分开始 -->
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