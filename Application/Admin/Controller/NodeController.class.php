<?php
/**
 * 节点控制器
 * User: Lancelot
 * Date: 2016/5/09
 * Time: 13:54
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class NodeController extends CommonController{

	//封装搜索条件
	public function _filter(&$map){
		//搜索条件有值则作封装
		if (!empty($_REQUEST['keyword'])) {
			$where['name'] = array('like', "%{$_REQUEST['keyword']}%");
			$where['title'] = array('like', "%{$_REQUEST['keyword']}%");
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
	}

	//添加节点视图
	public function add(){

		$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;	//父节点
		$level = isset($_GET['level']) ? $_GET['level'] : 1; //访问等级，默认为添加应用

		switch ($level) {
			case 1:
				$type = "应用";
				break;
			case 2:
				$type = "控制器";
				break;
			case 3:
				$type = "方法";
				break;
		}

		$this->assign('pid', $pid);
		$this->assign('level', $level);
		$this->assign('type', $type);
		$this->display();
	}

	//修改节点视图
	public function edit(){

		$vo = M('node')->find($_GET['id']);
		$level = $vo['level'];

		switch ($level) {
			case 1:
				$type = "应用";
				break;
			case 2:
				$type = '控制器';
				break;
			case 3:
				$type = '方法';
				break;
		}

		$this->assign('type', $type);
		$this->assign('vo', $vo);
		$this->display();
	}

	//节点列表
	public function nodeList(){

		$field = array('id', 'name', 'title', 'pid');
		$node = M('node')->field($field)->select();
		$node = node_merge($node);
		$this->assign("list", $node);
		$this->display();
	}

	// 添加节点视图(在查看的时候添加)
	public function addNode(){
		$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
		$level = isset($_GET['level']) ? $_GET['level'] : 1;

		$this->assign('pid', $pid);
		$this->assign('level', $level);

		switch ($level) {
			case 1:
				$type = "应用";
				break;
			case 2:
				$type = '控制器';
				break;
			case 3:
				$type = '方法';
				break;
		}
		
		$this->assign('type', $type);
		$this->display();
	}
}