<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	.pageFormContent p{
		width: 500px;
	}
	.pageFormContent label {
    float: left;
    line-height: 21px;
    padding: 0 5px;
    width: 60px;
	}
	#tag{
		border:1px solid #ccc;
		height: 21px;
		line-height: 21px;
		margin-left: 10px;
		padding: 5px;
		display: none;
	}
	.haserror {
		color: red;
		font-style: italic;
		background-color: #ccffcc;
	}
	.done {
		color: green;
		font-style: normal;
		border: 1px solid #ccc;
	}
</style>

<script type="text/javascript">
	$(function(){

		var movid = $("#aname").attr('movid');

		$("#addActor").click(function(){

			$("#aname").trigger('focus').val("");
			$("#tag").hide();
		});

		// 文本框获得焦点事件
		$("#aname").focus(function(){
			$("#tag").removeClass('haserror done').show().html("请输入演员名");
		});

		$("#aname").blur(function(){
			// 是否为空
			var actname = $("#aname").val();

			if (actname.length == 0) {
				$("#tag").show().addClass("haserror").html("不能为空！");
			}else{
				// 异步请求
				$.ajax({
					url : "http://localhost:8080/LanceLot/admin.php/Movie/setActorsHandle",
					detaType : "text",
					type : "post",
					data : { id : movid,
							 name : actname	
						},
					success : function(data){
						if (data == "true") {

							$("#tag").show().addClass("ok").html("已成功设置一名演员");
						} else {
							$("#tag").show().addClass("haserror").html(data);
						}
					}
				})
			}
		})
	});
</script>
<div class="pageContent">
	<form method="post" action="/LanceLot/admin.php/Movie/setActorsHandle/navTabId/listactor/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div  class="pageFormContent" layoutH="56">
			<input type="button" id="addActor" value="添加演员" />
			<div class="divider"></div>
			<div id="form">
				<p>
					<label>演 员 名：</label>
					<input id="aname" type="text" size="30" value="" movid="<?php echo ($movid); ?>" />
					<span id="tag"></span>	
				</p>
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