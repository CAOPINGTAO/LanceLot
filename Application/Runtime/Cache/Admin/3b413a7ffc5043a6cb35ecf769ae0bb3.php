<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/Node/index" method="post">
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):"1"); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>" />
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						<label>搜索节点：</label>
						<input type="text" name="keyword" value="<?php echo ($_POST['keyword']); ?>" />[关键词：节点、节点名称]
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
			<li><a class="add" href="/LanceLot/admin.php/Node/add" target="dialog" width="480" height="270" rel="user_msg" title="添加应用"><span>添加应用</span></a></li>

			<li class="line">line</li>
			<li><a class="delete" href="/LanceLot/admin.php/Node/delete/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id{Think.RDELIM}/navTabId/listnode" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Node/edit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" width="480" height="270" target="dialog"><span>修改</span></a></li>

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
				<?php if($_REQUEST['_order']== 'name'): ?><th orderField="name" class="<?php echo ($_REQUEST['_sort']); ?>">节点</th>
				<?php else: ?>
				<th orderField="name">节点</th><?php endif; ?>
				<th>节点名称</th>
				<th>节点描述</th>
				<?php if($_REQUEST['_order']== 'status'): ?><th orderField="status" class="<?php echo ($_REQUEST['_sort']); ?>">开启状态</th>
				<?php else: ?>
				<th orderField="status">开启状态 </th><?php endif; ?>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo ($vo["title"]); ?></td>
				<td><?php echo ($vo["remark"]); ?></td>
				<?php if($vo['status']): ?><td>开启</td>
				<?php else: ?>
				<td>禁用</td><?php endif; ?>
				<td>
					<?php if($vo['level'] == 1): ?><a style="color:blue;" target="dialog" href="/LanceLot/admin.php/Node/add/pid/<?php echo ($vo["id"]); ?>/level/2">添加控制器</a>
					<?php elseif($vo['level'] == 2): ?>
					<a style="color:blue;" target="dialog" href="/LanceLot/admin.php/Node/add/pid/<?php echo ($vo["id"]); ?>/level/3">添加方法</a>
					<?php else: ?>
					 方法：<?php echo ($vo["remark"]); endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	</div>

	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak(<?php echo (C("TMPL_L_DELIM")); ?>numPerPage:this.value<?php echo (C("TMPL_R_DELIM")); ?>)">
				<?php if($numPerPage == 10): ?><option value="10" selected>10</option>
				<?php else: ?>
				<option value="10">10</option><?php endif; ?>
				<?php if($numPerPage == 15): ?><option value="15" selected>15</option>
				<?php else: ?>
				<option value="15">15</option><?php endif; ?>
				<?php if($numPerPage == 20): ?><option value="20" selected>20</option>
				<?php else: ?>
				<option value="20">20</option><?php endif; ?>
				<?php if($numPerPage == 25): ?><option value="25" selected>25</option>
				<?php else: ?>
				<option value="25">25</option><?php endif; ?>
				<?php if($numPerPage == 50): ?><option value="50" selected>50</option>
				<?php else: ?>
				<option value="50">50</option><?php endif; ?>
			</select>
            <span>共<?php echo ($totalCount); ?>条</span>
		</div>

		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumshow="10" currentPage="<?php echo ($currentPage); ?>">
	</div>
</div>