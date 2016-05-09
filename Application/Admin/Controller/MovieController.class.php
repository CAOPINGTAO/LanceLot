<?php
/**
 * 电影信息管理
 * User: Lancelot
 * Date: 2016/5/9
 * Time: 17:56
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class MovieController extends CommonController{

	//搜索条件封装
	public function _filter(&$map){
		//有值则进行封装
		if (!empty($_REQUEST['keyword'])) {
			$where['filmname'] = array('like', "%{$_REQUEST['keyword']}%");
			$where['petname'] = array('like', "%{$_REQUEST['keyword']}%");
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
	}

	//添加影片基本信息
	public function insert(){
		//文件上传
		$upload = new \Think\Upload();
		
	}
}
