//数据表说明
CREATE DATABASE `lancelot`;
use `lancelot`;

+-------------------------------电影信息相关表----------------------------------------------+

/*电影评分表*/
CREATE TABLE `ll_rate`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`fid` int(10) unsigned NOT NULL COMMENT '电影id',
	`uid` int(10) unsigned NOT NULL COMMENT '用户id',
	`score` int(10) unsigned NOT NULL COMMENT '打分数',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;


/*电影信息表*/
CREATE TABLE `ll_movie`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`filmname` varchar(64) NOT NULL COMMENT '影片名',
	`petname` varchar(64) DEFAULT NULL COMMENT '别名',
	`director` varchar(64) NOT NULL COMMENT '导演',
	`editor` varchar(64) NOT NULL COMMENT '编剧',
	`nation` varchar(16) NOT NULL COMMENT '国家、地区',
	`language` varchar(16) NOT NULL COMMENT '语言',
	`showtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上映时间',
	`addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
	`minutes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时长分钟数',
	`content` text NOT NULL COMMENT '剧情介绍',
	`collectnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
	`clicknum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
	`onum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '看过人数',
	`snum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '想看数目',
	`pnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '赞过数目',
	`ratenum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评分人数',
	`rate` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '评分',
	`replynum` int(10) unsigned DEFAULT '0' COMMENT '评论数',
	`status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
	`picname` varchar(64) NOT NULL COMMENT '封面图',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*电影图片表*/
CREATE TABLE `ll_filmpic`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`fid` int(10) unsigned NOT NULL COMMENT '影片id',
	`picname` varchar(64) NOT NULL COMMENT '图片',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;

/*演员信息表*/
CREATE TABLE `ll_actors`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`cname` varchar(32) DEFAULT NULL,
	`ename` varchar(32) DEFAULT NULL COMMENT '艺名',
	`picname` varchar(32) DEFAULT NULL COMMENT '演员头像',
	`sex` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
	`constellation` varchar(16) DEFAULT NULL COMMENT '星座',
	`birthday` varchar(32) DEFAULT NULL,
	`bornaddress` varchar(32) DEFAULT NULL COMMENT '出生地',
	`profession` varchar(32) NOT NULL COMMENT '职业',
	`addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
	`intro` text NOT NULL,
	`hasphotos` int(10) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*演员图片表*/
CREATE TABLE `ll_picactor`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`aid` int(11) NOT NULL COMMENT '演员id',
	`picname` varchar(32) NOT NULL,
	`addtime` int(11) unsigned NOT NULL,
	`adderby` varchar(32) NOT NULL DEFAULT 'Administrator',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

/*电影--演员中间表*/
CREATE TABLE `ll_movie_actor`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`fid` int(10) unsigned NOT NULL COMMENT '影片id',
	`aid` int(10) unsigned NOT NULL COMMENT '演员id',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

/*标签表*/
CREATE TABLE `ll_tag`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`tagname` varchar(16) NOT NULL COMMENT '标签名',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*电影类型表*/
CREATE Table `ll_type`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`fid` int(10) unsigned NOT NULL COMMENT '所属类别',
	`typename` varchar(16) NOT NULL COMMENT '类型名',
	`clicknum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

/*电影--类型中间表*/
CREATE TABLE `ll_movie_type`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`fid` int(10) unsigned NOT NULL COMMENT '影片id',
	`tid` int(10) unsigned NOT NULL COMMENT '类型id',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=236 DEFAULT CHARSET=utf8;

/*电影--标签中间表*/
CREATE TABLE `ll_movie_tag`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`fid` int(10) unsigned NOT NULL COMMENT '影片id',
	`tid` int(10) unsigned NOT NULL COMMENT '标签id',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*演员评论表*/
CREATE TABLE `ll_acomment`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`aid` int(10) unsigned NOT NULL COMMENT '演员id',
	`uid` int(10) unsigned NOT NULL COMMENT '用户id',
	`content` text NOT NULL COMMENT '评论内容',
	`rtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
	`unum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有用数目',
	`status` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '状态 3禁言 1正常 2举报',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*电影长评表*/
