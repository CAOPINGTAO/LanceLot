<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>LanceLot</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/Lancelot/Public/front/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/Lancelot/Public/front/css/public.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Lancelot/Public/front/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/Lancelot/Public/front/js/move.js"></script>

		<script type="text/javascript" src="/Lancelot/Public/front/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/Lancelot/Public/front/js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="/Lancelot/Public/front/js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="/Lancelot/Public/front/js/jquery.ui.tabs.js"></script>

		<link rel="stylesheet" type="text/css" href="/Lancelot/Public/front/css/jquery.ui.core.css" />
		<link rel="stylesheet" type="text/css" href="/Lancelot/Public/front/css/jquery.ui.theme.css" />
		<link rel="stylesheet" type="text/css" href="/Lancelot/Public/front/css/jquery.ui.tabs.css" />
		<link rel="stylesheet" type="text/css" href="/Lancelot/Public/front/css/mail.css" />
		<style type="text/css">

			/**/
			#main_left span.btn {
				display: inline-block;
				float: right;
				width:120px;
				height: 30px;
				line-height: 30px;
				background-color: #e5ebe4; 
				border-radius:5px;
				text-align: center;
			}
			#main_left .btn a{
				display: inline-block;
				float: right;
				width:120px;
				height: 30px;
				line-height: 30px;
				text-align: center;
				border-radius:5px;
				cursor: pointer;
			}
			#main_left .hide {
				display: none;
			}
			/**/
			span.buy {
				width:130px;
				height: 25px;
				line-height: 25px; 
				border-radius:5px;
				text-align: center;
			}
			span.buy a{
				display: inline-block;
				background-color: #CCFFCC;
				width:130px;
				height: 25px;
				line-height: 25px;
				font-size: 12px;
				text-align: center;
				border-radius:3px;
				cursor: pointer;
			}
		</style>
		<script type="text/javascript">
			$(function(){
				$(".btn").click(function(){	
					if ($(".hide").is(":visible")) {
						$(".hide").hide();
					} else{
						$(".hide").show();
					}
				});
			});

    </script>
