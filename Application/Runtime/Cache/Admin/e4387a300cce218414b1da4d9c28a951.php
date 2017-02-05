<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/Movie/showActors" method="post">
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
						<label>搜索演员：</label>
						<input type="text" name="keywords"/>
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
	<table class="list" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="116">
		<thead>
			<tr>
				<th>ID</th>
				<th>演员</th>
				<th>演员名</th>
				<th>翻译名</th>
				<th>性别</th>	
				<th>星座</th>
				<th>出生日期</th>			
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td>
					<img src="/LanceLot/Uploads/Actor/Photo/s_<?php echo ($vo["picname"]); ?>" />
				</td>
				<td><?php echo ($vo["cname"]); ?></td>
				<td><?php echo ($vo["ename"]); ?></td>
				<td>
					<?php if($vo["sex"] == 1): ?>男
					<?php else: ?>女<?php endif; ?>
				</td>
				<td><?php echo ($vo["constellation"]); ?></td>
				<td><?php echo (date("Y-m-d",$vo["birthday"])); ?></td>	
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
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
               <?php if($numPerPage == 30): ?><option value="30" selected>30</option>
               <?php else: ?>
               <option value="30">30</option><?php endif; ?>
            </select>
            <span>共<?php echo ($totalCount); ?>条</span>
		</div>
		
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>

	</div>
</div>