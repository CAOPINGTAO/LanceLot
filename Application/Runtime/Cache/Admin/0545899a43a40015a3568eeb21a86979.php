<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">

	<form method="post" enctype="multipart/form-data" action="/LanceLot/admin.php/Actors/update/navTabId/listactor/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return iframeCallback(this, navTabAjaxDone);">

		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
		<input type="hidden" name="ppicname" value="<?php echo ($vo["picname"]); ?>" />

		<div class="pageFormContent" layoutH="56">
			<p>
				<label>中 文 名：</label>
				<input name="cname" class="required" type="text" size="30" value="<?php echo ($vo["cname"]); ?>" alt=""/>
			</p>
			<p>
				<label>英 文 名：</label>
				<input name="ename" class="required" type="text" size="30" value="<?php echo ($vo["ename"]); ?>" alt=""/>
			</p>
			
			<p>
				<label>性 别：</label>
				<?php if($vo['sex'] == 1): ?><input type="radio" value="1" name="sex" checked />男
				<input type="radio" value="0" name="sex" />女
				<?php else: ?>
				<input type="radio" value="1" name="sex" />男
				<input type="radio" value="0" name="sex" checked />女<?php endif; ?>
			</p>
			<p>
				<label>星座：</label>
				<select name="constellation" class="required combox" size="30">
					<option value="" selected>- - 请选择 - -</option>
					<?php if($vo["constellation"] == '白羊座'): ?><option value="白羊座" selected>白羊座</option>
					<?php else: ?>
					<option value="白羊座">白羊座</option><?php endif; ?>
					<?php if($vo["constellation"] == '金牛座'): ?><option value="金牛座" selected>金牛座</option>
					<?php else: ?>
					<option value="金牛座">金牛座</option><?php endif; ?>
					<?php if($vo["constellation"] == '双子座'): ?><option value="双子座" selected>双子座</option>
					<?php else: ?>
					<option value="双子座">双子座</option><?php endif; ?>
					<?php if($vo["constellation"] == '巨蟹座'): ?><option value="巨蟹座" selected>巨蟹座</option>
					<?php else: ?>
					<option value="巨蟹座">巨蟹座</option><?php endif; ?>
					<?php if($vo["constellation"] == '狮子座'): ?><option value="狮子座" selected>狮子座</option>
					<?php else: ?>
					<option value="狮子座">狮子座</option><?php endif; ?>
					<?php if($vo["constellation"] == '处女座'): ?><option value="处女座" selected>处女座</option>
					<?php else: ?>
					<option value="处女座">处女座</option><?php endif; ?>
					<?php if($vo["constellation"] == '天秤座'): ?><option value="天秤座" selected>天秤座</option>
					<?php else: ?>
					<option value="天秤座">天秤座</option><?php endif; ?>
					<?php if($vo["constellation"] == '天蝎座'): ?><option value="天蝎座" selected>天蝎座</option>
					<?php else: ?>
					<option value="天蝎座">天蝎座</option><?php endif; ?>
					<?php if($vo["constellation"] == '射手座'): ?><option value="射手座" selected>射手座</option>
					<?php else: ?>
					<option value="射手座">射手座</option><?php endif; ?>
					<?php if($vo["constellation"] == '魔蝎座'): ?><option value="魔蝎座" selected>魔蝎座</option>
					<?php else: ?>
					<option value="魔蝎座">魔蝎座</option><?php endif; ?>
					<?php if($vo["constellation"] == '水瓶座'): ?><option value="水瓶座" selected>水瓶座</option>
					<?php else: ?>
					<option value="水瓶座">水瓶座</option><?php endif; ?>
					<?php if($vo["constellation"] == '双鱼座'): ?><option value="双鱼座" selected>双鱼座</option>
					<?php else: ?>
					<option value="双鱼座">双鱼座</option><?php endif; ?>
				</select>
			</p>
			<p>
				<label>出生日期：</label>
				<input type="text" name="birthday" class="date" size="30" value="<?php echo (date('Y-m-d',$vo["birthday"])); ?>" /><a class="inputDateButton" href="javascript:;">选择</a>
			</p>
			<p>
				<label>出 生 地：</label>
				<input name="bornaddress" type="text" size="30" class="required" value="<?php echo ($vo["bornaddress"]); ?>" />
			</p>
			
			<p>
				<label>职 业：</label>
				<input name="professtion" type="text" size="30" class="required" value="<?php echo ($vo["professtion"]); ?>" />
			</p>

			<p>
				<label>演员头像：</label>
				<input type="file" name="picname" />
			</p>
			<div class="divider"></div>
			<p>
				<label>演员简介</label>
				<textarea class="editor" name="intro" rows="6" cols="100" tools="simple"><?php echo ($vo["intro"]); ?></textarea>
			<p>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>