CREATE TABLE `ll_longreview`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`fid` int(10) unsigned NOT NULL COMMENT '影片id',
	`uid` int(10) unsigned NOT NULL COMMENT '用户id',
	`title` varchar(32) NOT NULL COMMENT '标题',
	`content` text NOT NULL COMMENT '长评内容',
	`rnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
	`unum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有用数',
	`vnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '无用数',
	`ptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发表时间',
	`status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1正常 2举报 3禁言',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*电影短评论表*/
CREATE TABLE `ll_shortreview`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`fid` int(10) unsigned NOT NULL COMMENT '影片id',
	`uid` int(10) unsigned NOT NULL COMMENT '用户id',
	`content` text NOT NULL COMMENT '短评内容',
	`rtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
	`unum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有用数目',
	`status` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '状态 3禁言 1正常 2举报',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

/*影评--图片中间表*/
CREATE TABLE `ll_reviewpic`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`tbname` varchar(64) NOT NULL COMMENT '表名',
	`rid` int(10) unsigned NOT NULL COMMENT '影评id',
	`picname` varchar(32) NOT NULL COMMENT '影评相关的图片',
	`create_time` int(11) NOT NULL COMMENT '添加时间',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*影评回复表*/
CREATE TABLE `ll_reviewreply`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`rid` int(10) unsigned NOT NULL COMMENT '影评id',
	`uid` int(10) unsigned NOT NULL COMMENT '用户id',
	`content` text NOT NULL COMMENT '影评回复内容',
	`rtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
	`status` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '状态 3禁言 1正常 2举报',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

