<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>LanceLot</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link href="/LanceLot/Public/front/css/news.css" rel="stylesheet" type="text/css" />
        <link href="/LanceLot/Public/front/css/public.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="/LanceLot/Public/front/js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="/LanceLot/Public/front/js/move.js"></script>
    </head>
    <body>
        <--个人中心菜单开始-->
        <script type="text/javascript">
	//左侧通用导航栏
	$(function(){
		$(window).scroll(function(){
			//获取个人中心的top位置
			var ptop = $("#person_menu").css("top");
			//改变头的位置和透明度
			$("#header .h_top").css({ position:"relative", top:$(window.scrollTop()+"px"});
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
                <li><a href="/LanceLot/index.php/Index/index" class="title">笃 学 力 行 守 正 求 新</a></li>
            </ul>
            <ul class="right">
                {if empty($smarty.session.loginuser)}
                <li class="disuser"><a href="/LanceLot/index.php/Login/ShowLogin.html?height=245;width=600" class="thickbox"  title="登录">登录</a></li>
                <li><a href="/LanceLot/index.php/Register/register">注册</a></li>
                {else}
                <li class="disuser"><a href="/LanceLot/index.php/User/index/uid/<?php echo ($smarty["session"]["loginuser"]["id"]); ?>" style="color:#fff;"><?php echo ($smarty["session"]["loginuser"]["username"]); ?></a></li>
                <li><a href="/LanceLot/index.php/Login/loginout">退出</a></li>
                {/if}
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
                    <input type="submit" class="sub" value="">
                </form>
            </div>
            <div class="logoimg">
                <img src="/LanceLot/Public/front/images/logo.jqg" alt=""/>
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
             var uid = "<?php echo ($smarty["session"]["loginuser"]["id"]); ?>";
             if(uid.length>0){
                 window.location = "/LanceLot/index.php/Index/index/id/"+uid;
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
            <li class="nav7"><a title="网站地图" href="/LanceLot/index.php/Map/map">网站地图s</a></li>
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


        <!--个人中心菜单结束-->

        <!--主体部分开始-->
        <div id="main">
            <div id="main_top">
                <div id="main_top_1">
                    <span id="x1">新闻</span>&nbsp;&nbsp;&nbsp;<span id="x2">news</span>
                </div>
            </div>
            <div id="main_left">
                <div id="ml_top">
                    <a href="/LanceLot/index.php/Newslist/mnewslist1"><span>最新咨询</span></a>
                </div>
                {foreach $mlist1 as $mv1}
                <div class="mlc">
                    <div class="mlc1">
                        <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv1["id"]); ?>"><?php echo ($mv1["title"]); ?></a>
                    </div>
                    <div class="mlc2">
                        <?php echo ($mv1["title2"]); ?>
                    </div>
                </div>
                {/foreach}
                <div class="mlc3">
                    <a href="/LanceLot/index.php/Newslist/mnewslist1">更多 >>></a>
                </div>
            </div>
            <div id="main_center">
                {foreach $mlist2 as $mv2}
                <div class="mc">
                    <div class="mc1">
                        <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv2["id"]); ?>"><?php echo ($mv2["title2"]); ?></a>
                    </div>
                    <div class="mc2">
                        <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv2["id"]); ?>"><img src="/LanceLot/Uploads/News/article/d_<?php echo ($mv2["picname"]); ?>"/></a>
                    </div>
                    <div class="mc3">
                        <?php echo ($mv2["summary"]); ?><a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv2["id"]); ?>">【阅读全文】</a>
                    </div>
                </div>
                {/foreach}
            </div>
            <div id="main_right">
                <div class="mr_top">
                    <a href="/LanceLot/index.php/Newslist/mnewslist2"><span>精彩抢先看</span></a>
                    {foreach $mlist3 as $mv3}
                    <div class="mrc">
                        <div class="mrc1">
                            <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv3["id"]); ?>"><img src="/LanceLot/Uploads/News/article/c_<?php echo ($mv3["pica"]); ?>" style="width: 180px;height: 100px;" /></a>
                        </div>
                        <div class="mrc2">
                            <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv2["id"]); ?>"><?php echo ($mv3["title"]); ?></a>
                        </div>
                        <div class="mrc3">
                            <?php echo ($mv3["title2"]); ?>
                        </div>
                    </div>
                    {/foreach}
                    <div class="mlc3">
                        <a href="/LanceLot/index.php/Newslist/mnewslist2">更多 >>></a>
                    </div>
                </div>
            </div>

            <div class="cb_top">
                <a href="/LanceLot/index.php/Newslist/mnews"><span class="c1">电影新闻&nbsp;</span><span class="c2">MOVIE NEWS</span></a>
            </div>
            <div id="mc_left">
                <div class="mc_left_left">
                    {foreach $mlist4 as $mv4}
                    <div class="mc_left_top">
                        <div class="mcl_top1">
                            <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv4["id"]); ?>"><img src="/LanceLot/Uploads/News/article/a_<?php echo ($mv4["pica"]); ?>" style="width: 300px;height: 200px"/></a>
                        </div>
                        <div class="mcl_top2">
                            <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv4["id"]); ?>"><?php echo ($mv4["title2"]); ?></a>
                        </div>
                        <div class="mcl_top3">
                            <?php echo ($mv4["summary"]); ?>
                        </div>
                    </div>
                    {/foreach}
                </div>
                <div class="mc_left_right">
                    {foreach $mlist5 as $mv5}
                    <div class="mc_center">
                        <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv5["id"]); ?>"><?php echo ($mv5["title"]); ?></a>
                    </div>
                    <div class="mc_center2">
                        <?php echo ($mv5["summary"]); ?>
                    </div>
                    {/foreach}
                </div>
            </div>
            <div id="mc_right">
                <div class="mr_top">
                    <a href="/LanceLot/index.php/Newslist/mnewslist3"><span>专题&策划</span></a>
                </div>
                {foreach $mlist6 as $mv6}
                <div class="mcr_bottom">
                    <div class="mcb1">
                        <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv6["id"]); ?>"><img src="/LanceLot/Uploads/News/article/d_<?php echo ($mv6["picname"]); ?>" style="width: 250px;height: 80px" /></a>
                    </div>
                    <div class="mcb2">
                        <a href="/LanceLot/index.php/Newsdetail/newsdetail/id/<?php echo ($mv6["id"]); ?>"><?php echo ($mv6["title"]); ?></a>
                    </div>
                    <div class="mcb3">
                        <?php echo ($mv6["summary"]); ?>
                    </div>
                </div>
                {/foreach}
                <div class="mcl3">
                    <a href="/LanceLot/index.php/Newslist/mnewslist3">更多>>></a>
                </div>
            </div>

            <div id="center_bottom">
                <div class="cb_top">
                    <a href="/LanceLot/index.php/Newslist/pnews"><span class="c1">人物新闻&nbsp;</span><span class="c2">CELEBRITY NEWS</span></a>
                </div>
                <div id="cb_left">
                    <div class="mc_left_left">
                        {foreach $plist2 as $pv2}
                        <div class="mc_left_top">
                            <div class="mcl_top1">
                                <a href="/LanceLot/index.php/Newsdetail/pnewsdetail/id/<?php echo ($pv2["id"]); ?>"><img src="/LanceLot/Uploads/News/article/a_<?php echo ($pv2["pica"]); ?>" style="width: 300px;height: 200px" /></a>
                            </div>
                            <div class="mcl_top2">
                                <a href="/LanceLot/index.php/Newsdetail/pnewsdetail/id/<?php echo ($pv2["id"]); ?>"><?php echo ($pv2["title"]); ?></a>
                            </div>
                            <div class="mcl_top3">
                                <?php echo ($pv2["summary"]); ?>
                            </div>
                        </div>
                        {/foreach}
                    </div>

                    <div id="bb_right">
                        {foreach $plist3 as $pv3}
                        <div class="mc_center">
                            <div class="mc_center1">
                                <a href="/LanceLot/index.php/Newsdetail/pnewsdetail/id/<?php echo ($pv3["id"]); ?>"><?php echo ($pv3["title"]); ?></a>
                            </div>
                            <div class="mc_center2">
                                <?php echo ($pv3["summary"]); ?>
                            </div>
                        </div>
                        {/foreach}
                    </div>
                </div>
                <div id="cb_right">
                    <div class="mr_top">
                        <a href="/LanceLot/index.php/Newslist/pnewslist4"><span>人物专访</span></a>
                    </div>
                    {foreach $plist4 as $pv4}
                    <div class="cbr">
                        <div class="cbr2">
                            <a href="/LanceLot/index.php/Newslist/pnewsdetail/id/<?php echo ($pv4["id"]); ?>"><span><?php echo ($pv4["title2"]); ?></span></a>
                        </div>
                        <div class="cbrb">
                            <div class="cbr3">
                                <?php echo ($pv4["summary"]); ?>
                            </div>
                            <div class="cbr4">
                                <a href="/LanceLot/index.php/Newsdetail/pnewsdetail/id/<?php echo ($pv4["id"]); ?>"><img src="/LanceLot/Uploads/News/article/d_<?php echo ($pv4["picname"]); ?>" /></a>
                            </div>
                        </div>
                    </div>
                    {/foreach}
                </div>
            </div>
        </div>
        <!--主题部分END-->
    <div class="nav"></div>

    <!--页脚部分开始-->
    <div id="footer">
        <div class="foot_top">
            <div class="foot_link">
                <a href="" target="_blank">公司简介</a> |
                <a href="" target="_blank">合作伙伴</a> |
                <a href="/LanceLot/index.php/Map/map" target="_blank">网站地图</a> |
                <a href="" target="_blank">保护隐私</a> |
                <a href="" target="_blank">版权信息</a> |
                <a href="" target="_blank">客户服务</a> |
                <a href="" target="_blank">联系我们</a> |
            </div>
        </div>
        <div class="foot_content">
            Copyright&#169;1996-2014  LanceLot
        </div>
    </div>
<!--页脚部分结束-->
    </body>
</html>