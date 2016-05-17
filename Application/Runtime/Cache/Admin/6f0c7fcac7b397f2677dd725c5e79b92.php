<?php if (!defined('THINK_PATH')) exit();?><h2 class="contentTitle">修改公告信息</h2>
<style>
	.pageFormContent dl{ width:680px}/*表单项宽度*/
	.pageFormContent dl dt{ width:100px;text-align:right;margin-right:5px;font-weight:bold;} /*表单标题加粗 font-weight:bold;*/ 
	span.error{ left:300px;}/*错误信息浮动位置*/
</style>
<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Notice/update/navTabId/listnotice/callbackType/closeCurrent" class="pageForm required-validate" enctype="multipart/form-data" onsubmit="return validateCallback(this, navTabAjaxDone)">
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
		<div class="pageFormContent" layoutH="97">
			<dl>
				<dt>公告标题：</dt>
				<dd><input type="text" class="required" name="title" size="60" value="<?php echo ($vo["title"]); ?>" /></dd>
			</dl>
			
			<dl class="nowrap">
				<dt>公告简要：</dt>
				<dd><textarea name="shortcon" rows="5" cols="82" style="resize:none;" value="<?php echo ($vo["shortcon"]); ?>" ><?php echo ($vo["shortcon"]); ?></textarea></dd>
			</dl>
			
			<dl class="nowrap">
				<dt>内容：</dt>
				<dd><textarea class="editor" name="content" rows="15" cols="82" upImgUrl="/LanceLot/admin.php/Notice/doupload" upImgExt="jpg,jpeg,gif,png" tools="mini"><?php echo ($vo["content"]); ?></textarea></dd>
			</dl>
			
			<dl>
				<dt>状态：</dt>
				<dd>
					<?php if($vo["status"] == 1): ?><input type="radio" name="status" value="1" checked />直接发布
					<input type="radio" name="status" value="0" />保留草稿
					<?php else: ?>
					<input type="radio" name="status" value="1" />直接发布
					<input type="radio" name="status" value="0" checked />保留草稿<?php endif; ?>
				</dd>
			</dl>		
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">完成编辑</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>