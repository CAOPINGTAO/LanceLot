<?php if (!defined('THINK_PATH')) exit();?>
<script type="text/javascript">
	$(function(){
		$("#upload").click(function(){
			$("#uploadphotos").append("<input type='file' name='picname[]' />");
			$(this).attr('value', '继续上传');
		});

	});
</script>

<style type="text/css">
	
</style>

<div class="pageContent">
	<form method="post"  enctype="multipart/form-data" action="/LanceLot/admin.php/Movie/uploadsHandle/navTabId/listmovie/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<h2>上传剧照</h2>
			<hr/>
			<input type="hidden" name="id" value="<?php echo ($movid); ?>" />
			<div id="uploadphotos">
				<input type="button" id="upload" value="选择剧照" /><br/>
				<input type="file" name="picname[]" class="" />
			</div>
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