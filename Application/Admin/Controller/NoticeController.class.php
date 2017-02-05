<?php
/**
 * 公告信息管理
 * User: Lancelot
 * Date: 2016/5/11
 * Time: 18:02
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class NoticeController extends CommonController{

	public function insert(){

		$_POST['addtime'] = time();
		parent::insert();
	}

	public function add(){
		//清空session中的公告图片信息,再调用视图
		$_SESSION['notice_img'] = array();
		parent::add();
	}

	public function edit(){
		//清空session中的公告图片信息,再调用视图
		$_SESSION['notice_img'] = array();
		parent::edit();
	}

	// 添加成功后的回调方法（在这里主要处理添加文章的图片信息）\
	public function _tigger_insert($model){

		//获取当前文章的所有关联图片
		$map['id'] = array("in", $_SESSION['notice_img']);
		$mod = M("Picture");
		$plist = $mod->where($map)->select();
		if (!empty($plist)) {
			//遍历查处每张图片
			foreach ($plist as $v) {
				//使用正则匹配并判断公告中是否存在图片
				if (preg_match("/Uploads\/Notice\/{$v['picname']}/", $_POST['content'])) {
					//存在则在picture表该条记录中设置tid为该notice的id
					$mod->where("id={$v['id']}")->setField('tid', $model->id);
				} else {
					//若该关联图片不在文章内，则执行删除
					$mod->delete($v['id']);
					@unlink("./Uploads/Notice/".$v['picname']);
				}
			}
		}
		unset($_SESSION['notice_img']);
	}

	// 修改成功后的回调方法（在这里主要处理添加文章的图片信息）
	public function _tigger_update($model){

		//获取当前文章的所有关联图片
		$map['tid'] = $_POST['id'];
		if ($_SESSION['notice_img'] != null) {
			$map['id'] = array("in", $_SESSION['notice_img']);
			$map['_logic'] = 'OR';
		}
		$mod = M("Picture");
		$plist = $mod->where($map)->select();

		if (!empty($plist)) {
			//遍历每张图片
			foreach ($plist as $v) {
				//判断盖章图片是否存在于该条公告中
				if (preg_match("/Uploads\/Notice\/{$v['picname']}/", $_POST['content'])) {
					//存在则设置该张图片数据库中的tid为该Notice ID
					$mod->where("id={$v['id']}")->setField('tid', $_POST['id']);
				} else {
					// 若图片不再公告内，则删除该图片
					$mod->delete($v['id']);
					@unlink("./Uploads/Notice/".$v['picname']);
				}
			}
		}
		unset($_SESSION['notice_img']);
	}

	//定义图片上传方法
	public function doupload(){

		$resinfo = array("err"=>"","msg"=>"");

		$upload = new \Think\UploadFile();
		$upload->maxSize = 3145728;
		$upload->allowExts = array("jpg", "gif", "png", "jpeg");
		$upload->savePath = './Upload/Notice/';

		if (!$upload->upload()) {
			$resinfo['err'] = $upload->getErrorMsg();
		} else {
			$info = $upload->getUploadFileInfo();
			$resinfo['msg'] = __ROOT__."/Uploads/Notice/".$info[0]['savename'];

			//执行图片信息的添加
			$data['tbname'] = "notice";
			$data['tid'] = 0;
			$data['picname'] = $info[0]['savename'];
			$data['create_time'] = time();
			$id = M("Picture")->add($data);
			$_SESSION['notice_img'][] = $id; //保存当前图片的id号到session中
		}
		echo json_encode($resinfo);
		exit();
	}

}