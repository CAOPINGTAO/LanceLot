<?php if (!defined('THINK_PATH')) exit();?><form id="pageForm" action="/LanceLot/admin.php/Role/index" method="post">
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>" />
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>" />
</form>

<div class="pageHeader">
	<form rel="pageForm" obsubmit="return navTabSearch(this);" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						<label>搜索角色：</label>
						<input type="text" name="keyword" value="<?php echo ($_POST['keyword']); ?>" />[关键字：角色、角色名称]
					</td>
					<td>
						<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
					</td>
				</tr>
			</table>
		</div>
	</form>
</div>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/LanceLot/admin.php/Role/add" target="dialog" width="480" height="270" rel="user_msg" title="添加角色"><span>添加角色</span></a></li>

			<li class="line">line</li>
			<li><a class="delete" href="/LanceLot/admin.php/Role/delete/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listrole" target="ajaxTodo" title="确定要删除吗?"><span>删除角色</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Role/edit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" width="480" height="270" target="dialog" title="修改角色"><span>修改角色</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" height="480" width="800" title="配置权限信息" max="true" target="dialog" href="/LanceLot/admin.php/Role/access/rid/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"><span>配置权限</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" height="480" width="800" title="查看权限信息" target="dialog" href="/LanceLot/admin.php/Role/showAccess/rid/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"><span>查看权限信息</span></a></li>

			<li class="line">line</li>
			<li><a class="icon" href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>

	<div id="w_list_print">
	<table class="table" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="116">
		<thead>
			<tr>
				<?php if($_REQUEST['_order']== 'id'): ?><th orderField="id" class="<?php echo ($_REQUEST['_sort']); ?>">ID</th>
				<?php else: ?>
				<th orderField="id">ID</th><?php endif; ?>
				<?php if($_REQUEST['_order']== 'name'): ?><th orderField="name" class="<?php echo ($_REQUEST['_sort']); ?>">角色</th>
				<?php else: ?>
				<th orderField="name">角色</th><?php endif; ?>
				<th>角色名称</th>
				<th>角色描述</th>
				<?php if($_REQUEST['_order']== 'status'): ?><th orderField="status" class="<?php echo ($_REQUEST['_sort']); ?>">开启状态</th>
				<?php else: ?>
				<th orderField="status">开启状态</th><?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo ($vo["title"]); ?></td>
				<td><?php echo ($vo["remark"]); ?></td>
				<td>
					<?php if($vo['status']): ?>开启
					<?php else: ?>禁用<?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	</div>

	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak(<?php echo (C("TMPL_L_DELIM")); ?>numperPage:this.value<?php echo (C("TMPL_R_DELIM")); ?>)">
				<?php switch($numPerPage): case "10": ?><option value="10">10</option><?php break;?>
					<?php case "15": ?><option value="15">15</option><?php break;?>
					<?php case "20": ?><option value="20">20</option><?php break;?>
					<?php case "25": ?><option value="25">25</option><?php break;?>
					<?php case "50": ?><option value="50">50</option><?php break; endswitch;?>
			</select>
			<span>共<?php echo ($totalCount); ?>条</span>
		</div>

		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShow="10" currentPage="<?php echo ($currentPage); ?>"></div>
	</div>
</div>