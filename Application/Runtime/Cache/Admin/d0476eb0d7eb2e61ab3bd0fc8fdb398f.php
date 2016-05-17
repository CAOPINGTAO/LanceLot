<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Ulevel/insert/navTabId/listlevel/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		
		<div class="pageFormContent" layoutH="60" style="padding-right:100px;">
				<dl class="nowrap">
					<dt><b>等级位置：</b></dt>
					<dd><input name="level" type="text" /></dd>
				</dl>
		
				<dl class="nowrap">
					<dt><b>级别名称：</b></dt>
					<dd><input name="levelname" type="text" /></dd>
				</dl>
				
				<dl class="nowrap">
					<dt><b>积分限制：</b></dt>
					<dd><input name="lscore" type="text" /></dd>
				</dl>
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存添加</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>