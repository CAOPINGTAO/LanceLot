<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Movie/navTabId/listmovie/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>影 片 名：</label>
				<label style="width:240px;"><?php echo ($mt["filmname"]); ?></label>
			</p>
			<p>
				<label>添加时间：</label>
				<label style="width:240px;"><?php echo (date("Y-m-d",$mt["addtime"])); ?></label>
			</p>
			<p><label>影片分类：</label>
				<label style="width:240px;">
					<?php if(is_array($mt['type'])): $i = 0; $__LIST__ = $mt['type'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span style="width:80px; float:left; padding:5px 0; "><?php echo ($vo['typename']); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
				</label>
			</p>	
		</div>
		<div class="formBar">
			<ul>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">确定</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>