<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;

class DialogueController extends CommonController{

	public function _filter(&$map){

		if (!empty($_REQUEST["keyword"])) {
			$where["en_dialogue"]=array("like","%{$_REQUEST['keyword']}%");
			$where["cn_dialogue"]=array("like","%{$_REQUEST['keyword']}%");
			$where["source"]=array("like","%{$_REQUEST['keyword']}%");
			$where["id"]=array("like","%{$_REQUEST['keyword']}%");
			$where["_logic"]="or";
			$map["_complex"]=$where;
		}

		if (!empty($_REQUEST["status"])) {
			$map["status"] = $_REQUEST['status'];
		}
	}

	public function insert(){

		$_POST["addtime"] = time();
		parent::insert();
	}

	public function update(){

		$_POST["addtime"] = time();
		parent::update();
	}

	public function editstatus(){

		$vo = M("Dialogue")->find($_GET["id"]);

		$this->assign("vo", $vo);
		$this->display("editstatus");
	}

	public function updatestatus(){

		parent::update();
	}
}