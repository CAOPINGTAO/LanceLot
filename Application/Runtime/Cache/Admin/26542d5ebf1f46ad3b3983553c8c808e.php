<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/Ppt/index" method="post">
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
</form>

<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						<label>搜索片名：</label>
						<input type="text" name="keyword" value="<?php echo ($_REQUEST['keyword']); ?>" /> 
					</td>
					<td>&nbsp; 状态：
						<select name="state" >
							<option value="" >-选择-</option>
							<?php if($_REQUEST['state']== 1): ?><option value="1" selected>显示</option>
							<?php else: ?>
							<option value="1">显示</option><?php endif; ?>
							<?php if($_REQUEST['state']== 2): ?><option value="2" selected>不显示</option>
							<?php else: ?>
							<option value="2">不显示</option><?php endif; ?>
						</select>
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
			<li class="line">line</li>			
			<li><a class="delete" href="/LanceLot/admin.php/Ppt/del/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li class="line">line</li>			
			<li><a class="edit" href="/LanceLot/admin.php/Ppt/edit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>

	<div id="w_list_print">
	<table class="list" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="90">
		<thead>
			<tr>
				<th width="40">ID</th>
				<th width="40">影片ID</th>
				<th width="150">片名</th>
				<th width="150">幻灯片图片</th>
				<th width="150">状态</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["mid"]); ?></td>
					<td><?php echo ($vo["title"]); ?></td>
					<?php if($vo['picname']): ?><td><img src="/LanceLot/Uploads/News/mypic/c_<?php echo ($vo["picname"]); ?>"/></td>
					<?php else: ?><td><a href="/LanceLot/admin.php/Ppt/add/id/<?php echo ($vo["id"]); ?>" target="dialog">设置图片</a></td><?php endif; ?>
					<?php if($vo["state"] == 1): ?><td>显示</td>
					<?php else: ?>
					<td>不显示</td><?php endif; ?>
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	</div>
	
	<div class="panelBar">
		<div class="pages">
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
               <?php if($numPerPage == 30): ?><option value="30" selected>30</option>
               <?php else: ?>
               <option value="30">30</option><?php endif; ?>
         </select>
            <span>共<?php echo ($totalCount); ?>条</span>
      </div> 

      <div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>
</div>
</div>