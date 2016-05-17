<?php
/**
 * 幻灯片控制器类
 * User: Lancelot
 * Date: 2016/5/12
 * Time: 00:08
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class PptController extends CommonController{

	// 浏览
	public function index(){

		$m = M("Movie");
		$map["status"] = 2;
		$q = $m->field("id,filmname,status,picname")->where($map)->select();

		foreach ($q as $v) {
			$n = array();
			$where['title'] = $v['filmname'];
			$n['title'] = $v['filmname'];
			$n['mid'] = $v['id'];
			$n['state'] = 2;
			$p = M("Ppt");
			$count = $p->where($where)->select();
			if (empty($count)) {
				$p->add($n);
			}
		}

		//搜索条件有值则做封装
		if (!empty($_REQUEST['keyword'])) {
			$where['title'] = array("like", "%{$_REQUEST['keyword']}%");
			$where['_logic'] = 'or';
			$mp['_complex'] = $where;
		}

		// 状态的搜索
		if (!empty($_REQUEST['state'])) {
			$mp["state"] = $_REQUEST['state'];
		}
		$ppt = M('Ppt');
		$list = $ppt->where($mp)->select();
		// var_dump($list);die();
		$this->assign("list", $list);
		$this->display("index");
	}

	// 添加幻灯片
	public function add(){

		$m = M("Ppt");
		$this->assign("vo", $m->find($_GET['id']));
		$this->display("add");
	}

	// 执行添加
	public function insert(){

		//图片上传处理
		$upload = new \Think\UploadFile();
		$upload->maxSize = 3145728;
		$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->savePath = './Uploads/News/mypic/';

		$upload->thumb = true;
		$upload->thumbMaxWidth = '960,137,100';
		$upload->thumbMaxHeight = '340,53,40';
		$upload->thumbPrefix = "b_,c_,s_";
		$upload->thumbRemoveOrigin = true; //删除原图

		if (!$upload->upload()) {
			$this->error($upload->getErrorMsg());
		} else {
			$info = $upload->getUploadFileInfo();
		}

		// 保存表单数据
		$m = M("Ppt");
		$m->find($_POST['id']);
		$m->picname = $info[0]['savename'];
		if ($m->save()) {
			$this->success("成功！");
		} else {
			$this->error("失败！");
		}
	}

	// 删除
	public function del(){

		$m = M("Ppt");

		$pic = $m->find($_GET['id']); 
		$res = $m->delete($_GET['id']);
		if ($res) {
			@unlink('./Uploads/News/mypic/b_'.$pic['picname']);
			@unlink('./Uploads/News/mypic/s_'.$pic['picname']);
			@unlink('./uploads/News/mypic/c_'.$pic['picname']);
			$this->success('删除成功!');
		} else {
			$this->error('删除失败');
		}
	}

	// 修改
	public function edit(){

		$m = M("Ppt");

		$this->assign("vo", $m->find($_GET['id']));
		$this->display('edit');
	}

	// 处理修改
	public function update(){

		$m = M("Ppt");
		$pic = $m->find($_POST['id']);
		$n = $m->create();
		if ($_FILES['picname']['name']) {
			// 图片上传处理
			$upload = new \Think\UploadFile();
			$upload->maxSize = 3145728;
			$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath =  './Uploads/News/mypic/';

			$upload->thumb = true;
			$upload->thumbMaxWidth = '960,137,100';
			$upload->thumbMaxHeight = '340,53,40';
			$upload->thumbPrefix="b_,c_,s_";
			$upload->thumbRemoveOrigin=true;

			if (!$upload->upload()) {
				$this->error($upload->getErrorMsg());
			} else {
				$info = $upload->getUploadFileInfo();
				$name = $info[0]['savename'];
			}
			unlink('./Uploads/News/mypic/b_'.$pic['picname']);
			unlink('./Uploads/News/mypic/s_'.$pic['picname']);
			unlink('./Uploads/News/mypic/c_'.$pic['picname']);

			$m->picname = $name;
		}

		if (empty($pic['picname']) && empty($name) && $n['state'] == 1) {
			$this->error("请上传照片！");
		}

		if ($m->save()) {
			$this->success("修改成功！");
		} else {
			$this->error("修改失败！");
		}
	}
}