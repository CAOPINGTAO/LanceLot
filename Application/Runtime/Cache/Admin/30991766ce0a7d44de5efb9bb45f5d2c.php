<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Ulevel/update/navTabId/listlevel/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
		<div class="pageFormContent" layoutH="60" style="padding-right:100px;">
				<dl class="nowrap">
					<dt>等级位置：</dt>
					<dd><input name="level" type="text" value="<?php echo ($vo["level"]); ?>" /></dd>
				</dl>
		
				<dl class="nowrap">
					<dt>级别名称：</dt>
					<dd><input name="levelname" type="text" value="<?php echo ($vo["levelname"]); ?>" /></dd>
				</dl>
				
				<dl class="nowrap">
					<dt>积分限制：</dt>
					<dd><input name="lscore" type="text" value="<?php echo ($vo["lscore"]); ?>" /></dd>
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