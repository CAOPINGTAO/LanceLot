<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/Longreview/listreply/id/<?php echo ($lid); ?>" method="post">
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
</form>

<div class="pageContent">

	<table class="table" width="100%" layoutH="55">
		<thead>
			<tr>
				<?php if($_REQUEST['_order']== 'id'): ?><th width="20" orderField="id" class="<?php echo ($_REQUEST['_sort']); ?>">ID</th>
				<?php else: ?>
				<th width="20" orderField="id">ID</th><?php endif; ?>
				<th width="100">回复内容</th>
				<?php if($_REQUEST['_order']== 'rtime'): ?><th width="20" orderField="rtime" class="<?php echo ($_REQUEST['_sort']); ?>">回复时间</th>
				<?php else: ?>
				<th width="20" orderField="rtime">回复时间</th><?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr target="item_id" rel="<?php echo ($v["id"]); ?>">
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["content"]); ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$v["rtime"])); ?></td>
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