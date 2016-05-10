<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/Type/index" method="post">
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
</form>

<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						<label>搜索节点：</label>
						<input type="text" name="keyword" value="<?php echo ($_POST['keyword']); ?>"/>[关键字：类型名]
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
			<li><a class="add" href="/LanceLot/admin.php/Type/add" target="dialog" rel="user_msg" width="480" height="270" title="添加类型"><span>添加类型</span></a></li>

			<li class="line">line</li>
			<li><a class="delete" href="/LanceLot/admin.php/Type/delete/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listtype" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Type/edit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="480" height="270" target="dialog"><span>修改</span></a></li>

			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>

	<div id="w_list_print">
	<table class="table" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="116">
		<thead>
			<tr>
				<?php if($_REQUEST['_order']== 'id'): ?><th width="60" orderField="id" class="<?php echo ($_REQUEST['_sort']); ?>">ID</th>
				<?php else: ?>
				<th width="60" orderField="id">ID</th><?php endif; ?>
				<th width="120">所属类别</th>
				<?php if($_REQUEST['_order']== 'typename'): ?><th width="120" orderField="typename" class="<?php echo ($_REQUEST['_sort']); ?>">类 型 名</th>
				<?php else: ?>
				<th width="120" orderField="typename">类 型 名</th><?php endif; ?>
				<?php if($_REQUEST['_order']== 'clicknum'): ?><th width="120" orderField="clicknum" class="<?php echo ($_REQUEST['_sort']); ?>">点击次数</th>
				<?php else: ?>
				<th width="120" orderField="clicknum">点击次数</th><?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td>
					<?php if($vo["fid"] == 1): ?>类型
					<?php elseif($vo["fid"] == 2): ?>国家/地区
					<?php else: ?>年代<?php endif; ?>	
				</td>
				<td><?php echo ($vo["typename"]); ?></td>
				<td><?php echo ($vo["clicknum"]); ?></td>	
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	</div>
	
	<div class="panelBar" >
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
		
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>

	</div>
	
</div>