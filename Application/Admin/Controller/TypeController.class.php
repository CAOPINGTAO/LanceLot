<?php
/**
 * 影片类型控制器类
 * User: Lancelot
 * Date: 2016/5/10
 * Time: 23:58
 */
namespace Admin\Controller;
use Admin\Controller\CommonController;

class TypeController extends CommonController{

	//封装搜索条件
	 public function _filter(&$map){
	 	//搜索条件有值则做封装
	 	if (!empty($_REQUEST['keyword'])) {
	 		$where['typename'] = array('like', "%{$_REQUEST['keyword']}%");
	 		$where['_logic'] = 'or';
	 		$map['_complex'] = $where;
	 	}
	 }
}
?>