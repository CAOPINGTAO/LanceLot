<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <title>LanceLot后台管理</title>

    <link href="/LanceLot/Public/dwz/themes/default/style.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="/LanceLot/Public/dwz/themes/css/core.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="/LanceLot/Public/dwz/themes/css/print.css" rel="stylesheet" type="text/css" media="print" />
    <link href="/LanceLot/Public/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen" />
    <!--自定义样式-->
    <link href="/LanceLot/Public/css/node.css" rel="stylesheet" type="text/css"/>
    <!--[if IE]>
    <link href="/LanceLot/Public/dwz/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
    <![endif]-->

<script src="/LanceLot/Public/dwz/js/speedup.js" type="text/javascript"></script>
<script src="/LanceLot/Public/dwz/js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="/LanceLot/Public/dwz/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/LanceLot/Public/dwz/js/jquery.validate.js" type="text/javascript"></script>
<script src="/LanceLot/Public/dwz/js/jquery.bgiframe.js" type="text/javascript"></script>

<script src="/LanceLot/Public/dwz/xheditor/xheditor-1.1.12-zh-cn.min.js" type="text/javascript"></script>
<script src="/LanceLot/Public/dwz/uploadify/scripts/swfobject.js" type="text/javascript"></script>
<script src="/LanceLot/Public/dwz/uploadify/scripts/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>


<script src="/LanceLot/Public/dwz/js/dwz.min.js" type="text/javascript"></script>
<script src="/LanceLot/Public/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

<!-- uploadify -->
<!-- uploadify -->

<script type="text/javascript">
$(function(){
	DWZ.init("/LanceLot/Public/dwz/dwz.frag.xml", {
		//loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
		//loginUrl:"login.html",	// 跳到登录页面
		statusCode:{ ok:200, error:300, timeout:301}, //【可选】
		pageInfo:{ pageNum:"pageNum", numPerPage:"numPerPage", orderField:"_order", orderDirection:"_sort"}, //【可选】
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({ themeBase:"/LanceLot/Public/dwz/themes"}); // themeBase 相对于index页面的主题base路径
		}
	});
});
</script>
</head>

