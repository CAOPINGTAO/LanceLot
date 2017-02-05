<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/Shortreview/index" method="post">
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
					<b>搜索</b> &nbsp; 关键字：<input type="text" name="keyword" value="<?php echo ($_REQUEST['keyword']); ?>" /> [内容]
				</td>
				<td>&nbsp; 状态：
					<select name="status" >
						<option value="" >-选择-</option>
						<?php if($_REQUEST['status']== 1): ?><option value="1" selected>正常</option>
						<option value="2">举报</option>
						<option value="3">禁言</option>
						<?php elseif($_REQUEST['status']== 2): ?>
						<option value="1">正常</option>
						<option value="2" selected>举报</option>
						<option value="3">禁言</option>
						<?php elseif($_REQUEST['status']== 3): ?>
						<option value="1">正常</option>
						<option value="2">举报</option>
						<option value="3" selected>禁言</option>
						<?php else: ?>
						<option value="1">正常</option>
						<option value="2">举报</option>
						<option value="3">禁言</option><?php endif; ?>
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
			<li><a class="delete" href="/LanceLot/admin.php/Shortreview/delete/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listsreview" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Shortreview/edit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="830" height="350" target="dialog"><span>修改状态</span></a></li>
			
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<?php if($_REQUEST['_order']== 'id'): ?><th width="40" orderField="id" class="<?php echo ($_REQUEST['_sort']); ?>">ID</th>
				<?php else: ?>
				<th width="40" orderField="id">ID</th><?php endif; ?>
				<th width="40">影片</th>
				<th width="40">发表用户</th>
				<?php if($_REQUEST['_order']== 'rtime'): ?><th width="40" orderField="rtime" class="<?php echo ($_REQUEST['_sort']); ?>">评论时间</th>
				<?php else: ?>
				<th width="40" orderField="rtime">评论时间</th><?php endif; ?>
				<th width="30" style="color:red;">举报数</th>
				<?php if($_REQUEST['_order']== 'status'): ?><th width="40" orderField="status" class="<?php echo ($_REQUEST['_sort']); ?>">评论状态</th>
				<?php else: ?>
				<th width="40" orderField="status">评论状态</th><?php endif; ?>
				<th width="40">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr target="item_id" rel="<?php echo ($v["id"]); ?>">
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["filmname"]); ?></td>
				<td><?php echo ($v["username"]); ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$v["rtime"])); ?></td>
				<?php if(empty($v['report'])): ?><td style="color:#666;">0</td>
				<?php else: ?>
					<td style="color:red;"><?php echo ($v["report"]); ?></td><?php endif; ?>
				<?php if($v["status"] == '正常'): ?><td style="color:blue;"><?php echo ($v["status"]); ?></td>
				<?php elseif($v["status"] == '举报'): ?>
				<td style="color:red;"><?php echo ($v["status"]); ?></td>
				<?php else: ?>
				<td style="color:#666;"><?php echo ($v["status"]); ?></td><?php endif; ?>
				<td><a style="color:green;"href="/LanceLot/admin.php/Shortreview/content/id/<?php echo ($v["id"]); ?>" target="dialog">查看回复内容</a></td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	
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