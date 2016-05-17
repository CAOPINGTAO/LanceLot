<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/Movie/index" method="post">
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
						<label>搜索电影：</label>
						<input type="text" name="keyword" value="<?php echo ($_REQUEST['keyword']); ?>" />[关键字：影片名，影片别名]
					</td>
					<td>
						<select class="combox" name="status">
							<option value="">--影片状态--</option>
							<option value="0">新添加</option>
							<option value="1">显示</option>
							<option value="2">幻灯片</option>
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
			<li><a class="add" href="/LanceLot/admin.php/Movie/add" target="navTab" rel="user_msg" title="添加影片"><span>添加影片</span></a></li>

			<li class="line">line</li>
			<li><a class="delete" href="/LanceLot/admin.php/Movie/delete/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Movie/edit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="navTab"><span>修改</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Movie/setmtype/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog"><span>设置分类</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Movie/edittype/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog"><span>修改分类</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Movie/uploads/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog"><span>上传剧照</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Movie/editUploads/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog"><span>修改剧照</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Movie/setActors/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog"><span>设置演员信息</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Movie/editactors/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog"><span>修改演员信息</span></a></li>

			<li class="line">line</li>
			<li><a class="edit" href="/LanceLot/admin.php/Movie/editstatus/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="dialog"><span>修改状态</span></a></li>

			<li class="line">line</li>
			<li><a class="icon" href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>

	<div id="w_list_print">
		<table class="list" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="116">
			<thead>
				<tr>
					<?php if($_REQUEST['_order']== 'id'): ?><th orderField="id" class="<?php echo ($_REQUEST['_sort']); ?>">ID</th>
					<?php else: ?>
					<th orderField="id">ID</th><?php endif; ?>
					<th>影片封面</th>
					<?php if($_REQUEST['_order']== 'filmname'): ?><th orderField="filmname" class="<?php echo ($_REQUEST['_sort']); ?>">影片名</th>
					<?php else: ?>
					<th orderField="filmname">影片名</th><?php endif; ?>
					<th>影片别名</th>
					<th>导演</th>
					<th>编剧</th>
					<?php if($_REQUEST['_order']== 'nation'): ?><th orderField="nation" class="<?php echo ($_REQUEST['_sort']); ?>">制片国家/地区</th>
					<?php else: ?>
					<th orderField="nation">制片国家/地区</th><?php endif; ?>
					<th>语言</th>

					<?php if($_REQUEST['_order']== 'showtime'): ?><th orderField="showtime" class="<?php echo ($_REQUEST['_sort']); ?>">上映时间</th>
					<?php else: ?>
					<th orderField="showtime">上映时间</th><?php endif; ?>
					<?php if($_REQUEST['_order']== 'addtime'): ?><th orderField="addtime" class="<?php echo ($_REQUEST['_sort']); ?>">添加时间</th>
					<?php else: ?>
					<th orderField="addtime">添加时间</th><?php endif; ?>
					<?php if($_REQUEST['_order']== 'minutes'): ?><th orderField="minutes" class="<?php echo ($_REQUEST['_sort']); ?>">片长</th>
					<?php else: ?>
					<th orderField="minutes">片长</th><?php endif; ?>
					<th>影片简介</th>
					<?php if($_REQUEST['_order']== 'status'): ?><th orderField="status" class="<?php echo ($_REQUEST['_sort']); ?>">状态</th>
					<?php else: ?>
					<th orderField="status">状态</th><?php endif; ?>
					<th>设置演员信息</th>
					<th>上传剧照</th>
					<th>影片分类</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
						<td><?php echo ($vo["id"]); ?></td>
						<td>
							<img src="/LanceLot/Uploads/Movie/Cover/a_<?php echo ($vo["picname"]); ?>" />
						</td>
						<td><?php echo ($vo["filmname"]); ?></td>
						<td><?php echo ($vo["petname"]); ?></td>
						<td><?php echo ($vo["director"]); ?></td>
						<td><?php echo ($vo["editor"]); ?></td>
						<td><?php echo ($vo["nation"]); ?></td>
						<td><?php echo ($vo["language"]); ?></td>
						<td><?php echo (date("Y-m-d",$vo["showtime"])); ?></td>
						<td><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td>
						<td><?php echo ($vo["minutes"]); ?></td>
						<td><a style="color:blue;" href="/LanceLot/admin.php/Movie/content/id/<?php echo ($vo["id"]); ?>" target="dialog" width="600" height="480" rel="listmovie" title="查看简介">查看简介</a></td>
						<td>
							<?php if($vo["status"] == 0): ?>新添加
							<?php elseif($vo["status"] == 1): ?>显示
							<?php else: ?>幻灯片<?php endif; ?>
						</td>
						<td>
							<a style="color:blue;" target="dialog" rel="setActors" href="/LanceLot/admin.php/Movie/showActors/id/<?php echo ($vo["id"]); ?>">查看演员信息</a>
						</td>
						<td>
							<a style="color:blue;" target="dialog" rel="showPhotos" href="/LanceLot/admin.php/Movie/showPhotos/id/<?php echo ($vo["id"]); ?>">查看剧照信息</a>
						</td>
						<td>
							<a style="color;blue;" target="dialog" rel="showMType" href="/LanceLot/admin.php/Movie/showType/id/<?php echo ($vo["id"]); ?>">查看分类信息</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
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