<body scroll="no">
    <div id="layout">
        <div id="header">
            <div class="headerNav">
                <a class="logo" href="#">标志</a>

                <ul class="nav">
                    <li><a class="home" href="/LanceLot/index.php">返回首页</a></li>
                    <li><a href="#" target="_blank">欢迎您：<?php echo ($username); ?></a></li>
                    <li><a href="/LanceLot/admin.php/Index/password" target="dialog">修改密码</a></li>
                    <li><a href="/LanceLot/admin.php/Index/logout">退出</a></li>
                </ul>

                <ul class="themeList" id="themeList">
                    <li theme="default"><div class="selected">蓝色</div></li>
                    <li theme="green"><div>绿色</div></li>
                    <li theme="purple"><div>紫色</div></li>
                    <li theme="silver"><div>银色</div></li>
                    <li theme="azure"><div>天蓝</div></li>
                </ul>
            </div>
        </div>

        <div id="leftside">
            <div id="sidebar_s">
                <div class="collapse">
                    <div class="toggleCollapse"><div></div></div>
                </div>
            </div>
            <div id="sidebar">
                <div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>
                <div class="accordion" fillSpace="sidebar">

                    <!--用户权限管理-->
                    <div class="accordionHeader">
                        <h2><span>Folder</span>访问控制</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><span>用户管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Auser/index" target="navTab" rel="listuser" title="用户信息" >浏览用户信息</a></li>
                                </ul>
                            </li>
                            <li><span>角色管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Role/index" target="navTab" rel="listrole" title="角色信息" >浏览角色信息</a></li>
                                </ul>
                            </li>
                            <li><span>节点管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Node/index" target="navTab" rel="listnode" title="节点信息" >浏览节点信息</a></li>
                                    <li><a href="/LanceLot/admin.php/Node/nodeList" target="navTab" rel="nodelist" title="添加节点" >添加节点信息</a></li>

                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!--系统管理-->
                    <div class="accordionHeader">
                        <h2><span>Folder</span>系统管理</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><span>幻灯片信息管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Ppt/index" target="navTab" rel="pptlist">浏览幻灯片信息</a></li>
                                    <li><a href="/LanceLot/admin.php/Ppt/add" target="dialog" width="600" height="300">添加幻灯片信息</a></li>
                                </ul>
                            </li>
                            <li><span>每日台词</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Dialogue/index" target="navTab" rel="listdialogue" title="每日台词管理">浏览台词信息</a></li>
                                    <li><a href="/LanceLot/admin.php/Dialogue/add" target="dialog" width="830" height="350">添加台词信息</a></li>
                                </ul>
                            </li>
                            <li><span>友情链接</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Friendlink/index" target="navTab" rel="linklist">浏览友情链接信息</a></li>
                                    <li><a href="/LanceLot/admin.php/Friendlink/add" target="dialog" width="600" height="300">添加友情链接</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!--影片管理-->
                    <div class="accordionHeader">
                        <h2><span>Folder</span>影片管理</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><span>影片管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Movie/index" target="navTab" rel="listmovie" title="浏览影片信息">浏览影片信息</a></li>
                                    <li><a href="/LanceLot/admin.php/Movie/add" class="add" target="navTab" rel="addmovie" title="添加影片"><span>添加影片信息</span></a></li>
                                </ul>
                            </li>
                            <li><span>演员管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Actors/index" target="navTab" rel="listactor" title="浏览演员信息">浏览演员信息</a></li>
                                    <li><a href="/LanceLot/admin.php/Actors/add" target="navTab" rel="listactor" title="添加演员信息">添加演员信息</a></li>
                                </ul>
                            </li>
                            <li><span>分类管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Type/index" target="navTab" rel="listtype" title="浏览分类信息">浏览分类信息</a></li>
                                </ul>
                            </li>
                            <li><span>演员评论管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Acomment/index" target="navTab" rel="Acomment" title="演员评论管理">演员评论管理</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!--预告片管理-->
                    <div class="accordionHeader">
                        <h2><span>Folder</span>预告片管理</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li>
                                <li><a href="/LanceLot/admin.php/Prevue/index" target="navTab" rel="listprevue" title="预告片管理">浏览预告片信息</a></li>
                                <li><a href="/LanceLot/admin.php/Prevue/add" target="dialog" title="添加预告片信息" width="600" height="400">添加预告片信息</a></li>
                            </ul>
                            </li>
                        </ul>
                    </div>

                    <!--影评管理-->
                    <div class="accordionHeader">
                        <h2><span>Folder</span>影评管理</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li>
                                <li><a href="/LanceLot/admin.php/Longreview/index" target="navTab" rel="listlreview" title="影评管理">浏览影评信息</a></li>
                                <li><a href="/LanceLot/admin.php/Shortreview/index" target="navTab" rel="listsreview" title="短评管理">浏览短评信息</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!--用户管理-->
                    <div class="accordionHeader">
                        <h2><span>Folder</span>用户管理</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><a href="/LanceLot/admin.php/User/index" target="navTab" rel="userlist" title="用户信息">管理前台用户信息</a></li>
                            <li><a href="/LanceLot/admin.php/Notice/index" target="navTab" rel="listnotice" title="公告信息">管理公告信息</a></li>
                            <li><a href="/LanceLot/admin.php/Ulevel/index" target="navTab" rel="listlevel" title="用户级别划分">用户级别划分</a></li>
                        </ul>
                    </div>

                     <!--新闻资讯管理-->
                    <div class="accordionHeader">
                        <h2><span>Folder</span>新闻管理</h2>
                    </div>
                    <div class="accordionContent">
                        <ul class="tree treeFolder">
                            <li><span>电影新闻管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Mnews/index" target="navTab" rel="mnewslist">浏览电影新闻信息</a></li>
                                    <li><a href="/LanceLot/admin.php/Mnews/add" target="navTab" width="600" height="300">添加电影新闻</a></li>
                                </ul>
                            </li>
                            <li><span>人物新闻管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Pnews/index" target="navTab" rel="pnewslist">浏览人物新闻信息</a></li>
                                    <li><a href="/LanceLot/admin.php/Pnews/add" target="navTab" width="600" height="300">添加人物新闻</a></li>
                                </ul>
                            </li>
                            <li><span>新闻评论管理</span>
                                <ul>
                                    <li><a href="/LanceLot/admin.php/Comment/index1" target="navTab" rel="mcommentlist">浏览电影新闻评论</a></li>
                                    <li><a href="/LanceLot/admin.php/Comment/index2" target="navTab" rel="pcommentlist">浏览人物新闻评论</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="container">
            <div id="navTab" class="tabsPage">
                <div class="tabsPageHeader">
                    <div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
                        <ul class="navTab-tab">
                            <li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
                        </ul>
                    </div>
                    <div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
                    <div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
                    <div class="tabsMore">more</div>
                </div>
                <ul class="tabsMoreList">
                    <li><a href="javascript:;">主页</a></li>
                </ul>
                <div class="navTab-panel tabsPageContent layoutBox">
                    <div class="page unitBox">
                        <div class="accountInfo">
                            <p><b style="color:#48BFF9;font-Size:20px;">笃学力行 守正求新</b><a href="#" target="_blank"></a></p>
                        </div>

                        <div class="pageFormContent" layoutH="80" style="margin-right: 230px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer">Copyright &copy; 2016 <a href="demo_page2.html" target="dialog">开发团队</a></div>
    </div>
</body>
</html>