</head>
<body>
    <!--左侧导航栏菜单开始 -->
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
<script type="text/javascript" src="/Lancelot/Public/front/js/totop.js"></script>
<script type="text/javascript" src="/Lancelot/Public/front/js/thickbox_plus.js"></script>
<link rel="stylesheet" type="text/css" href="/Lancelot/Public/front/css/thickbox.css"/>
<!-- head页头部分开始-->
<div id="header">
    <div class="h_top">
        <div class="con">
            <ul class="left">
                <li><a href="/Lancelot/index.php/Index/index" class="title"></a></li>
            </ul>
            <ul class="right">
                <?php if(empty($_SESSION['loginuser'])): ?><li class="disuser"><a href="/Lancelot/index.php/Login/ShowLogin.html?height=245;width=600" style="border-radius:0px 0px 0px 10px" class="thickbox"  title="登录">登录</a></li>
                <li><a href="/Lancelot/index.php/Register/register" style="border-radius:0px 0px 10px 0px">注册</a></li>
                <?php else: ?>
                <li class="disuser"><a href="/Lancelot/index.php/User/index/uid/<?php echo ($_SESSION['loginuser']['id']); ?>" style="color:#fff;border-radius:0px 0px 0px 10px"><?php echo ($_SESSION['loginuser']['username']); ?></a></li>
                <li><a href="/Lancelot/index.php/Login/loginout" style="border-radius:0px 0px 10px 0px">退出</a></li><?php endif; ?>
            </ul>
        </div>
    </div>
    <!--搜索logo-->
    <div class="h_center">
        <div class="con">
            <div class="logo">
                <a href="/Lancelot/index.php/Index/index"><span>LanceLot</span></a>
            </div>
            <div class="search">
                <form action="/Lancelot/index.php/Index/search" method="post">
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
                <li><a href="/Lancelot/index.php/Index/index">首页</a></li>
                <li><a href="/Lancelot/index.php/News/news">影讯</a></li>
                <li><a href="/Lancelot/index.php/List/movielist">评分榜</a></li>
                <li><a href="/Lancelot/index.php/List/index">影评</a></li>
                <li><a href="/Lancelot/index.php/Typelist/index">分类</a></li>
                <li><a href="/Lancelot/index.php/Prevue/index">预告片</a></li>
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
                 window.location = "/Lancelot/index.php/User/index/id/"+uid;
             } else {
                 alert_display_block("你还没有登录!");
             }
         }
    </script>
    <div id="person_menu">
        <ul>
            <li class="nav0 current_page"><a href="javascript:personCheckLogin();">个人中心</a></li>
            <li class="nav1"><a title="首页" href="/Lancelot/index.php/Index/index">首页</a></li>
            <li class="nav2"><a title="影讯" href="/Lancelot/index.php/News/news">影讯</a></li>
            <li class="nav3"><a title="评分榜" href="/Lancelot/index.php/List/movielist">评分榜</a></li>
            <li class="nav4"><a title="影评" href="/Lancelot/index.php/List/index">影评</a></li>
            <li class="nav5"><a title="分类" href="/Lancelot/index.php/Typelist/index">分类</a></li>
            <li class="nav6"><a title="预告片" href="/Lancelot/index.php/Prevue/index">预告片</a></li>
            <li class="nav7"><a title="网站地图" href="/Lancelot/index.php/Map/map">网站地图</a></li>
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


    <!--左侧导航栏菜单结束-->

    <!--主体部分开始-->
    <div id="main">

        <!--左侧内容-->
        <div id="main_left">
            <!--口碑排行 -->
            <div class="movie_hot">
                <div class="hot_head">
                    <span>口碑排行</span>
                    <span class="btn"><a>显示更多</a></span>
                </div>
                <div class="hot_list">
                    <ul>
                        <?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a href="/Lancelot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><img src="/Lancelot/Uploads/Movie/Cover/d_<?php echo ($vo["picname"]); ?>" alt="" /></a>

                            <span><a href="/Lancelot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a></span>
                            <span>
                                综合评分：
                                <strong><?php echo (round($vo["rate"],1)); ?></strong>
                            </span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <ul class="hide">
                        <?php if(is_array($hide)): $i = 0; $__LIST__ = $hide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a href="/Lancelot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><img src="/Lancelot/Uploads/Movie/Cover/d_<?php echo ($vo["picname"]); ?>" alt="" /></a>
                            <span><a href="/Lancelot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a></span>
                            <span>
                                综合评分：
                                <strong><?php echo (round($vo["rate"],1)); ?></strong>
                            </span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>

            <!--电影大图间隔图片-->
            <div class="movie_bpic">
                <img src="/Lancelot/Public/front/images/movie_sz.jpg" alt="" />
            </div>
            <div class="nav"></div>

            <!--近期热播-->
            <div class="movie_recent">
                <div class="recent_head">
                    <span>近期热门</span>
                </div>
                <div class="recent_list">
                    <ul>
                        <?php if(is_array($recent)): $i = 0; $__LIST__ = $recent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a href="/Lancelot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><img src="/Lancelot/Uploads/Movie/Cover/c_<?php echo ($vo["picname"]); ?>" alt="" /></a>
                            <span style="height: 36px;"><a style="font-size: 12px" href="/Lancelot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a></span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>

            <!--最受欢迎影评-->
            <div class="movie_review">
                <div class="review_head">
                    <span>最受欢迎影评</span>
                    <span style="float: right;padding-top: 8px;"><a href="/Lancelot/index.php/List/index">更多热门影评>>></a></span>
                </div>
                <?php if(is_array($reviewlist)): $i = 0; $__LIST__ = $reviewlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="review_list">
                    <div class="rl">
                        <a href="/Lancelot/index.php/Detail/index/id/<?php echo ($v["fid"]); ?>"><img src="/Lancelot/Uploads/Movie/Cover/b_<?php echo ($v["picname"]); ?>" alt="<?php echo ($v["filmname"]); ?>" /></a>
                    </div>
                    <div class="rr">
                        <div class="title">
                            <a href="/Lancelot/index.php/Review/index/id/<?php echo ($v["id"]); ?>">
                                <?php echo ($v["title"]); ?>
                            </a>
                        </div>
                        <div class="acthor">
                            <?php echo ($v["username"]); ?> 评论:<a href="/Lancelot/index.php/Detail/index/id/<?php echo ($v["fid"]); ?>">《<?php echo ($v["filmname"]); ?>》</a>
                        </div>
                        <div class="content">
                            <?php echo ($v["content"]); ?>
                        </div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <!--左侧内容END-->

        <!--右侧内容Start-->
        <div id="main_right">
            <!--经典台词-->
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

            <!--右侧分类列表-->
            <div class="movie_sort" style="height: 180px">
                <div class="sort_head">
                    影片分类
                    <span style="float: right;padding-top: 10px;"><a href="/Lancelot/index.php/Typelist/index">所有分类 >>></a></span>
                </div>
                <div class="sort_list">
                    <ul>
                        <?php if(is_array($mtype)): $i = 0; $__LIST__ = $mtype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="/Lancelot/index.php/Typelist/tags/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo['typename']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>

            <!--评论榜-->
            <div class="movie_rank">
                <div class="rank_head">
                    <span>热评榜</span>
                </div>
                <div class="rank_list">
                    <ul>
                        <?php if(is_array($num)): $i = 0; $__LIST__ = $num;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <span style="display: inline-block;width: 200px;"><a href="/Lancelot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a></span>
                                <span style="display: inline-block;width: 60px; color: #8CB5C3;">评论数：</span>
                                <span style="color:#ffafc9;"><?php echo ($vo["replynum"]); ?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>

            <!--电影排行榜-->
            <div class="movie_top">
                <div class="top_head">
                    <span>电影Top10</span>
                    <span style="float: right;padding-top: 10px;"><a href="/Lancelot/index.php/List/movietop">更多 >>></a></span>
                </div>
                <div class="top_list">
                    <ul>
                        <?php if(is_array($clicknum)): $i = 0; $__LIST__ = $clicknum;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="height: 140px;">
                            <a href="/Lancelot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><img src="/Lancelot/Uploads/Movie/Cover/b_<?php echo ($vo["picname"]); ?>" alt="" /></a>
                            <a href="/Lancelot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>

            <!--友情链接-->
            <div class="movie_link">
                <div class="link_head">
                    <span>友情链接</span>
                </div>
                <div class="link_list">
                    <ul>
                        <?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($l["url"]); ?>"><img src="/Lancelot/Uploads/News/mypic/c_<?php echo ($l["picname"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>
        </div>
        <!--右侧内容END-->
        <!--主题部分END-->
    </div>
    <!--主体部分结束-->
    <div class="nav"></div>

    <!--导入页脚部分-->
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

</body>
</html>