<?php
/**
 * 影评关联模型
 * 当前模型从属于某一个用户、从属于某一部电影
 * User: Lancelot
 * Date: 2016/5/1
 * Time: 19:30
 */
namespace Home\Model;
use Think\Model\RelationModel;

class LongreviewModel extends RelationModel{

	protected $_link=array(
		//电影一对一（一个影评属于一个电影）
		'Movie'=>array(
			'mapping_type'=>self::BELONGS_TO,//关联类型 
				'class_name'=>'Movie',//关联的模型类名
				'foreign_key'=>'fid',//关联的外键名	
				'mapping_name'=>'movie'//关联的映射名 默认是表名
		),		
		//影评对用户一对一
		'User'=>array(
			'mapping_type'=>self::BELONGS_TO,//关联类型 
				'class_name'=>'User',//关联的模型类名
				'foreign_key'=>'uid',//关联的外键名	
				'mapping_name'=>'user'//关联的映射名 默认是表名
		),	

	);	
}