/*电影台词表*/
CREATE TABLE `ll_dialogue`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`source` varchar(64) DEFAULT NULL COMMENT '电影来源',
	`en_dialogue` text COMMENT '英文台词内容',
	`cn_dialogue` text COMMENT '中文台词内容',
	`addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'addTime',
	`status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '状态显示0新添加 1显示 2不显示',	
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARACTER=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*电影预告片表*/
CREATE TABLE `ll_prevue`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`title` varchar(32) NOT NULL COMMENT '标题',
	`fid` int(10) unsigned DEFAULT '0' COMMENT '电影id',
	`picname` varchar(64) DEFAULT '无' COMMENT '预报片封面 缩略图260*170 50*50 原图',
	`videoname` varchar(64) NOT NULL COMMENT '预告影片名', 
	`clicknum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
	`screentime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上映时间',
	`addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
	`status` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '状态0新添加 1显示 2 不显示',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

+------------------------------------电影资讯相关表----------------------------------------------+

/*电影新闻信息表*/
CREATE TABLE `ll_mnews`(
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`author` varchar(12) NOT NULL,
	`edit` varchar(12) NOT NULL,
	`source` varchar(32) NOT NULL,
	`picname` varchar(32) NOT NULL,
	`looknum` int(10) NOT NULL COMMENT 'lookNumber',
	`title` varchar(32) NOT NULL,
	`title2` varchar(32) NOT NULL,
	`summary` varchar(100) NOT NULL,
	`explain` text NOT NULL,
	`content` text NOT NULL,
	`addtime` int(10) NOT NULL,
	`status` smallint(6) NOT NULL DEFAULT '1',
	`belong` smallint(6) NOT NULL DEFAULT '1',
	`state` smallint(6) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)	
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

/*电影新闻图片表*/
CREATE TABLE `ll_mpicnews`(
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`mid` int(10) NOT NULL,
	`pica` varchar(32) NOT NULL,
	`picb` varchar(32) NOT NULL,
	`picc` varchar(32) NOT NULL,
	`picd` varchar(32) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=250 DEFAULT CHARSET=utf8;

/*电影新闻评论表*/
CREATE TABLE `ll_mnewscomment`(
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`nid` int(10) NOT NULL,
	`uid` int(10) NOT NULL,
	`content` text NOT NULL,
	`addtime` int(10) NOT NULL,
	`state` enum('1','2') NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*人物新闻表*/
CREATE TABLE `ll_pnews`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`author` varchar(12) NOT NULL,
	`edit` varchar(12) NOT NULL,
	`source` varchar(32) NOT NULL,
	`picname` varchar(32) NOT NULL,
	`looknum` int(10) NOT NULL,
	`title` varchar(32) NOT NULL,
	`title2` varchar(32) NOT NULL,
	`summary` varchar(100) NOT NULL,
	`explain` text NOT NULL,
	`status` smallint(6) NOT NULL DEFAULT '1',
	`state` smallint(6) NOT NULL DEFAULT '1',
	`content` text NOT NULL,
	`addtime` int(10) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*人物新闻图片表*/
CREATE TABLE `ll_ppicnews`(
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`pid` int(10) NOT NULL,
	`pica` varchar(32) NOT NULL,
	`picb` varchar(32) NOT nuLL,
	`picc` varchar(32) NOT NULL,
	`picd` varchar(32) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;

/*人物新闻评论表*/
CREATE TABLE `ll_newscomment`(
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`nid` int(10) NOT NULL,
	`uid` int(10) NOT NULL,
	`content` text NOT NULL,
	`addtime` int(10) NOT NULL,
	`state` enum('1','2') NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;



+---------------------------------用户相关表------------------------------------------------+

/*访问权限控制表*/
CREATE TABLE `ll_access`(
	`role_id` smallint(6) unsigned NOT NULL,
	`node_id` smallint(6) unsigned NOT NULL,
	`level` tinyint(1) NOT NULL,
	`module` varchar(60) DEFAULT NULL,
	KEY `groupId` (`role_id`),
	KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*节点表*/
CREATE TABLE `ll_node`(
	`id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(20) NOT NULL,
	`title` varchar(50) DEFAULT NULL,
	`status` tinyint(1) DEFAULT '0',
	`remark` varchar(255) DEFAULT NULL,
	`sort` smallint(6) unsigned NOT NULL,
	`pid` smallint(6) unsigned NOT NULL,
	`level` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `level` (`level`),
	KEY `pid` (`pid`),
	KEY `status` (`status`),
	KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=utf8;

