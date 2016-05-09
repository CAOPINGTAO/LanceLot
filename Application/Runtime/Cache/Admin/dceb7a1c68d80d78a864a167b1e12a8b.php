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
		width: 120px;
		height:18px;
		line-height: 18px;
		margin: 3px 3px 3px 15px;
		background-color: #ccffcc;
	}

</style>

<div class="pageContent" layoutH="42">

	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$app): $mod = ($i % 2 );++$i;?><fieldset style="border:1px solid #D8D0D6;margin:5px;paddng:5px;" class="app">
    	<legend style="border:1px solid #B8D0D6; padding:5px;"><?php echo ($app["title"]); ?> [<a style="color:blue;" target="dialog" href="/LanceLot/admin.php/Node/addNode/pid/<?php echo ($app["id"]); ?>/level/2"> 添加控制器 </a>]
    	</legend>
    	<?php if(is_array($app['child'])): $i = 0; $__LIST__ = $app['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?><div class="com">
    		<?php echo ($action['title']); ?> [ <a style="color:blue" target="dialog"  href="/LanceLot/admin.php/Node/addNode/pid/<?php echo ($action['id']); ?>/level/3"> 添加方法 </a> ]
    		</div>
    		<div class="mcom">
    		<?php if(is_array($action['child'])): $i = 0; $__LIST__ = $action['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?><span class="method"><?php echo ($method["title"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
    		</div><?php endforeach; endif; else: echo "" ;endif; ?>
    	
  	</fieldset><?php endforeach; endif; else: echo "" ;endif; ?>
	
</div>