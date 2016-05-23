<?php
/**
 * 定义收藏的视图模型
 * 当前模型拥有多个用户回复
 * User: Lancelot
 * Date: 2016/5/1
 * Time: 16:10
 */
namespace Home\Model;
use Think\Model\ViewModel;

class StoreViewModel extends ViewModel{

	public $viewFields =array(
			'Store'=>array('id','addtime','uid','mid'),
			'Movie'=>array('filmname','content','picname','_on'=>'Store.mid=Movie.id'),
		);
}