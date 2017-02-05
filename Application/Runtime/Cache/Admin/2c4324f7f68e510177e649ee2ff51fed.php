<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	.com {
		border:1px solid #B8D0D6;
		border-bottom: 0px;
		padding: 5px;
		margin:  5px 5px 0 5px; 
		background-color: #C0C0C0;
	}
	.mcom {
		border:1px solid #B8D0D6;
		padding: 3px;
		margin:  0px 5px 5px 5px; 
		
	}
	.method {
		display: inline-block;
		padding-left:3px; 
		width: 140px;
		height:18px;
		line-height: 18px;
		margin: 3px 3px 3px 15px;
		background-color: #ccffcc;
	}

</style>

<form method="post" action="/LanceLot/admin.php/Role/setAccess/navTabId/listrole/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
	<div class="pageFormContent" layoutH="98">

		<input type="hidden" name="rid" value="<?php echo ($rid); ?>">

		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$app): $mod = ($i % 2 );++$i;?><fieldset style="border:1px solid #D8D0D6;margin:5px;padding:5px;" class="app">
			<legend style="border:1px solid #B8D0D6; padding:5px;"><input type="checkbox" name="access[]" value="<?php echo ($app["id"]); ?>_1" level="1" checked="checked" /><?php echo ($app["title"]); ?>
			</legend>
			<?php if(is_array($app['child'])): $i = 0; $__LIST__ = $app['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?><div class="action">
				<div class="com">
					<?php if($action['access'] == 1): ?><input type="checkbox" name="access[]" value="<?php echo ($action["id"]); ?>_2" level="2" checked="checked" /><?php echo ($action['title']); ?>
					<?php else: ?>
					<input type="checkbox" name="access[]" value="<?php echo ($action["id"]); ?>_2" level="2" /><?php echo ($action['title']); endif; ?>
				</div>
				<div class="mcom">
					<?php if(is_array($action['child'])): $i = 0; $__LIST__ = $action['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?><span class="method">
							<?php if($method['access'] == 1): ?><input type="checkbox" name="access[]" value="<?php echo ($method["id"]); ?>_3" level="3" checked="checked" />
							<?php else: ?>
							<input type="checkbox" name="access[]" value="<?php echo ($method["id"]); ?>_3" level="3" /><?php endif; ?>
						</span><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</fieldset><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>

	<div class="formBar">
		<ul>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
			<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
		</ul>
	</div>
	</form>