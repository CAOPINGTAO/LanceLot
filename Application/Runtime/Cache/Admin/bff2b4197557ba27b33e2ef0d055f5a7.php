<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Auser/update/navTabId/listuser/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this,dialogAjaxDone);"> 
	
	<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">

	<div class="pageFormContent" layoutH="60">
		<dl>
			<dt>用 户 名：</dt>
			<dd><input type="text" class="required" style="width:100%" name="username" value="<?php echo ($vo["username"]); ?>" /></dd> 
		</dl>
		<dl>
			<dt>姓 名：</dt> 
			<dd><input type="text" class="required" style="width:100%"
			name="fullname" value="<?php echo ($vo["fullname"]); ?>"></dd>
		</dl>
		<dl>
			<dt>Email：</dt>
			<dd><input type="text" class="required" style="width:100%"
			name="email" value="<?php echo ($vo["email"]); ?>" /></dd>
		</dl>
		<dl>
			<dt>电话号码： </dt>
			<dd><input type="text" class="required" style="width:100%"
			name="phone" value="<?php echo ($vo["phone"]); ?>">
		</dd>
		<dl>
			<dt>状态：</dt>
			<dd>
				<?php if($vo["status"] == 0): ?><input type="radio" name="status" value="0" checked />启用
				<input type="radio" name="status" value="1" />禁用
				<?php elseif($vo["status"] == 1): ?>
				<input type="radio" name="status" value="0" />启用
				<input type="radio" name="status" value="1" checked />禁用
				<?php else: ?>
				<input type="radio" name="status" value="0" />启用
				<input type="radio" name="status" value="1" />禁用<?php endif; ?>
			</dd>
		</dl>
	</div>

	<div class="formBar">
		<ul>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存修改</button></div></div></li>
			<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
		</ul>
	</div>
	</form>
</div>