<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/LanceLot/admin.php/Auser/index" method="post">
    <input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
    <input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>" />
    <input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>" />
</form>


<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="/LanceLot/admin.php/Auser/index2" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        <label style="width:60px;">搜索用户：</label>
                        <input type="text" name="keyword" value="<?php echo ($_POST['keyword']); ?>" /> [关键字：用户名、姓名]
                    </td>
                    <td>
                        <label style="width:60px;">状 态：</label>
                        <select name="status" class="required combox">
                            <option value="">请选择</option>
                            <option value="0" selected>开启</option>
                            <option value="1">禁用</option>
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
            <li><a class="add" href="/LanceLot/admin.php/Auser/add" target="dialog"width="480" height="360" rel="user_msg" title="添加用户信息"><span>添加用户</span></a></li>

            <li class="line">line</li>
            <li><a class="delete" href="/LanceLot/admin.php/Auser/delete/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listuser" target="ajaxTodo" title="确定要删除吗?"><span>删除用户</span></a></li>

            <li class="line">line</li>
            <li><a class="edit" href="/LanceLot/admin.php/Auser/edit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" width="480" height="360" target="dialog"><span>修改用户信息</span></a></li>

            <li class="line">line</li>
            <li><a class="add" href="/LanceLot/admin.php/Auser/setRole/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" width="480" height="360" target="dialog"><span>分配角色</span></a></li>

            <li class="line">line</li>
            <li><a class="icon" href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
        </ul>
    </div>

    <div id="w_list_print">
        <table class="list" width="100%" targetType="navTab" layoutH="116">
            <thead>
                <tr>
                    <?php if($_REQUEST['_order']== 'id'): ?><th orderField="id" class="<?php echo ($_REQUEST['_sort']); ?>">ID</th>
                    <?php else: ?>
                    <th orderField="id">ID</th><?php endif; ?>
                    <th>用户名</th>
                    <th>姓名</th>
                    <th>Email</th>
                    <th>电话</th>
                    <th>登录时间</th>
                    <th>登录IP</th>
                    <?php if($_REQUEST['_order']== 'status'): ?><th orderField="status" class="<?php echo ($_REQUEST['_sort']); ?>">状态</th>
                    <?php else: ?>
                    <th orderField="status">状态</th><?php endif; ?>
                    <th>用户所属组</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["username"]); ?></td>
                    <td><?php echo ($vo["fullname"]); ?></td>
                    <td><?php echo ($vo["email"]); ?></td>
                    <td><?php echo ($vo["phone"]); ?></td>
                    <td><?php echo (date("Y-m-d H:i:s",$vo["login_time"])); ?></td>
                    <td><?php echo ($vo["login_ip"]); ?></td>
                    <?php if($vo["status"] == 0): ?><td>开启</td>
                    <?php else: ?>
                    <td>禁用</td><?php endif; ?>
                    <td>
                        <ul>
                            <?php if($vo['username'] == C('RBAC_SUPERADMIN')): ?>超级管理员
                            <?php else: ?>
                            <?php if(is_array($vo['role'])): $i = 0; $__LIST__ = $vo['role'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li style="padding: 3px;"><?php echo ($v["name"]); ?> [ <?php echo ($v["title"]); ?> ]</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </ul>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>

    <!-- 分页显示 -->
    <div class="panelBar">
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak(<?php echo (C("TMPL_L_DELIM")); ?>numPerPage:this.value<?php echo (C("TMPL_R_DELIM")); ?>)">
                <?php switch($numPerPage): case "10": ?><option value="10">10</option><?php break;?>
                    <?php case "15": ?><option value="15">15</option><?php break;?>
                    <case>
                        <option value="20">20</option>
                    </case>
                    <case>
                        <option value="25">25</option>
                    </case>
                    <case>
                        <option value="30">30</option>
                    </case><?php endswitch;?> 
            </select>
            <span>共<?php echo ($totalCount); ?>条</span>
        </div> 

        <div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumshow="10" currentPage="<?php echo ($currentPage); ?>">
    </div>
</div>