<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	#mpic img {
		border:1px solid #ccc;
		padding: 3px;
	}
	#mpic .imglist{
		padding: 3px;
		text-align: center;
		float: left;
		height: 135px;
		width: 110px;
		margin: 3px;
		border: 1px solid #ccc;
		background-color: #ccffcc;
	}
	#mpic p{
		width: 110px;
		height: 20px;
		line-height: 20px;
		padding-top: 5px;
	}
	#mpic p a{
		width: 110px;
		height: 20px;
		line-height: 20px;
		padding-top: 5px;
	}

</style>

<script type="text/javascript">
	$(function(){
		$("#mpic .imglist a").click(function(){
			var pid = $(this).attr('mid');

			$.ajax({
				url : "http://localhost:8080/LanceLot/admin.php/Actors/deleteimg",
				detaType : "text",
				type : "post",
				data : { id : pid },
				success : function(data){
					if(data == 'true'){
						$("#mpic"+pid).remove();
					}
				}
			})
		});
	});

</script>

<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Actors/navTabId/listmovie/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">

			<div id="mpic">
				<?php if(is_array($imgs)): foreach($imgs as $key=>$vo): ?><div class="imglist" id="mpic<?php echo ($vo["id"]); ?>">
						<img src="/LanceLot/Uploads/Actor/Photos/m_<?php echo ($vo["picname"]); ?>" />	
						<p><a style="color:blue"  mid="<?php echo ($vo["id"]); ?>" name="<?php echo ($vo["picname"]); ?>">删除</a></p>
					</div><?php endforeach; endif; ?>
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