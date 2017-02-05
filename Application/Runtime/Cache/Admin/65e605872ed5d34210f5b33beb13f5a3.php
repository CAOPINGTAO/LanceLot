<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/User/index" method="post">
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
					<b>搜索</b> &nbsp; 关键字：<input type="text" name="keyword" value="<?php echo ($_REQUEST['keyword']); ?>" /> [ 账号,真实姓名 ]
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
			<li><a class="icon" href="/LanceLot/admin.php/User/detail/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  height="480" width="800" max="true" target="dialog"><span>详细</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<?php if($_REQUEST['_order']== 'id'): ?><th width="40" orderField="id"class="<?php echo ($_REQUEST['_sort']); ?>">ID</th>
				<?php else: ?>
				<th width="40" orderField="id">ID</th><?php endif; ?>
				<th width="40">账号</th>
				<th width="40">真实姓名</th>
				<th width="40">性别</th>
				<th width="40">级别</th>
				<?php if($_REQUEST['_order']== 'addtime'): ?><th width="40" orderField="addtime" class="<?php echo ($_REQUEST['_sort']); ?>">注册时间</th>
				<?php else: ?>
				<th width="40" orderField="addtime">注册时间</th><?php endif; ?>
				<?php if($_REQUEST['_order']== 'logtimes'): ?><th width="40" orderField="logtimes" class="<?php echo ($_REQUEST['_sort']); ?>">登录次数</th>
				<?php else: ?>
				<th width="40" orderField="logtimes">登录次数</th><?php endif; ?>
				<?php if($_REQUEST['_order']== 'lastlog'): ?><th width="40" orderField="lastlog" class="<?php echo ($_REQUEST['_sort']); ?>">最后登陆</th>
				<?php else: ?>
				<th width="40" orderField="lastlog">最后登陆</th><?php endif; ?>
				<th width="40">状态</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["username"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td>
					<?php if($vo["sex"] == 1): ?>男
					<?php else: ?>女<?php endif; ?>
				</td>
				<td><?php echo ($vo["level"]); ?></td>
				<td><?php echo (date("Y-m-d H:i",$vo["addtime"])); ?></td>
				<td><?php echo ($vo["logtimes"]); ?></td>
				<td><?php echo (date("Y-m-d H:i",$vo["lastlog"])); ?></td>
				<td>
					<?php if($vo["disable"] != 0): ?>禁言
					<?php else: ?>正常<?php endif; ?> 
				</td>
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