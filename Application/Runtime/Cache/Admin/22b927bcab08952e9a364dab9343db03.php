<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Type/insert/navTabId/listtype/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>所属类别：</label>
				<select name="fid" class="required combox">
					<option value="">请选择</option>
					<option value="1">类型</option>
					<option value="2">国家/地区</option>
					<option value="3">年代</option>
				</select>
			</p>
			<p>
				<label>分类名：</label>
				<input name="typename" type="text" size="30" />
			</p>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>