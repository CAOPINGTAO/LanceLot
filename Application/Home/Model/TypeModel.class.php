<?php
/**
 * 类型关联模型
 * 当前模型拥有多部电影，每部电影拥有多个类型
 * User: Lancelot
 * Date: 2016/5/5
 * Time: 14:17
 */
namespace Home\Model;
use Think\Model\RelationModel;

class TypeModel extends RelationModel{

	protected $_link = array(
		//类型表与电影表 多对多的关系
		'Movie'=>array(
			'mapping_type' => self::MANY_TO_MANY,
			'class_name' => 'Movie',
			'mapping_name' => 'mymovies',
			'foreign_key' => 'tid',
			'relation_foreign_key' => 'fid',
			'relation_table' => 'll_movie_type',
		),
	);
}