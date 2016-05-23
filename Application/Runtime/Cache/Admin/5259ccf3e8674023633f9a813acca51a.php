<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post"  enctype="multipart/form-data" action="/LanceLot/admin.php/Movie/update/navTabId/listmovie/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>影 片 名：</label>
				<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
				<input  class="required" size="30" name="filmname" type="text" value="<?php echo ($vo["filmname"]); ?>" />
			</p>
			
			<p>
				<label>影片别名：</label>
				<input name="petname" class="required" type="text" size="30" value="<?php echo ($vo["petname"]); ?>" />
			</p>
			<p>
				<label>导 演：</label>
				<input name="director" class="required" type="text" size="30" value="<?php echo ($vo["director"]); ?>" />
			</p>
			<p>
				<label>编剧：</label>
				<input name="editor" class="required" type="text" size="30"  value="<?php echo ($vo["editor"]); ?>" />
			</p>
			<p>
				<label>制片国家和地区：</label>
				<input type="text" name="nation" class="required" size="30" value="<?php echo ($vo["nation"]); ?>" />
			</p>
			<p>
				<label>语言：</label>
				<input type="text" name="language" class="required" size="30" value="<?php echo ($vo["language"]); ?>" />
			</p>
			
			<p>
				<label>上映时间：</label>
				<input type="text" name="showtime" class="date" size="30" value="<?php echo (date("Y-m-d",$vo["showtime"])); ?>" /><a class="inputDateButton" href="javascript:;">选择</a>
			</p>
			<p>
				<label>片 长：</label>
				<input name="minutes" class="digits textInput required" type="text" size="30" value="<?php echo ($vo["minutes"]); ?>" alt="请输入数字影片分钟数" />
			</p>
			<p style="height:60px; line-height:60px">
				<label style="height:60px; line-height:60px">影片封面：<img src="/LanceLot/Uploads/Movie/Cover/a_<?php echo ($vo["picname"]); ?>" /></label>
				<input type="file" name="picname" />
				<input type="hidden" name="pname" value="<?php echo ($vo["picname"]); ?>" />
			</p>
			<dl class="nowrap">
				<dt>影片简介：</dt>
				<dd></textarea><textarea class="editor" name="content" rows="10" cols="68" tools="simple"><?php echo ($vo["content"]); ?></textarea></dd>
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