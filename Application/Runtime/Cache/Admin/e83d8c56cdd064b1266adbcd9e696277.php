<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	#mpic img {
		border:1px solid #ccc;
		padding: 3px;
		margin: 5px;
	}
</style>

<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Movie/navTabId/listmovie/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<div id="mpic">
				<ul>
					<?php if(is_array($pic)): $i = 0; $__LIST__ = $pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="float:left">
							<img src="/LanceLot/Uploads/Movie/mPhotos/m_<?php echo ($vo["picname"]); ?>" />	
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
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