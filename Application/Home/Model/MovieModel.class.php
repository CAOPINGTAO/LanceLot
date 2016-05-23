<?php
/**
 * 影片关联模型
 * 当前模型有多种类型、多个演员、多张剧照
 * User: Lancelot
 * Date: 2016/4/20
 * Time: 2:3
 */
namespace Home\Model;
use Think\Model\RelationModel;

class MovieModel extends RelationModel{

	protected $_link=array(
		//类型 多对多回复
		'Type'=>array(
				'mapping_type'=>self::MANY_TO_MANY,//关联类型
				'class_name'=>'Type',//关联的模型类名
				'foreign_key'=>'fid',//关联的外键名	
				'mapping_name'=>'typelist',//关联的映射名 默认是表名 不要和长评中的字段重合
				//'mapping_fields'=>'id,content',//关联要查询的字段,默认全部字段，如查询个别字段定义mapping_fields。
				'mapping_order'=>'id desc',//关联的排序方式
				'relation_foreign_key'=>'tid',//默认的关联表的外键名称是表名_id
				'relation_table'=>'ll_movie_type'//中间关联表
		),
		//演员 多对多
		'Actors'=>array(
				'mapping_type'=>self::MANY_TO_MANY,//关联类型
				'class_name'=>'Actors',//关联的模型类名
				'foreign_key'=>'fid',//关联的外键名	
				'mapping_name'=>'actorlist',//关联的映射名 默认是表名 不要和长评中的字段重合
				//'mapping_fields'=>'id,content',//关联要查询的字段,默认全部字段，如查询个别字段定义mapping_fields。
				'mapping_order'=>'id desc',//关联的排序方式
				'relation_foreign_key'=>'aid',//默认的关联表的外键名称是表名_id
				'relation_table'=>'ll_movie_actor'//中间关联表
		),		
		//剧照 一对多
		'Filmpic'=>array(
				'mapping_type'=>self::HAS_MANY,//关联类型
				'class_name'=>'Filmpic',//关联的模型类名
				'foreign_key'=>'fid',//关联的外键名	
				'mapping_name'=>'piclist',//关联的映射名 默认是表名 不要和长评中的字段重合
		),
		
	);
}