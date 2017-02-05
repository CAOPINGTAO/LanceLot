<?php
/**
 * 角色控制器
 * User: Lancelot
 * Date: 2016/5/06
 * Time: 13:07
 */
namespace Admin\Controller;
use Admin\Controller\CommonController;

class RoleController extends CommonController{

	//封装搜索条件
	public function _filter(&$map){
		//封装条件有值则作封装
		if(!empty($_REQUEST['keyword'])){
			$where['name'] = array('like', "%{$_REQUEST['keyword']}%");
			$where['title'] = array('like', "%{$_REQUEST['keyword']}%");
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
	}

	//配置权限的视图
	public function access(){

		$rid = I('rid', 0, 'intval');
		$field = array('id', 'name', 'title', 'pid');
		$node = M('node')->field($field)->select();

		//原有的权限(即获取该role_id,对应的整列node_id)
		$access = M('access')->where(array('role_id'=>$rid))->getField('node_id', true);
		$node = node_merge($node, $access);

		$this->assign('list', $node);
		$this->rid = $rid;
		$this->display();
	}

	//设置权限处理表单
	public function setAccess(){
		
		$rid = I('rid', 0, 'intval');

		$db = M('access');
		$db->where(array('role_id'=>$rid))->delete();
		$data = array();
		//数据组装
		foreach ($_POST['access'] as $v) {
		 	$tmp = explode('_', $v);
		 	$data[] = array(
		 		'role_id'	=>	$rid,
		 		'node_id'	=>	$tmp[0],
		 		'level'		=>	$tmp[1]
		 	);
		 }

		 if (empty($_POST['access'])) {
		 	$this->success("修改成功!");
		 	exit();
		 }
		 if ($db->addAll($data)) {
		 	$this->success("修改成功!");
		 } else {
		 	$this->error("修改失败!");
		 }
	}

	//查看权限信息视图
	public function showAccess(){

		//I(变量名称，不存在时的默认值。过滤方法)
		$rid = I('rid', 0, 'intval');
		$field = array('id', 'name', 'title', 'pid');
		$node = M('node')->field($field)->select();

		//原有的权限
		$access = M('access')->where(array('role_id'=>$rid))->getField('node_id', true);
		$node = node_merge($node, $access);

		$this->assign('list', $node);
		$this->rid = $rid;
		$this->display();
	}
	
}

?>