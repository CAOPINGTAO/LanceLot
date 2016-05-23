<?php
/**
 * 心情关联模型
 * 当前模型拥有多个用户回复
 * User: Lancelot
 * Date: 2016/5/1
 * Time: 10:17
 */
namespace Home\Model;
use Think\Model\RelationModel;

class PmoodModel extends RelationModel{

	protected $_link = array(
		//心情表与回复表 1对多的关系
		'Ureply'=>array(
			'mapping_type' => self::HAS_MANY,
			'class_name' => 'Ureply',
			'foreign_key' => 'rid',
			'mapping_name' => 'ureply',
			'condition' =>'typeid=2',
		),
	);
}