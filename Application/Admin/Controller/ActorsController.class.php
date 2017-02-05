<?php
/**
 * 演员管理控制器类
 * User: Lancelot
 * Date: 2016/5/11
 * Time: 7:50
 */
namespace Admin\Controller;
use Admin\Controller\CommonController;

class ActorsController extends CommonController{

	//封装搜索条件
	public function _filter(&$map){
		//搜索条件有值则做封装
		if (!empty($_REQUEST['keyword'])) {
			$where['cname'] = array('like', "%{$_REQUEST['keyword']}%"); //别名
			$where['ename'] = array('like', "%{$_REQUEST['keyword']}%"); //译名
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
	}

	// 添加演员表单处理
	public function insert(){

		$result = array();
		// 文件上传
		$upload = new \Think\UploadFile(); //实例化上传类
		$upload->maxSize = 3145728;
		$upload->thumb = true;
		$upload->thumbMaxWidth = '35,140';
		$upload->thumbMaxHeight = '50,200';
		$upload->thumbPrefix = "s_,l_";
		$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); //设置附件上传类型
		$upload->savePath = './Uploads/Actor/Photo/'; //设置附件上传目录

		if (!$upload->upload()) {
			$result = getReturnArray(300, "上传图片失败", "", "listactor");
			$this->ajaxReturn($result);exit();
		} else {
			// 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo();
		}

		$_POST['picname'] = $info[0]['savename'];
		$_POST['birthday'] = strtotime($_POST['birthday']);
		$_POST['addtime'] = time();

		unset($_POST['ajax']);
		parent::insert();
		// // 添加影片基本信息
		// if (M('actors')->add($_POST)) {
		// 	$result = getReturnArray(200, "新增演员成功", "", "listactor");
		// } else {
		// 	$result = getReturnArray(300, "新增演员失败", "", "listactor");
		// }
		// $this->ajaxReturn($result);exit();
	}

	// 处理修改演员信息表单
	public function update(){

		$navTabId = $_REQUEST['navTabId'];
		$_POST['birthday'] = strtotime($_POST['birthday']);
		// 未修改演员图片,则直接修改其他信息
		if ($_FILES['picname']['name'] == "") {
			parent::update();
		}

		// 修改演员头像时
		$upload = new \Think\uploadFile();
		$upload->maxSize = 3145728;
		$upload->thumb = true;
		$upload->thumbMaxWidth = '35,140';
		$upload->thumbMaxHeight = '50,200';
		$upload->thumbPrefix = "s_,l_";

		$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
		$upload->savePath = './Uploads/Actor/Photo/';  //设置附件上传目录

		if (!$upload->upload()) {
			$result = getReturnArray(300, "上传图片失败", "closeCurrent", $navTabId);
			$this->ajaxReturn($result);exit();
		} else {
			// 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo();
		}

		//删除原图
		$picname = $_POST['ppicname'];
		unlink("./Uploads/Actor/Photo/".$picname);
		unlink("./Uploads/Actor/Photo/s_".$picname);
		unlink("./Uploads/Actor/Photo/l_".$picname);

		//更新数据库信息
		$_POST['picname'] = $info[0]['savename'];
		$_POST['birthday'] = mktime($_POST['birthday']);

		parent::update();
	}

	// 添加演员剧照视图
	public function addActorImgs(){

		$this->assign('aid', $_GET['id']);
		$this->display();
	}

	// 处理添加演员剧照表单
	public function uploadsHandle(){

		$result = array();
		$aid = $_POST['aid']; //演员ID
		$upload = new \Think\UploadFile();

		$upload->maxSize = 3145728; 
		$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->savePath = './Uploads/Actor/Photos/';

		$upload->thumb = true;
		$upload->thumbMaxWidth = '50,100';
		$upload->thumbMaxHeight = '50,100';
		$upload->thumbPrefix = "s_,m_";

		if (!$upload->upload()) { //上传错误提示错误信息
			$result = getReturnArray(300, "上传图片失败", "closeCurrent", "listactor");
			$this->ajaxReturn($result);exit();
		} else { //上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo();
		}

		// 添加剧照信息
		$pic = M('picactor');
		foreach ($info as $val) {
			$data['aid'] = $_POST['id'];
			$data['picname'] = $val['savename'];
			$data['addtime'] = time();
			if (!$pic->add($data)) {
				$result = getReturnArray(300, "添加剧照信息失败", "closeCurrent", "listactor");
				$this->ajaxReturn($result);exit();
			}
		}

		$result = getReturnArray(200, "成功添加剧照信息", "closeCurrent", "listactor");
		$this->ajaxReturn($result);exit();
	}

	// 删除演员时
	public function delete(){

		$aid = $_GET['id'];
		// 查找演员头像
		$pname = M('actors')->field('picname')->where($aid)->find();
		$picname = $pname['picname'];
		// 删除演员头像
		unlink("__UPLOAD__/Actor/Photo/".$picname);
		unlink("__UPLOAD__/Actor/Photo/s_".$picname);
		unlink("__UPLOAD__/Actor/Photo/l_".$picname);

		parent::delete();
	}

	// 演员详情视图
	public function content(){

		$map['id'] = $_GET['id'];
		$vo = M('actors')->field('intro')->where($map)->find();

		$this->assign('intro', $vo['intro']);
		$this->display();
	}

	// 查看演员剧照视图
	public function showpics(){

		$imgs = M('picactor')->where("aid={$_GET['id']}")->select();
		
		$this->assign('pic', $imgs);
		$this->display();
	}

	// 修改演员剧照
	public function editActorImgs(){

		$aid = $_GET['id']; //演员ID
		$map['aid'] = $aid;
		$imgs = M('picactor')->where($map)->select();

		$this->assign("imgs", $imgs);
		$this->display();
	}

	// 删除演员剧照
	public function deleteimg(){

		$map['id'] = $_POST['id']; //剧照ID
		$pic = M('picactor')->field('picname')->where($map)->find();
		$picname = $pic['picname'];

		if (!M('picactor')->where($map)->delete()) {
			echo "false";
		}

		// 删除演员剧照
		@unlink("./Uploads/Actor/Photos/".$picname);
		@unlink("./Uploads/Actor/Photos/s_".$picname);
		@unlink("./Uploads/Actor/Photos/m_".$picname);

		echo "true";
	}

}