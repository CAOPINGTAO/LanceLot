<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Role/insert/navTabId/listrole/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this,dialogAjaxDone);">
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>角色：</dt>
				<dd><input type="text" class="required" style="width:100%" name="name" /></dd>
			</dl>
			<dl>
				<dt>角色名称：</dt>
				<dd><input type="text" class="required" style="width:100%" name="title" /></dd>
			</dl>
			<dl>
				<dt>角色描述：</dt>
				<dd><input type="text" style="width:100%" name="remark" /></dd>
			</dl>
			<dl>
				<dt>状态：</dt>
				<dd>
					<input type="radio" name="status" value="1" checked="checked" />启用
					<input type="radio" name="status" value="0" />禁用
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