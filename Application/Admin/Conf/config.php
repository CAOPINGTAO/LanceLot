<?php
return array(
	//'配置项'=>'配置值'
    //日志路径
    "LOG_PATH"      =>  '/var/log/',

    // RBAC配置
    'RBAC_SUPERADMIN'  => 'admin',       // 超级管理员
    'ADMIN_AUTH_KEY'   => 'superadmin',  // 超级管理员识别

    'USER_AUTH_MODULE' => 'Auser',       // 用户表名称
    'USER_AUTH_ON'     => true,          // 是否开启权限认证
    'USER_AUTH_TYPE'   => 1,             // 验证类型（1：登录验证，2：实时验证）
    'USER_AUTH_KEY'    => 'uid',         // 用户认证识别号
    'NOT_AUTH_MODULE'  => 'Index',       // 无需认证的模块（控制器）
    'NOT_AUTH_ACTION'  => 'index,insert,update,updatestatus,insertpic,doupload,insertletter',       // 无需认证的方法
    'RBAC_ROLE_TABLE'  => 'll_role',     // 角色表名称
    'RBAC_USER_TABLE'  => 'll_role_user',// 角色与用户中间表
    'RBAC_ACCESS_TABLE'=> 'll_access',   // 权限表名称
    'RBAC_NODE_TABLE'  => 'll_node',     // 节点表名称

    //自动跳转页面
    'TMPL_ACTION_SUCCESS'   =>  'Public:jump',
    'TMPL_ACTION_ERROR'     =>  'Public:jump',

    //分页配置
    'NUM_PER_PAGE'  =>  '10', //每页默认显示的数量
);