<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;

class PrevueController extends CommonController{

	public function _filter(&$map){

		if (!empty($_REQUEST["keyword"])) {
			$map["title"] = array("like", "%{$_REQUEST['keyword']}%");
		}

		if (!empty($_REQUEST["status"])) {
			$map["status"] = $_REQUEST['status'];
		}
	}

	// 数据加工回调函数
	public function _tigger_list(&$list){

		foreach ($list as &$v) {
			switch ($v["status"]) {
				case '0':
					$v["status"] = "新添加";
					break;
				case '1':
					$v["status"] = "显示";
					break;
				case '2':
					$v["status"] = "隐藏";
			}
		}

		foreach ($list as &$v) {
			$tmp = M("Movie")->field("filmname")->find($v["fid"]);
			$v["fid"] = $tmp["filmname"];
		}
	}

	public function add(){

		$list = M("Movie")->field("id,filmname")->select();
		$this->assign("list", $list);
		parent::add();
	}

	public function insert(){

		$result = array();
		$upload = new \Think\UploadFile();
		$upload->maxSize = 314572800000;
		$upload->allowExts = array("flv", "avi", "mp4", "rmvb");
		$upload->savePath = "./Uploads/Video/";

		if (!$upload->upload()) {
			$result = getReturnArray(300, "上传失败".(string)($upload->getErrorMsg()), "closeCurrent", "listprevue");
			$this->ajaxReturn($result);exit();
		} else {
			$info = $upload->getUploadFileInfo();
		}

		$_POST["videoname"] = $info[0]["savename"];
		$_POST["addtime"] = time();

		parent::insert();
	}

	public function edit(){

		$list = M("Movie")->field("id,filmname")->select();
		$this->assign("list",$list);

		parent::edit();
	}

	public function update(){

		if (!empty($_FILES["name"])) {
			$upload = new \Think\UploadFile();
			$upload->maxSize = 314572800000;
			$upload->allowExts = array("flv", "avi", "mp4", "rmvb");
			$upload->savePath = "./Uploads/Video/";

			if (!$upload->upload()) {
				$this->ajaxReturn(getReturnArray(300, "上传失败".(string)($upload->getErrorMsg()), "closeCurrent", "listprevue"));exit();
			} else {
				$info = $upload->getUploadFileInfo();
			}

			$oldpic = M("Prevue")->field("videoname")->find($_POST["id"]);
			unlink("./Uploads/Video/{$oldpic['videoname']}");

			$_POST["videoname"] = $info[0]["savename"];
		}

		parent::update();
	}

	public function addpic(){

		$list = M("Prevue")->find($_GET["id"]);
		$tmp = M("Movie")->find($list["fid"]);
		$list["filmname"] = $tmp["filmname"];

		$this->assign("list", $list);
		$this->display("addpic");
	}

	public function insertpic(){

		if (!empty($_FILES)) {
			$upload = new \Think\UploadFile();
			$upload->maxSize = 3145728;
			$upload->allowExts = array("jpg", "jpeg", "gif", "png");
			$upload->savePath = "./Uploads/Prevue/";
			$upload->thumb = true;
			$upload->thumbMaxWidth = "60,260,586";
			$upload->thumbMaxHeight = "40,170,390";
			$upload->thumbPrefix = "a_,b_,c_";

			if (!$upload->upload()) {
				$this->ajaxReturn(getReturnArray(300,"上传失败".(string)($upload->getErrorMsg()), "closeCurrent", "listprevue"));exit();
			} else {
				$info = $upload->getUploadFileInfo();
		 	}

			$oldpic = M("Prevue")->find($_POST["id"]);
			if ($old["picname"] != "无") {
				unlink("./Uploads/Prevue/a_".$oldpic["picname"]);
				unlink("./Uploads/Prevue/b_".$oldpic["picname"]);
				unlink("./Uploads/Prevue/c_".$oldpic["picname"]);
				unlink("./Uploads/Prevue/".$oldpic["picname"]);
			}

			unset($_POST['ajax']);
			//保存更新信息到数据库
			$_POST["picname"] = $info[0]["savename"];
			$model = M("Prevue");
			if ($model->save($_POST)) {
				$this->ajaxReturn(getReturnArray(200, "设置成功", "closeCurrent", "listprevue"));exit();
			} else {
				$this->ajaxReturn(getReturnArray(300, "设置失败".(string)($model->getLastSql()), "closeCurrent", "listprevue"));exit();
			}
		} else {
			$this->ajaxReturn(300, "没有进行修改", "closeCurrent", "listprevue");
		}
	}

	//删除时注意删掉上传的资源（包括预告片视频和预告片图片）
	public function delete(){

		$del = M("Prevue")->find($_GET["id"]);
		if ($del) {
			//删除视频
			unlink("./Uploads/Video/".$del["videoname"]);
			//删除图片和缩略图片
			unlink("./Uploads/Prevue/a_".$del["picname"]);
			unlink("./Uploads/Prevue/b_".$del["picname"]);
			unlink("./Uploads/Prevue/c_".$del["picname"]);
			unlink("./Uploads/Prevue/".$del["picname"]);
		}

		parent::delete();
	}
}
