<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	select {
		font-size: 12px;
	}
</style>

<script type="text/javascript">
	$(function(){
		$(".addRole").click(function(){

			var obj = $(this).parent('p').clone();
			obj.find('.addRole').remove();
			$('#last').before(obj);
		});
	});
</script>

<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Auser/setRoleHandle/navTabId/listuser/callbackType/closerCurrent" class="pageForm required-validate" onsubmit="rerturn validateCallback(this,dialogAjaxDone);">

	<input type="hidden" name="uid" value="<?php echo ($user["id"]); ?>" />
	<div class="pageFormContent" layoutH="56">
		<p>
			<label>用 户 名：</label>	
			<input type="text" size="30" value="<?php echo ($user["username"]); ?>" readonly="readonly" />
		</p>
		<p>
			<label>真实姓名：</label>
			<input readonly="readonly" type="text" size="30" value="<?php echo ($user["fullname"]); ?>" />
		</p>

		<p>
			<label>分配角色：</label>
			<select name="role_id[]">
				<option value="">请选择</option>
				<?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?> &nbsp;[&nbsp; <?php echo ($v["title"]); ?> &nbsp;]</option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			<button type="button" class="addRole">添加角色</button>
		</p>
		<p id="last"></p>
	</div>
	<div class="formBar">
		<ul>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
			<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
		</ul>
	</div>
	</form>
</div>