<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Node/update/navTabId/listrole/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);">
		
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />

		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>角色：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="name" value="<?php echo ($vo["name"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>角色名称：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="title" value="<?php echo ($vo["title"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>角色描述：</dt>
				<dd><input type="text"  style="width:100%" name="remark" value="<?php echo ($vo["remark"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>状态：</dt>
				<dd>
					<?php if($vo['status'] == 1): ?><input type="radio" name="status" value="1" checked="checked" />启用
					<?php else: ?>
					<input type="radio" name="status" value="1" />启用<?php endif; ?>
					<?php if($vo['status'] == 0): ?><input type="radio" name="status" value="0" checked='checked' />禁用
					<?php else: ?>
					<input type="radio" name="status" value="0" />禁用<?php endif; ?>
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