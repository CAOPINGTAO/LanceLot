<?php
/**
 * 用户关联模型
 * User: Lancelot
 * Date: 2016/5/2
 * Time: 8:21
 */
namespace Home\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel{

	protected $_link = array(
		//用户表与心情表 一对多的关系
		'Pmood'=>array(
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Pmood',
			'foreign_key'=>'uid',
			'mapping_name'=>'pmood',
			'mapping_order'=>'addtime desc',
			'mapping_limit'=>'1',
		),
		
		//用户表与影片长评表 一对多的关系
		'Longreview'=>array(
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Longreview',
			'foreign_key'=>'uid',
			'mapping_name'=>'longreview',
			//'mapping_fields'=>'id,fid,title,content,ptime',
			'mapping_order'=>'ptime desc',
			'mapping_limit'=>'1',
		),
		
		//用户表与影片短评表 一对多的关系
		'Shortreview'=>array(
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Shortreview',
			'foreign_key'=>'uid',
			'mapping_name'=>'shortreview',
			'mapping_order'=>'rtime desc',
			'mapping_limit'=>'1',
		),
		
		//用户表与影评回复表，一对多的关系
		'Reviewreply'=>array(
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Reviewreply',
			'foreign_key'=>'uid',
			'mapping_name'=>'reviewreply',
			'mapping_order'=>'rtime desc',
			'mapping_limit'=>'1',
		),
		
		//用户表与日志表，一对多的关系
		'Diary'=>array(
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Diary',
			'foreign_key'=>'uid',
			'mapping_name'=>'diary',
			'mapping_order'=>'addtime desc',
			'mapping_limit'=>'1',
		),
		
		//用户表与留言表，一对多的关系
		'Message'=>array(
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Message',
			'foreign_key'=>'uid2',
			'mapping_name'=>'message',
			'mapping_order'=>'addtime desc',
			'mapping_limit'=>'1',
		),
		
		//用户表与标签表，多对多的关系
		'Type'=>array(
			'mapping_type'=>self::MANY_TO_MANY,
			'class_name'=>'Type',
			'mapping_name'=>'mytypes',
			'foreign_key'=>'uid',
			'relation_foreign_key'=>'tid',
			'relation_table'=>'ll_user_type',
		),
	);
}