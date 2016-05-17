<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/User/insertletter/dialog/detail/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="uid" value="<?php echo ($uid); ?>" />
		<div class="pageFormContent" layoutH="60" style="padding-right:100px;">
				<dl>
					<dt>信件标题：</dt>
					<dd><input name="title" type="text" style="width:100%"/></dd>
				</dl>
				<dl class="nowrap">
					<dt>信件内容：</dt>
					<dd><textarea name="content" cols="130" rows="20"></textarea></dd>
				</dl>		
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">发送</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>