/*角色表*/
CREATE TABLE `ll_role`(
	`id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(20) NOT NULL,
	`pid` smallint(6) DEFAULT NULL,
	`status` tinyint(1) unsigned DEFAULT NULL,
	`remark` varchar(255) DEFAULT NULL,
	`title` varchar(32) DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `pid` (`pid`),
	KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*角色--用户中间表*/
CREATE TABLE `ll_role_user`(
	`role_id` mediumint(9) unsigned DEFAULT NULL,
	`user_id` char(32) DEFAULT NULL,
	KEY `groou_id` (`role_id`),
	KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*后台用户表*/
CREATE TABLE `ll_auser`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`username` varchar(32) CHARACTER SET latin1 NOT NULL,
	`password` varchar(32) CHARACTER SET latin1 NOT NULL,
	`fullname` varchar(32) CHARACTER SET latin1 NOT NULL,
	`email` varchar(64) CHARACTER SET latin1 NOT NULL,
	`phone` varchar(16) CHARACTER SET latin1 NOT NULL,
	`login_time` int(11) NOT NULL,
	`login_ip` varchar(20) CHARACTER SET latin1 NOT NULL,
	`status` tinyint(1) NOT NULL DEFAULT '0',
	`logintimes` int(10) unsigned NOT NULL DEFAULT `0`,
	`score` int(10) unsigned NOT NULL DEFAULT `0`,
	PRIMARY KEY (`id`),
	UNIQUE KEY `username` (`username`),
	UNIQUE KEY `email` (`email`),
	UNIQUE KEY `phone` (`phone`),
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*前台用户表*/
CREATE TABLE `ll_user`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`username` varchar(32) NOT NULL,
	`name` varchar(32) NOT NULL DEFAULT '',
	`password` char(32) NOT NULL,
	`disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户状态 0正常 举报1 禁言2',
	`sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 女 1男',
	`birthday` varchar(16) DEFAULT '2016-04-09' COMMENT '出生日期',
	`email` varchar(50) NOT NULL,
	`address` varchar(255) DEFAULT NULL,
	`level` tinyint(2) NOT NULL DEFAULT '1',
	`score` int(11) NOT NULL,
	`headpic` varchar(255) NOT NULL DEFAULT '7.jpg',
	`addtime` int(11) DEFAULT NULL,
	`logtimes` int(11) NOT NULL DEFAULT '0',
	`lastlog` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*前台用户类型表*/
CREATE TABLE `ll_user_type`(
	`tid` int(10) unsigned NOT NULL,
	`uid` int(10) unsigned NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*前台用户等级表*/
CREATE TABLE `ll_ulevel`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '等级id',
	`level` int(10) unsigned NOT NULL COMMENT '等级位置',
	`levelname` varchar(32) NOT NULL COMMENT '级别名称',
	`lscore` int(10) unsigned DEFAULT NULL COMMENT '级别积分',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;



+------------------------------------功能相关表------------------------------------------------+

/*日记表*/
CREATE TABLE `ll_diary`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`uid` int(10) unsigned NOT NULL,
	`title` varchar(255) NOT NULL,
	`content` text NOT NULL,
	`addtime` int(10) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

/*日记图片表*/
CREATE TABLE `ll_diarypic`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`tbname` varchar(64) NOT NULL COMMENT '表名',
	`did` int(10) unsigned NOT NULL COMMENT '影评id',
	`picname` varchar(32) NOT NULL COMMENT '影评相关的图片',
	`create_time` int(11) NOT NULL COMMENT '添加时间',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

/*日记回复表*/
CREATE TABLE `ll_diaryreply`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT '主键',
	`did` int(10) unsigned NOT NULL COMMENT '日记id',
	`uid` int(10) unsigned NOT NULL COMMENT 'userid',
	`content` text NOT NULL COMMENT '日记回复内容',
	`addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'addTime',
	`status` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '状态 3禁言 1正常 2举报',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*友情链接表*/
CREATE TABLE `ll_friendlink`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`linkname` varchar(30) NOT NULL,
	`url` varchar(60) NOT NULL,
	`picname` varchar(60) NOT NULL,
	`dtime` int(10) NOT NULL,
	`state` smallint(6) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)	
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*心情表*/
CREATE TABLE `ll_pmood`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`uid` int(10) unsigned NOT NULL,
	`content` varchar(255) DEFAULT NULL,
	`addtime` int(10) unsigned NOT NULL,
	`type` tinyint(2) unsigned NOT nuLL DEFAULT '0' COMMENT '0自写 1转帖',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

/*消息表*/
CREATE TABLE `ll_message`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`content` text NOT NULL,
	`addtime` int(11) NOT NULL,
	`uid1` int(10) unsigned NOT NULL,
	`uid2` int(10) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*相册表*/
CREATE TABLE `ll_photoalbum`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '相册id',
	`uid` int(10) unsigned NOT NULL COMMENT '用户id',
	`coverpic` varchar(255) DEFAULT NULL COMMENT '相册封面',
	`title` varchar(255) NOT NULL COMMENT '相册名称',
	`content` text NOT NULL COMMENT '相册描述',
	`addtime` int(11) NOT NULL COMMENT '添加时间',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*公告表*/
CREATE TABLE `ll_notice`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`shortcon` varchar(500) DEFAULT NULL,
	`content` text NOT NULL,
	`addtime` int(10) unsigned NOT NULL,
	`status` tinyint(3) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Attention表*/
