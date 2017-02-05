<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/lancelot/admin.php/Actors/index" method="post">
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
						<input type="text" name="keyword" value="<?php echo ($_POST['keyword']); ?>"/> [关键字：中文名、外文名]
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
			<li><a class="add" href="/lancelot/admin.php/Actors/add" target="dialog" rel="user_msg" title="添加演员"><span>添加演员</span></a></li>

			<li class="line">line</li>			
			<li><a class="delete" href="/lancelot/admin.php/Actors/delete/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listactor" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			
			<li class="line">line</li>			
			<li><a class="edit" href="/lancelot/admin.php/Actors/edit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="480" height="360" target="dialog"><span>修改</span></a></li>

			<li class="line">line</li>
			<li><a class="add" href="/lancelot/admin.php/Actors/addActorImgs/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog" title="添加演员剧照" ><span>添加演员剧照</span></a></li>

			<li class="line">line</li>
			<li><a class="add" href="/lancelot/admin.php/Actors/editActorImgs/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog" title="修改演员剧照" ><span>修改演员剧照</span></a></li>

			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>

	<div id="w_list_print">
	<table class="list" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="116">
		<thead>
			<tr>
				<?php if($_REQUEST['_order']== 'id'): ?><th orderField="id" class="<?php echo ($_REQUEST['_sort']); ?>">ID</th>
				<?php else: ?>
				<th orderField="id">ID</th><?php endif; ?>
				<th>演员头像</th>
				<th>中文名</th>
				<th>外文名</th>
				<th>性别</th>
				<th>星座</th>
				<th>出生日期</th>
				<th>出生地</th>
				<th>职业</th>
				<th>演员简介</th>
				<?php if($_REQUEST['_order']== 'addtime'): ?><th orderField="addtime" class="<?php echo ($_REQUEST['_sort']); ?>">添加时间</th>
				<?php else: ?>
				<th orderField="addtime">添加时间</th><?php endif; ?>
				<th>剧照信息</th>		
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td>
					<img src="/lancelot/Uploads/Actor/Photo/s_<?php echo ($vo["picname"]); ?>" />
				</td>
				<td><?php echo ($vo["cname"]); ?></td>
				<td><?php echo ($vo["ename"]); ?></td>
				<td>
					<?php if($vo["sex"] == 1): ?>男
					<?php else: ?>女<?php endif; ?>
				</td>
				<td><?php echo ($vo["constellation"]); ?></td>
				<td><?php echo (date("Y-m-d",$vo["birthday"])); ?></td>
				<td><?php echo ($vo["bornaddress"]); ?></td>
				<td><?php echo ($vo["professtion"]); ?></td>
				<td><a style="color:blue" href="/lancelot/admin.php/Actors/content/id/<?php echo ($vo["id"]); ?>" target="dialog" width="600" height="480"  rel="listmovie" title="查看简介">
				查看简介</a></td>
				<td><?php echo (date("Y-m-d / H:i:s",$vo["addtime"])); ?></td>
				<td>
					<?php if($vo["num"] > 0): ?><span style="color:red">未上传图片<?php echo ($vo["num"]); ?></span>
					<?php else: ?>
					<a style="color:blue" href="/lancelot/admin.php/Actors/showpics/id/<?php echo ($vo["id"]); ?>" target="dialog" title="查看图片">查看图片 <?php echo ($vo["num"]); ?> </a><?php endif; ?>	
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	</div>
	
	<div class="panelBar" >
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