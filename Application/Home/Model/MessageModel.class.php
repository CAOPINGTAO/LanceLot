<?php
/**
 * 留言关联模型
 * 当前模型从属于某一个用户
 * User: Lancelot
 * Date: 2016/5/2
 * Time: 18:02
 */
namespace Home\Model;
use Think\Model\RelationModel;

class MessageModel extends RelationModel{

	protected $_link = array(
		//回复与发布者是多对一
		'User'=>array(
			'mapping_type'=>self::BELONGS_TO, //关联类型
			'class_name'=>'User', //关联的模型名
			'foreign_key'=>'uid2',  // 关联的外键名
			'mapping_name'=>'user', //关联的映射名
			'mapping_fields'=>'username,headpic', //要关联查询的字段
		),
	);
}