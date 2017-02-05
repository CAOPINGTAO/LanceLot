<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Acomment/update/navTabId/listsreview/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
				<dl class="nowrap">
					<dt style="width:80px;">回复ID：</dt>
					<dd style="width:50px;"><?php echo ($vo["id"]); ?></dd>
				</dl>
				<dl class="nowrap">
					<dt style="width:80px;">回复内容：</dt>
					<dd><textarea  cols="90" rows="5" disabled><?php echo ($vo["content"]); ?></textarea></dd>
				</dl>
				<dl class="nowrap">
					<dt style="width:80px;">回复状态：</dt>
					<dd>
						<select name="status">
							<?php if($vo["status"] == 1): ?><option value="1" selected>正常</option>
							<option value="2">举报</option>
							<option value="3">禁言</option>
							<?php elseif($vo["status"] == 2): ?>
							<option value="1">正常</option>
							<option value="2" selected>举报</option>
							<option value="3">禁言</option>
							<?php else: ?>
							<option value="1">正常</option>
							<option value="2">举报</option>
							<option value="3" selected>禁言</option><?php endif; ?>
						</select>
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