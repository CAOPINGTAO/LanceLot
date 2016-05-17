<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post"  enctype="multipart/form-data" action="/LanceLot/admin.php/Longreview/update/navTabId/listactor/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<dl class="">
				<dt>影评标题：</dt>
				<dd style="color:green;"><?php echo ($vo["title"]); ?></dd>
			</dl>			
			<dl class="nowrap">
				<dt>影评内容：</dt>
				<dd><textarea name="content" class="editor" tools="simple" rows="18" cols="80"  disabled style="resize:none;" ><?php echo ($vo["content"]); ?></textarea></dd>
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