<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post"  enctype="multipart/form-data" action="/LanceLot/admin.php/Actors/update/navTabId/listactor/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<dl class="nowrap">
				<dt>演员简介：</dt>
				<dd><textarea class="editor" name="content" rows="16" cols="65" tools="simple" ><?php echo ($intro); ?></textarea></dd>
			</dl>

		</div>
		<div class="formBar">
			<ul>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">确定</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>