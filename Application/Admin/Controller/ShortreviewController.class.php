<?php
/**
 * 短评信息控制器类
 * User: Lancelot
 * Date: 2016/5/11
 * Time: 21:40
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class ShortreviewController extends CommonController{

	//封装多字段的搜索条件
	public function _filter(&$map){

		//关键字模糊搜索
		if (!empty($_REQUEST["keyword"])) {
			$map["content"] = array("like", "%{$_REQUEST['keyword']}%");
		}

		if (!empty($_REQUEST["status"])) {
			$map["status"] = $_REQUEST['status'];
		}
	}

	// index中对查询到的list数据进行加工
	public function _tigger_list(&$list){

		foreach ($list as &$v) {
			switch ($v["status"]) {
				case '1':
					$v["status"] = "正常";
					break;
				case '2':
					$v["status"] = "举报";
					break;
				case '3':
					$v["status"] = "禁言";
					break;
			}
			$tmp = M("user")->find($v["uid"]);
			$v["username"] = $tmp["username"];

			$tmp = M("Movie")->find($v["fid"]);
			$v["filmname"] = $tmp["filmname"];

			$res = M("report")->where("rid=".$v["id"])->find();
			if ($res) {
				$v["report"] = $res["count"];
			}
		}
	}

	// 修改短评状态
	public function update(){

		// 状态为正常时举报数清空
		if ($_POST["status"] == 1) {
			$m = new \Think\Model();
			$m->query("UPDATE ll_report SET count=0 WHERE rid={$_POST['id']}");
		}
		parent::update();
	}

	//查看短评内容
	public function content(){

		$vo = M("Shortreview")->find($_GET["id"]);
		$this->assign("vo", $vo);
		$this->display();
	}
}