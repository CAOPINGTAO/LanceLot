<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post"  enctype="multipart/form-data" action="/lancelot/admin.php/Movie/insert/navTabId/listmovie/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>影 片 名：</label>
				<input  class="required" size="30" name="filmname" type="text" />
			</p>
			
			<p>
				<label>影片别名：</label>
				<input name="petname" class="required" type="text" size="30" />
			</p>
			<p>
				<label>导 演：</label>
				<input name="director" class="required" type="text" size="30" />
			</p>
			<p>
				<label>编剧：</label>
				<input name="editor" class="required" type="text" size="30" />
			</p>
			<p>
				<label>制片国家和地区：</label>
				<input type="text" name="nation" class="required" size="30" />
			</p>
			<p>
				<label>语言：</label>
				<input type="text" name="language" class="required" size="30" />
			</p>
			
			<p>
				<label>上映时间：</label>
				<input type="text" name="showtime" class="date" size="30" /><a class="inputDateButton" href="javascript:;">选择</a>
			</p>
			<p>
				<label>片 长：</label>
				<input name="minutes" class="digits textInput" type="text" size="30" />
			</p>
			<p style="width:600px;">
				<label>状 态：</label>
				<input name="status" type="radio" size="30" value='0' checked />新添加
			</p>
			<p style="width:600px;">
				<label>影片封面：</label>
				<input type="file" name="picname" class="required" />
			</p>
			<dl class="nowrap">
				<dt>影片简介：</dt>
				<dd></textarea><textarea class="editor" name="content" rows="10" cols="68" tools="simple"></textarea></dd>
			</dl>
				
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