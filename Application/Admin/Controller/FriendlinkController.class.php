<?php
/**
 * 系统友情链接
 * User: Lancelot
 * Date: 2016/5/23
 * Time: 1:32
 */
namespace Admin\Controller;
use Admin\Controller\CommonController;

class FriendlinkController extends CommonController{

	//列表浏览
	public function _filter(&$map){
		//排序条件
		if (!empty($_REQUEST['_order'])) {
			$order = $_REQUEST['_order']." ".$_REQUEST['_sort'];
		}
		//搜索条件有值则做封装
		if (!empty($_REQUEST['keyword'])) {
			$where['linkname'] = array('like', "%{$_REQUEST['keyword']}%");
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
		//状态的搜索
		if (!empty($_REQUEST["state"])) {
			$map["state"] = $_REQUEST['state'];
		}
	}

	//添加友情链接
	public function add(){

		$this->display("add");
	}

	//执行添加
	public function insert(){

		$result = array();
		//图片上传处理
		$upload = new \Think\UploadFile();
		$upload->maxSize = 3145728;
		$upload->allowExts = array("jpg","gif","png","jpeg");
		$upload->savePath = './Uploads/News/mypic/';

		$upload->thumb = true;
		$upload->thumbMaxWidth = '90';
		$upload->thumbMaxHeight = '30';
		$upload->thumbPrefix = "c_";
		$upload->thumbRemoveOrigin = true;

		if (!$upload->upload()) {
			$result = getReturnArray(300, "上传图片失败", "closeCurrent", "linklist");
			$this->ajaxReturn($result);exit();
		} else {
			$info = $upload->getUploadFileInfo();
		}

		$m = M("Friendlink");
		$m->create();
		$m->picname = $info[0]['savename'];
		$m->dtime = time();
		if ($m->add()) {
			$result = getReturnArray(200, "新增成功", "closeCurrent", "linklist");
			$this->ajaxReturn($result);exit();
		} else {
			$result = getReturnArray(300, "新增失败", "closeCurrent", "linklist");
			$this->ajaxReturn($result);exit();
		}
	}

	public function del(){

		$m = M("Friendlink");
		$result = array();

		//先删除数据库中的信息，在删除文件
		$pic = $m->find($_GET['id']);
		$res = $m->delete($_GET['id']);
		if ($res) {
			unlink('./Uploads/News/mypic/c_'.$pic['picname']);
			$result['statusCode'] = 200;
			$result['message'] = "删除成功";
		} else {
			$result['statusCode'] = 300;
			$result['message'] = "删除失败";
		}
		$this->ajaxReturn($result);
	}

	public function edit(){

		$m = M("Friendlink");
		$vo = $m->find($_GET['id']);

		$this->assign("vo", $vo);
		$this->display();
	}

	public function update(){

		$result = array();
		$m = M("Friendlink");
		$pic = $m->find($_GET['id']);
		$m->create();

		if ($_FILES['picname']['name']) {
			$upload = new \Think\UploadFile();
			$upload->maxSize  = 3145728 ;
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath =  './Uploads/News/mypic/';
			
			$upload->thumb = true;
			$upload->thumbMaxWidth = '90';
			$upload->thumbMaxHeight = '30';
			$upload->thumbPrefix="c_";
			$upload->thumbRemoveOrigin=true;

			if (!$upload->upload()) {
				$result = getReturnArray(300, "上传图片失败", "closeCurrent", "linklist");
				$this->ajaxReturn($result);exit();
			} else {
				$info=$upload->getUploadFileInfo();
				$name=$info[0]['savename'];//获取文件名
				unlink('./Uploads/News/mypic/c_'.$pic['picname']);
				$m->picname=$name;
			}
		}

		if ($m->save()) {
			$result = getReturnArray(200, "修改成功", "closeCurrent", "linklist");
		} else {
			$result = getReturnArray(300, "修改失败", "closeCurrent", "linklist");
		}
		$this->ajaxReturn($result);exit();
	}
}