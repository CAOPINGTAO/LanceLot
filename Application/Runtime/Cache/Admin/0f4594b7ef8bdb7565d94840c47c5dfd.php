<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Auser/insert/navTabId/listuser/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);">
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>用 户 名：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="username"/></dd>
			</dl>
			<dl>
				<dt>密 码：</dt>
				<dd><input type="password" class="required"  style="width:100%" name="password"/></dd>
			</dl>
			<dl>
				<dt>重复密码：</dt>
				<dd><input type="password" class="required"  style="width:100%" name="repasswd"/></dd>
			</dl>
			<dl>
				<dt>姓 名：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="fullname"/></dd>
			</dl>
			<dl>
				<dt>Email：</dt>
				<dd><input type="text" class="required email" style="width:100%" name="email"/></dd>
			</dl>
			<dl>
				<dt>电话号码：</dt>
				<dd><input type="text" class="required phone" style="width:100%" name="phone"/></dd>
			</dl>
			<dl>
				<dt>状态：</dt>
				<dd><input type="radio" name="status" value="0" checked />启用
					<input type="radio" name="status" value="1"/>禁用
				</dd>
			</dl>
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>