CREATE TABLE `ll_attention`(
	`uid` int(10) unsigned NOT NULL,
	`bid` int(10) unsigned NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


/*图片评论表*/
CREATE TABLE `ll_picrevied`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`pid` int(10) unsigned NOT NULL,
	`uid` int(10) unsigned NOT NULL,
	`content` text NOT NULL,
	`addtime` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*相册-图片表*/
CREATE TABLE `ll_pics`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '照片id',
	`pid` int(10) unsigned NOT NULL COMMENT '相册id',
	`picname` varchar(255)  NOT NULL COMMENT '照片名称',
	`descr` varchar(255) NOT NULL COMMENT '照片描述',
	`addtime` int(10) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*图片表*/
CREATE TABLE `ll_picture`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`tbname` varchar(16) NOT NULL COMMENT '表名',
	`tid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外键关联id',
	`picname` varchar(32) NOT NULL COMMENT '图片名称',
	`create_time` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*幻灯片表*/
CREATE TABLE `ll_ppt`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`mid` int(10) NOT NULL,
	`title` varchar(32) NOT NULL,
	`picname` varchar(32) NOT NULL,
	`state` smallint(6) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

/*赞 表*/
CREATE TABLE `ll_praise`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`uid` int(10) unsigned NOT NULL COMMENT '用户id',
	`fid` int(10) unsigned NOT NULL COMMENT '电影id',
	`addtime` int(10) unsigned NOT NULL COMMENT '赞的时间',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*转帖表*/
CREATE TABLE `ll_quote`(
	`zid` int(10) unsigned NOT NULL COMMENT '转帖id',
	`sid` int(10) unsigned NOT NULL COMMENT '原帖id' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*举报表*/
CREATE TABLE `ll_report`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`lid` int(10) unsigned DEFAULT '0' COMMENT '举报的影评id',
	`rid` int(10) unsigned DEFAULT '0' COMMENT '举报的短评id',
	`count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '举报次数',
	`zid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '举报的演评id',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*看过或者想看表*/
CREATE TABLE `ll_seeorsaw`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
	`fid` int(10) unsigned NOT NULL COMMENT '电影id',
	`uid` int(10) unsigned NOT NULL COMMENT '评价用户id',
	`status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0无状态 1 想看 2 看过 ',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*收藏表*/
CREATE TABLE `ll_store`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`uid` int(10) unsigned NOT NULL,
	`mid` int(10) unsigned NOT NULL,
	`addtime` int(10) unsigned NOT NULL COMMENT '收藏时间',
	PRIMARY KEY (`id`)
) ENGINE=Movie AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*访客表*/
CREATE TABLE `ll_visitor`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
	`uid` int(10) unsigned NOT NULL COMMENT '被访问者id',
	`vid` int(10) unsigned NOT NULL COMMENT '访问者id',
	`vtime` int(10) unsigned NOT NULL COMMENT '到访时间',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

/*用户站内信表*/
CREATE TABLE `ll_uletter`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '站内信id',
	`uid` int(10) unsigned NOT NULL COMMENT '被发送人id',
	`title` varchar(255) DEFAULT '"这是一封站内信"' COMMENT '站内信标题',
	`content` text NOT NULL COMMENT '站内信内容',
	`addtime` int(10) unsigned NOT NULL COMMENT '发信时间',
	`status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '站内信开启状态，0 未浏览 1 已浏览',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*用户回复表*/
CREATE TABLE `ll_ureply`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '回复ID',
	`uid` int(10) unsigned NOT NULL COMMENT '回复者ID',
	`bid` int(10) unsigned NOT NULL COMMENT '被回复者ID',
	`rid` int(10) unsigned NOT NULL COMMENT '被回复的内容id',
	`typeid` int(10) unsigned NOT NULL COMMENT '被回复的类型ID 1留言板 2心情 3相册 4日志 ...',
	`rcontent` text NOT NULL COMMENT '回复的内容',
	`addtime` int(10) unsigned NOT NULL COMMENT '回复的时间',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

+-----------------------------------------------------------------------------------------------------+