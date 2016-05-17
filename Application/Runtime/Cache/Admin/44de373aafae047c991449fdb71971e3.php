<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/User/<?php echo ($type); ?>" method="post">
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
	<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>"/>
</form>

<style>
	.pageFormContent dl{ width:680px}/*表单项宽度*/
	.pageFormContent dl dt{ width:100px;text-align:right;margin-right:5px;font-weight:bold;} /*表单标题加粗 font-weight:bold;*/ 
	 span.error{ left:300px;}/*错误信息浮动位置*/
</style>
<div class="panelBar">
	<ul class="toolBar">
		<li><a class="edit" href="/LanceLot/admin.php/User/addletter/id/<?php echo ($vo["id"]); ?>"  width="550" height="300" target="dialog"><span>站内信</span></a></li>

		<li class="line">line</li>
		<?php if($vo["disable"] != 0): ?><li><a class="icon" href="/LanceLot/admin.php/User/free/id/<?php echo ($vo["id"]); ?>/navTabId/userlist" target="ajaxTodo" title="确定要解禁该用户吗?"><span>解禁</span></a></li>
		<?php else: ?>
		<li><a class="delete" href="/LanceLot/admin.php/User/forbid/id/<?php echo ($vo["id"]); ?>/navTabId/userlist" target="ajaxTodo" title="确定要禁闭该用户吗?"><span>禁闭</span></a></li><?php endif; ?>

		<li class="line">line</li>
		<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		<li class="line">line</li>
	</ul>
</div>

<div class="panel close collapse" defH="210">
	<h1>用户详细信息</h1>
	<div class="pageContent">
		<div class="pageFormContent" layoutH="330">
			<div style="float:left;width:380px;">
				<img style="margin-left:100px;" src="/LanceLot/Uploads/User/Headpic/<?php echo ($vo["headpic"]); ?>" />
			</div>
			
			<p style="border-bottom:1px dashed #ccc;">
				<label>用户id：</label>
				<label><?php echo ($vo["id"]); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>用户账号：</label>
				<label><?php echo ($vo["username"]); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>用户真名：</label>
				<label><?php echo ($vo["name"]); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>用户性别：</label>
				<label><?php if($vo["sex"] == 1): ?>男<?php else: ?>女<?php endif; ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>用户生日：</label>
				<label><?php echo ($vo["birthday"]); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>注册email：</label>
				<label><?php echo ($vo["email"]); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>用户地址：</label>
				<label><?php echo ($vo["address"]); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>用户等级：</label>
				<label><?php echo ($vo["level"]); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>用户积分：</label>
				<label><?php echo ($vo["score"]); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>登陆次数：</label>
				<label><?php echo ($vo["logtimes"]); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>注册时间：</label>
				<label><?php echo (date("Y-m-d H:i",$vo["addtime"])); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>最后登陆：</label>
				<label><?php echo (date("Y-m-d H:i",$vo["lastlog"])); ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label>用户状态</label>
				<label><?php if($vo["disable"] != 0): ?>禁闭<?php else: ?>正常<?php endif; ?></label>
			</p>
		
			<p style="border-bottom:1px dashed #ccc;">
				<label></label>
				<label></label>
			</p>

		</div>
	</div>
</div>
	
<div class="panelBar" style="margin-top:10px;">
	<ul class="toolBar">
		<li style="float:left;"><a class="icon" href="/LanceLot/admin.php/User/checklongreview/id/<?php echo ($vo["id"]); ?>"  width="550" height="300" target="dialog"><span>长评</span></a></li>
		<li class="line" style="float:left;">line</li>
		<li style="float:left;"><a class="icon" href="/LanceLot/admin.php/User/checkshortreview/id/<?php echo ($vo["id"]); ?>"  width="550" height="300" target="dialog"><span>短评</span></a></li>
		<li class="line" style="float:left;">line</li>
		<li style="float:left;"><a class="icon" href="/LanceLot/admin.php/User/checkpmood/id/<?php echo ($vo["id"]); ?>"  width="550" height="300" target="dialog"><span>心情</span></a></li>
		<li class="line"  style="float:left;">line</li>
		<li style="float:left;"><a class="icon" href="/LanceLot/admin.php/User/checkdiary/id/<?php echo ($vo["id"]); ?>"  width="550" height="300" target="dialog"><span>日志</span></a></li>
		<li class="line" style="float:left;">line</li>
		<li style="float:left;"><a class="icon" href="/LanceLot/admin.php/User/checkphotoalbum/id/<?php echo ($vo["id"]); ?>"  width="550" height="300" target="dialog"><span>相册</span></a></li>
		<li class="line"  style="float:left;">line</li>
		<li style="float:left;"><a class="icon" href="/LanceLot/admin.php/User/checkletter/id/<?php echo ($vo["id"]); ?>"  width="550" height="300" target="dialog"><span>站内信</span></a></li>
		<li class="line"  style="float:left;">line</li>
	</ul>
</div>

<div class="pageContent">
	<table class="table" width="100%" layoutH="150">
		<thead>
			<tr>
				<th width="80">内容ID</th>
				<th width="80">内容</th>
				<th width="40">发布时间</th>
				<?php if($type == 'checkletter'): ?><th width="30">状态</th>
				<?php else: ?>
					<th width="30">查看</th><?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr target="item_id" rel="<?php echo ($v["id"]); ?>">
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["title"]); ?></td>
				<td><?php echo (date("Y-m-d  H:i:s",$v["addtime"])); ?></td>
				<?php if($type == 'checklongreview'): ?><td ><a href="/LanceLot/index.php/Review/index/id/<?php echo ($v["id"]); ?>" target="_blank" style="color:green;" width="700" height="500" >查看</a></td><?php endif; ?>
				<?php if($type == 'checkshortreview'): ?><td ><a href="/LanceLot/index.php/Detail/index/id/<?php echo ($v["fid"]); ?>" target="_blank" style="color:green;" width="700" height="500" >查看</a></td><?php endif; ?>
				<?php if($type == 'checkpmood'): ?><td ><a href="/LanceLot/index.php/Pmood/index/uid/<?php echo ($vo["id"]); ?>" target="_blank" style="color:green;" width="700" height="500" >查看</a></td><?php endif; ?>
				<?php if($type == 'checkdiary'): ?><td ><a href="/LanceLot/index.php/Diary/mydiary/uid/<?php echo ($vo["id"]); ?>/id/<?php echo ($v["id"]); ?>" target="_blank" style="color:green;" width="700" height="500" >查看</a></td><?php endif; ?>
				<?php if($type == 'checkphotoalbum'): ?><td ><a href="/LanceLot/index.php/Uphotoalbum/albumdetail/uid/<?php echo ($vo["id"]); ?>/pid/<?php echo ($v["id"]); ?>" target="_blank" style="color:green;" width="700" height="500" >查看</a></td><?php endif; ?>
				<?php if($type == 'checkletter'): ?><td ><a href="/LanceLot/index.php/User/myletter/uid/<?php echo ($vo["id"]); ?>/lid/<?php echo ($v["id"]); ?>" target="_blank" style="color:green;" width="700" height="500" ><?php if($v["status"] != 0): ?>已查看<?php else: ?>未查看<?php endif; ?></a></td><?php endif; ?>
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