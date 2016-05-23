<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>LanceLot</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/LanceLot/Public/front/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/LanceLot/Public/front/css/public.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/LanceLot/Public/front/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/LanceLot/Public/front/js/move.js"></script>

		<script type="text/javascript" src="/LanceLot/Public/front/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/LanceLot/Public/front/js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="/LanceLot/Public/front/js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="/LanceLot/Public/front/js/jquery.ui.tabs.js"></script>

		<link rel="stylesheet" type="text/css" href="/LanceLot/Public/front/css/jquery.ui.core.css" />
		<link rel="stylesheet" type="text/css" href="/LanceLot/Public/front/css/jquery.ui.theme.css" />
		<link rel="stylesheet" type="text/css" href="/LanceLot/Public/front/css/jquery.ui.tabs.css" />
		<link rel="stylesheet" type="text/css" href="/LanceLot/Public/front/css/mail.css" />
		<style type="text/css">
		

			/* focusbox */
			.focusbox{ width:960px;height:405px;position:relative;margin:5px auto;overflow:hidden; border-radius:10px;}
			.arrowbtn{ background:#ddd;width:60px;height:60px;cursor:pointer;position:absolute;top:100px;}
			.prebtn{ left:0;}
			.nextbtn{ right:0;}
			.contentimg{ position:absolute;top:0;left:0;width:7000px;}
			.contentimg li{ width:960px;height:340px;float:left;margin-right:10px;overflow:hidden;}
			.contentimg li img{ width:960px;height:340px;}
			.contentdesc{
				position:absolute;top:0;right:0;width:260px;height:340px;background:rgba(0,0,0,0.7);overflow:hidden;
				filter:progid:DXImageTransform.Microsoft.gradient(enabled='true',startColorstr='#B2000000', endColorstr='#B2000000');
			}
			.contentdesc .desc{ color:#dadada;}
			.contentdesc .desc h4{ font-size:15px;font-weight:bold;color:#fff;}
			.contentdesc .desc strong{ color:#e4007f;}
			.contentdesc .desc .def_ico{ display:inline-block;*display:inline;zoom:1;width:68px;height:18px;overflow:hidden;background:url(/LanceLot/Uploads/News/mypic/T193mCXnRQXXXXXXXX-300-300.png) no-repeat -112px -129px;vertical-align:middle;}
			.contentdesc .desc .stars{ display:inline-block;width:53px;height:10px;background:url(/LanceLot/Uploads/News/mypic/T1t2aCXnVZXXXXXXXX-53-10.png) no-repeat;}
			.contentdesc .desc_btn{ display:block;width:119px;height:38px;background:url(/LanceLot/Uploads/News/mypic/T1t2aCXnVZXXXXXXXX-102-26.png) no-repeat;margin-top:12px;}
			.contentdesc li{ width:262px;height:320px;padding:20px 0 0 20px;}
			.focusbox .navbox{ width:990px;overflow:hidden;position:absolute;right:0px;left:0px;bottom:0;}
			.focusbox .navbox li{ width:134px;height:55px;overflow:hidden;float:left;margin-right:2px;border:1px solid #fff;}
			.focusbox .navbox li img{ width:134px;height:55px;}
			.focusbox .navbox li.selected{ width:134px;height:53px;border:1px solid #ff32a5;}
			.focusbox .navbox li.selected img{ width:134px;height:53px;}


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


    <!--左侧导航栏菜单结束-->

    <!--ppt和电影相关信息-->
    <div class="focusbox">
        <div class="contentbox">
            <ul class="contentimg">
                <?php if(is_array($ppt)): $i = 0; $__LIST__ = $ppt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pv): $mod = ($i % 2 );++$i;?><li><a href="/LanceLot/index.php/Detail/index/id/<?php echo ($pv["mid"]); ?>" target="_blank"><img width="960" height="340" src="/LanceLot/Uploads/News/mypic/b_<?php echo ($pv["picname"]); ?>" title="<?php echo ($pv["title"]); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul class="contentdesc">
                <?php if(is_array($ppt)): $i = 0; $__LIST__ = $ppt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pv): $mod = ($i % 2 );++$i;?><li>
                    <div class="desc">
                        <h4><?php echo ($pv["title"]); ?></h4>
                        <p style="padding-top: 10px">演员：<?php echo ($pv['cname'][0]); ?></p>
                        <p style="text-indent: 3em"><?php echo ($pv['cname'][1]); ?></p>
                        <p>类型：<?php if(is_array($pv['typename'])): $i = 0; $__LIST__ = $pv['typename'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tv): $mod = ($i % 2 );++$i; echo ($tv); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?></p>
                        <p>上映时间： <?php echo (date("Y-m-d",$pv["showtime"])); ?></p>
                        <p>国家：<?php echo ($pv["nation"]); ?></p>
                        <p>评价：<span class="stars"></span>（已有<?php echo ($pv["replynum"]); ?>条评论）</p>
                        <a class="desc_btn" href="/LanceLot/index.php/Detail/index/id/<?php echo ($pv["mid"]); ?>" title="去评论"></a>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>

        <div class="navbox">
            <ul class="mfoc_nav">
                <?php echo ($i=1); ?>
                <?php if(is_array($ppt)): $i = 0; $__LIST__ = $ppt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pv): $mod = ($i % 2 );++$i;?><!--注意这里的volist自带了自增变量$i，不想smarty模版中的foreach没有，所以_index不需要自增了-->
                <li _index="<?php echo ($i); ?>" class="selected"><img width="134" height="53" src="/LanceLot/Uploads/News/mypic/c_<?php echo ($pv["picname"]); ?>" alt="<?php echo ($pv["title"]); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <script type="text/javascript">
        (function(jQuery){
            jQuery.fn.th_focus_swing = function(options)
            {
                var defaults = {
                    time		:3500,		//轮换秒数
                    index		:1,			//默认第几张
                    speed		:500,		//切换时间
                    dis			:970,
                    splits 		:1			//总标签
                };
                var opts = jQuery.extend(defaults, options);

                var _index = opts.index;
                var _time = opts.time;
                var _speed = opts.speed;
                var _dis = opts.dis;
                var _splits = opts.splits;
                var _this = jQuery(this);

                var node_ul = _this.find(".contentimg");
                var node_li = node_ul.find("li");
                var node_li_desc = jQuery(".contentdesc").find("li");
                var node_li_nav = jQuery(".mfoc_nav").find("li");

                var li_len = node_li.length;

                var _countIndex = (node_li.length/opts.split - 1);
                var _start_left = node_ul.css("left");
                var _timer = setInterval(show, _time);

                init();
                //alert(1);
                function init() {
                    node_ul.mouseover(function() {
                        _timer = clearInterval(_timer);
                    }).mouseout(function() {
                        _timer = setInterval(show, _time);
                    });
                    node_li_desc.mouseover(function() {
                        _timer = clearInterval(_timer);
                    }).mouseout(function() {
                        _timer = setInterval(show, _time);
                    });

                    node_li_nav.mouseover(function() {
                        node_ul.stop(true, true);
                        node_li_desc.stop(true, true);
                        node_li_desc.eq(_index-1).css("display", "none");
                        node_li_nav.eq(_index-1).removeClass("selected");
                        _index = parseInt(jQuery(this).attr("_index"));
                        node_li_desc.eq(_index-1).fadeIn(_speed);
                        node_li_nav.eq(_index-1).addClass("selected");
                        _left = -_dis*(_index - 1);
                        node_ul.animate({ "left": _left}, _speed);
                        _timer = clearInterval(_timer);
                    }).mouseout(function() {
                        _timer = setInterval(show, _time);
                    });
                }

                function show() {
                    //alert(2);
                    node_ul.stop(true, true);
                    node_li_nav.eq(_index-1).removeClass("selected");
                    node_li_desc.eq(_index-1).css("display", "none");
                    _index++;
                    if(_index > li_len) {
                        node_ul.append(node_ul.find("li:lt(1)"));
                        node_ul.css("left", parseInt(node_ul.css("left")) + _dis);
                        node_li_nav.eq(0).addClass("selected");
                        node_li_desc.eq(0).fadeIn(_speed);
                    }
                    else {
                        node_li_nav.eq(_index-1).addClass("selected");
                        node_li_desc.eq(_index-1).fadeIn(_speed);
                    }
                    var _left = parseInt(node_ul.css("left")) - _dis;
                    node_ul.animate({ "left": _left}, _speed, function() {
                        if(_index > li_len) {
                            node_ul.prepend(node_ul.find("li:gt("+(li_len-_splits-1)+")"));
                            node_ul.css("left", 0);
                            _index = 1;
                        }
                    });
                }
            }
        })(jQuery);
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".focusbox").th_focus_swing();
        });
    </script>
    <!--ppt和电影相关信息结束-->
    <div class="nav"></div>
    <!--主体部分开始-->
    <div id="main">

        <!--左侧内容-->
        <div id="main_left">
            <!--正在热映 -->
            <div class="movie_hot">
                <div class="hot_head">
                    <span>正在热映</span>
                    <span class="btn"><a>显示更多</a></span>
                </div>
                <div class="hot_list">
                    <ul>
                        <?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><img src="/LanceLot/Uploads/Movie/Cover/d_<?php echo ($vo["picname"]); ?>" alt="" /></a>

                            <span><a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a></span>
                            <span>
                                综合评分：
                                <strong><?php echo (round($vo["rate"],1)); ?></strong>
                            </span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <ul class="hide">
                        <?php if(is_array($hide)): $i = 0; $__LIST__ = $hide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><img src="/LanceLot/Uploads/Movie/Cover/d_<?php echo ($vo["picname"]); ?>" alt="" /></a>
                            <span><a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a></span>
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
                <img src="/LanceLot/Public/front/images/movie_sz.jpg" alt="" />
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
                            <a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><img src="/LanceLot/Uploads/Movie/Cover/c_<?php echo ($vo["picname"]); ?>" alt="" /></a>
                            <span style="height: 36px;"><a style="font-size: 12px" href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a></span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>

            <!--最受欢迎影评-->
            <div class="movie_review">
                <div class="review_head">
                    <span>最受欢迎影评</span>
                    <span style="float: right;padding-top: 8px;"><a href="/LanceLot/index.php/List/index">更多热门影评>>></a></span>
                </div>
                <?php if(is_array($reviewlist)): $i = 0; $__LIST__ = $reviewlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="review_list">
                    <div class="rl">
                        <a href="/LanceLot/index.php/Detail/index/id/<?php echo ($v["fid"]); ?>"><img src="/LanceLot/Uploads/Movie/Cover/b_<?php echo ($v["picname"]); ?>" alt="<?php echo ($v["filmname"]); ?>" /></a>
                    </div>
                    <div class="rr">
                        <div class="title">
                            <a href="/LanceLot/index.php/Review/index/id/<?php echo ($v["id"]); ?>">
                                <?php echo ($v["title"]); ?>
                            </a>
                        </div>
                        <div class="acthor">
                            <?php echo ($v["username"]); ?> 评论:<a href="/LanceLot/index.php/Detail/index/id/<?php echo ($v["fid"]); ?>">《<?php echo ($v["filmname"]); ?>》</a>
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
                    <span style="float: right;padding-top: 10px;"><a href="/LanceLot/index.php/Typelist/index">所有分类 >>></a></span>
                </div>
                <div class="sort_list">
                    <ul>
                        <?php if(is_array($mtype)): $i = 0; $__LIST__ = $mtype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="/LanceLot/index.php/Typelist/tags/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo['typename']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>

            <!--评论榜-->
            <div class="movie_rank">
                <div class="rank_head">
                    <span>LanceLot热评榜</span>
                </div>
                <div class="rank_list">
                    <ul>
                        <?php if(is_array($num)): $i = 0; $__LIST__ = $num;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <span style="display: inline-block;width: 200px;"><a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a></span>
                                <span style="display: inline-block;width: 50px; color: #8CB5C3;">评论数：</span>
                                <span style="color:#8CB5C3;"><?php echo ($vo["replynum"]); ?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>

            <!--电影排行榜-->
            <div class="movie_top">
                <div class="top_head">
                    <span>电影Top10</span>
                    <span style="float: right;padding-top: 10px;"><a href="/LanceLot/index.php/List/movietop">更多 >>></a></span>
                </div>
                <div class="top_list">
                    <ul>
                        <?php if(is_array($clicknum)): $i = 0; $__LIST__ = $clicknum;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="height: 140px;">
                            <a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><img src="/LanceLot/Uploads/Movie/Cover/b_<?php echo ($vo["picname"]); ?>" alt="" /></a>
                            <a href="/LanceLot/index.php/Detail/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["filmname"]); ?></a>
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
                        <?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($l["url"]); ?>"><img src="/LanceLot/Uploads/News/mypic/c_<?php echo ($l["picname"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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