<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
</head>
<style type="text/css">
	*{ margin:0px;border:0px;padding:0px;}
	body{ font:12px "宋体";}
	a{ color:#000;text-decoration:none;}
	a:hover{ color:#ffafc9;text-decoration:underline;}
	input{ padding:0px;margin:0px;}
	.txtbox{ border:1px solid #DBE8EA;height:20px;line-height:22px;width:120px;}
	.bfont{ font:100 12px "宋体";}
	#login{ width:400px;height:100%;overflow:hidden;margin:0px auto;}
	#login_one{ width:400px;float:left;}
	
	#title{ width:400px;height:30px;line-height:30px;color:#fff;background-color:#ffafc9;text-align:center;margin:0px auto;}
	#loginbox{ width:185px;height:120px;margin:10px 20px;float:left;display:inline;}
	#btnlogin{ width:55px;height:120px;float:right;margin:10px 30px 10px 5px;}
	#forget{ width:200px;margin:0px auto;height:25px;line-height:25px;text-align:center;}
	#forget span{ width:80px;display:inline;margin:0px 10px;}
</style>
<body>
<div id="login">
	<div id="login_one">
	<div id="title">欢迎登录Lancelot</div>
    <div style="width:360px;height:160px;margin:0px auto;">
        <form method="post" action="/Lancelot/index.php/Login/login/id/1">
		<table id="loginbox" border="0" cellpadding="0" cellspacing="0">
            <tr style="height:40px">
                <td class="bfont">用户名:</td>
                <td><input class="txtbox" type="text" name="username" style="width:180px;"/></td>
            </tr>
            <tr>
                <td class="bfont">密&nbsp;码:</td>
                <td><input class="txtbox" type="password" name="password" style="width:180px;"/></td>
            </tr>
			<tr>
                <td class="bfont">验证码:</td>
				<td><input class="txtbox" type="text" name="code" style="width:70px;float:left;margin-top:10px;"/>
				<img style="margin-top:10px;" src="/Lancelot/index.php/Login/verify" onclick="this.src=this.src+'?'+Math.random()"/></td>
            </tr>
			 <tr>
                <td class="bfont">&nbsp;</td>
                <td><input class="txtbox" type="submit" name="" value="马上登录" style="width:120px;height:30px;color:#fff;margin-top:10px;background-color:#268dcd;"/></td>
            </tr>
        </table>
		</form>
    </div>
    <div id="forget">
    	<span style="float:left;"><a href="#">忘记密码</a></span>
        <span style="float:right;"><a href="/Lancelot/index.php/Register/register">马上注册</a></span>
    </div>
    <!-- <div style="height:25px;line-height:25px;text-align:center">马上注册还可以对喜爱的电影和影星进行收藏哦(⊙o⊙)！ </div>
	</div> -->
	<!-- <div id="login_two">
		<img style="width:180px;height:220px;" src="/Lancelot/Public/front/images/loginpic.jpg"/>
	</div> -->
</div>
</body>
</html>