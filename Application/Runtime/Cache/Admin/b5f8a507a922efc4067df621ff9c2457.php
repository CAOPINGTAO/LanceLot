<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	#mpic img {
		border:1px solid #ccc;
		padding: 3px;
		margin: 5px;
	}
</style>

<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Actors/navTabId/listmovie/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<div id="mpic">
				<ul>
					<?php if(is_array($pic)): foreach($pic as $key=>$vo): ?><li style="float:left">
							<img src="/LanceLot/Uploads/Actor/Photos/m_<?php echo ($vo["picname"]); ?>" />	
						</li><?php endforeach; endif; ?>
				</ul>
			</div>	
			
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