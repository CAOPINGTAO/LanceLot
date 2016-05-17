<?php
/**
 * 影评控制器类
 * User: Lancelot
 * Date: 2016/5/11
 * Time: 20:03
 */
namespace Admin\Controller;
use Admin\Controller\CommonController;

class LongreviewController extends CommonController{

	//封装多字段的搜索条件
	public function _filter(&$map){

		if (!empty($_REQUEST['keyword'])) {
			$where["title"] = array("like", "%{$_REQUEST['keyword']}%");
			$where['content'] = array("like", "%{$_REQUEST['keyword']}%");
			$where["_logic"] = "or";
			$map['_complex'] = $where;
		}

		if (!empty($_REQUEST["status"])) {
			$map["status"] = $_REQUEST['status'];
		}
	}

	// index中对查询到的list数据进行加工
	public function _tigger_list(&$list){

		//状态转换为中文 
		foreach ($list as &$v) {
			switch ($v['status']) {
				case '1':
					$v['status'] = "正常";
					break;
				case '2':
					$v['status'] = "举报";
					break;
				case '3':
					$v['status'] = "禁言";
					break;
			}
			$tmp = M("user")->find($v["uid"]);
			$v["username"] = $tmp["username"];

			//查询评论回复数
			$v["rnum"] = M("Reviewreply")->where("rid=".$v["id"])->count();

			//新增影片名字段
			$tmp = M("Movie")->find($v["fid"]);
			$v["filmname"] = $tmp["filmname"];

			//统计举报数
			$res = M("report")->where("lid=".$v["id"])->find();
			if ($res) { 
				$v["report"] = $res["count"];
			}
		}
	}

	public function update(){

		//状态正常时举报数清空
		if ($_POST["status"]==1) {
			$m = new \Think\Model();
			$m->query("UPDATE ll_report SET count=0 WHERE lid={$_POST['id']}");
		}
		parent::update();
	}

	// 查看影评内容
	public function content(){

		$vo = M("Longreview")->find($_GET["id"]);
		$this->assign("vo", $vo);
		$this->display();
	}

	// 查看影评回复列表
	public function listreply(){
		
		$rid = $_GET["id"]; 	//reply ID

		//排序 
		$order = "id asc";  //默认为ID asc
		if (!empty($_REQUEST["_order"])) {
			$order = $_REQUEST["_order"]." ".$_REQUEST["_sort"];
		}

		$m = M("Reviewreply");

		$pageNum = $_REQUEST["pageNum"] + 0;
		$numPerPage = isset($_REQUEST["numPerPage"]) ? $_REQUEST["numPerPage"] : C("NUM_PER_PAGE");

		$count = $m->where("rid=".$rid)->count();
		$page = new \Think\Page($count, $numPerPage);
		$list = $m->where("rid={$rid}")->order($order)->limit($page->firstRow.','.$page->listRows)->select();

		$this->assign("lid", $rid); //影评id
		$this->assign("list", $list);
		$this->assign("totalCount", $count);
		$this->assign("currentPage", $pageNum);
		$this->assign("numPerPage", $numPerPage);
		$this->assign("pageNumShown", 0); //显示多少个页码

		$this->display();
	}

	// 删除影评 相关的所有回复都要删除
	public function delete(){

		// 删除影评相关的所有回复
		M("Reviewreply")->where("rid=".$_REQUEST["id"])->delete();
		parent::delete();
		
	}

}