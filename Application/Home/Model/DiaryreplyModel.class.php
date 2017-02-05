<?php
/**
 * 定义用户与日志回复关联模型
 * 当前模型从属于用户对象
 * User: Lancelot
 * Date: 2016/5/4
 * Time: 18:46
 */
namespace Home\Model;
use Think\Model\RelationModel;

class DiaryreplyModel extends RelationModel{

	protected $_link=array(
		//日志回复与回复者一对一
		'User'=>array(
			'mapping_type'=>self::BELONGS_TO,//关联类型 
				'class_name'=>'User',//关联的模型类名
				'foreign_key'=>'uid',//关联的外键名	
				'mapping_name'=>'user',//关联的映射名 默认是表名
				'mapping_fields'=>'username,headpic', //要关联查询的字段
				'as_fields'=>'username,headpic', //映射字段
		),	
	);	
}