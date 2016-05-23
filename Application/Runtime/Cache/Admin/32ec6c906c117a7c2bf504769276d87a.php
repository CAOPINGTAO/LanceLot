<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>lancelot</title>
    <link href="/LanceLot/Public/dwz/themes/css/login.css" rel="stylesheet" type="text/css" />
    <script src="/LanceLot/Public/dwz/js/jquery-1.7.1.js" type="text/javascript"></script>
    <script type="text/javascript">
        function fleshVerify(type){
            //重载验证码
            var timenow = new Date().getTime();
            if (type){
                $('#verifyImg').attr("src", '/LanceLot/admin.php/Login/verify/'+timenow);
            }else{
                $('#verifyImg').attr("src", '/LanceLot/admin.php/Login/verify/'+timenow);
            }
        }
    </script>
    <style type="text/css">
        a { text-decoration: none; font-style: italic}
    </style>
</head>
<body>
<div id="login">
    <div id="login_header">
        <h1 class="login_logo">
            <a href="/LanceLot/admin.php" style="font-size: 35px;color: #00B1F6;text-decoration: none;">Lancelot</a>
        </h1>
        <div class="login_headerContent">
            <div class="navList">
            </div>
            <h2 class="login_title" style="font-size: 16px; text-align: left;">登录Lancelot后台</h2>
        </div>
    </div>
    <div id="login_content">
        <div class="loginForm">
            <form action="/LanceLot/admin.php/Login/checkLogin/" method="post">
                <p>
                    <label>帐号：</label><br>
                    <input type="text" name="username" size="20" class="login_input">
                </p>
                <p>
                    <label>密码：</label><br>
                    <input type="password" name="password" size="20" class="login_input" />
                </p>
                <p>
                    <label>验证码：</label>
                    <input class="code" name="code" type="text" size="20"/>
                    <span><img id="verifyImg" src="/LanceLot/admin.php/Login/verify" onClick="fleshVerify()" border="0" alt="点击刷新验证码" style="cursor:pointer" align="absmiddle" /></span>
                </p>
                <div class="login_bar">
                    <input class="sub" type="submit" value=" " />
                </div>
            </form>
        </div>
        <div class="login_banner"><img src="/LanceLot/Public/dwz/themes/default/images/login_banner.jpg" /></div>
        <div class="login_main"></div>
    </div>
    <div id="login_footer">
        Copyright &copy; 2016 Lancelot Inc. All Rights Reserved.
    </div>
</div>
</body>