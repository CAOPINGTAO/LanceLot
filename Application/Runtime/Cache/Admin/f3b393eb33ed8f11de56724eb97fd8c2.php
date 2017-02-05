<?php if (!defined('THINK_PATH')) exit();?>
<h2 class="contentTitle">设置影片类别</h2>
<form method="post" action="/LanceLot/admin.php/Movie/editTypeHandle/navTabId/listmovie/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
	<div class="pageFormContent" layoutH="98">

		<input type="hidden" name="movid" value="<?php echo ($movie_id); ?>" />
		<?php if(is_array($type1)): foreach($type1 as $k=>$v): ?><p width="100" ><?php echo ($k); ?>：</p>
			<div class="divider"></div>
				<?php if(is_array($v)): foreach($v as $key=>$vo): ?><label><input type="checkbox" name="type<?php echo ($vo['fid']); ?>[]" value='<?php echo ($vo['id']); ?>'/><?php echo ($vo['typename']); ?></label><?php endforeach; endif; ?>
			</ul>
			<div class="divider"></div><?php endforeach; endif; ?>

		<?php if(is_array($type2)): foreach($type2 as $k=>$v): ?><p width="100" ><?php echo ($k); ?>：</p>
			<div class="divider"></div>
				<?php if(is_array($v)): foreach($v as $key=>$vo): ?><label><input type="radio" name="type<?php echo ($vo['fid']); ?>" value='<?php echo ($vo['id']); ?>'/><?php echo ($vo['typename']); ?></label><?php endforeach; endif; ?>
			</ul>
			<div class="divider"></div><?php endforeach; endif; ?>
		
	</div>
	<div class="formBar">
		<ul>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
			<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
			</li>
		</ul>
	</div>
</form>