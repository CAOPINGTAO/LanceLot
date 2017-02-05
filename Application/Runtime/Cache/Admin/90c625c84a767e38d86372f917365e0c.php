<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Movie/editStatusHandle/navTabId/listmovie/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		
		<input type='hidden' name='pstatus' value="<?php echo ($vo["status"]); ?>" />
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />

		<div class="pageFormContent" layoutH="56">
			<p>
				<label>影 片 名：</label>	
				<input  class="textInput readonly disabled" size="30" type="text" value="<?php echo ($vo["filmname"]); ?>" />
			</p>
			
			<p>
				<label>影片别名：</label>
				<input class="textInput readonly disabled" type="text" size="30" value="<?php echo ($vo["petname"]); ?>" />
			</p>
			
			<p>
				<label>上映时间：</label>
				<input type="text" class="textInput readonly disabled" size="30" value="<?php echo (date("Y-m-d",$vo["addtime"])); ?>" />
			</p>

			<p>
				<label>状 态：</label>
				<?php if($vo['status'] == 2): ?><input name="status" type="radio" size="30" value='0' />新添加
				<input name="status" type="radio" size="30" value="1" />显示
				<input name="status" type="radio" size="30" value="2" checked />幻灯片
				<?php elseif($vo['status'] == 1): ?>
				<input name="status" type="radio" size="30" value='0' />新添加
				<input name="status" type="radio" size="30" value="1" checked />显示
				<input name="status" type="radio" size="30" value="2" />幻灯片
				<?php else: ?>
				<input name="status" type="radio" size="30" value='0' checked />新添加
				<input name="status" type="radio" size="30" value="1" />显示
				<input name="status" type="radio" size="30" value="2" />幻灯片<?php endif; ?>	
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