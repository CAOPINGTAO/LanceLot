<?php
return array(
	//'配置项'=>'配置值'

    //播放器路径
    "VIDEO_PLAY_PATH"   =>  "http://localhost:8080__ROOT__",

    //登录用户常量配置
	"USER_AUTH_KEY"			=>"loginuser",

	//自定义跳转页面
	'TMPL_ACTION_SUCCESS' => 'Public:jump',
	'TMPL_ACTION_ERROR' => 'Public:jump',

    //分页数量
    "PAGE_COUNT_ONE"    => 10,
    "PAGE_COUNT_TWO"    => 0,
    'NUM_PER_PAGE'  	=>  '10', //每页默认显示的数量
);