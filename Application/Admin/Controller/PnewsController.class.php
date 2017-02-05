<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;

class PnewsController extends CommonController{

	public function _filter(&$map){

		if (!empty($_REQUEST['_order'])) {
			$order = $_REQUEST['_order']." ".$_REQUEST['_sort'];
		}

		if (!empty($_REQUEST['keyword'])) {
			$where['author'] = array("like", "%{$_REQUEST['keyword']}%");
			$where['title'] = array("like", "%{$_REQUEST['keyword']}%");
			$where['_logic'] = "or";
			$map['_complex'] = $where;
		}

		//状态
		if (!empty($_REQUEST["state"])) {
			$map["state"] = $_REQUEST["state"];
		}

		//类型
		if (!empty($_REQUEST["status"])) {
			$map["status"] = $_REQUEST["status"];
		}
	}

	public function doupload(){

		$resinfo = array("err"=>"","msg"=>"");

		$upload = new \Think\UploadFile();
		$upload->maxSize = 3145728;
		$upload->allowExts = array("jpg", "gif", "png", "jpeg");
		$upload->savePath = './Uploads/News/article/';

		$upload->thumb = true;
		$upload->thumbMaxWidth = '500,300,180';
		$upload->thumbMaxHeight = '330,250,100';
		$upload->thumbPrefix = 'a_,b_,c_';
		$upload->thumbRemoveOrigin = true;

		if (!$upload->upload()) {
			$resinfo['err'] = $upload->getErrorMsg();
		} else {
			$info = $upload->getUploadFileInfo();
			$resinfo['msg'] = __ROOT__."/Uploads/News/article/a_".$info[0]['savename'];
			
			$data['pid'] = 0;
			$data['pica'] = $info[0]['savename'];
			$data['create_time'] = time();
			$id = M("Ppicnews")->add($data);
			$_SESSION['article_img'][] = $id;			
		}

		echo json_encode($resinfo);
		exit();
	}

	public function add(){

		$_SESSION["article_img"] = array();
		$this->display();
	}

	public function insert(){

		$upload = new \Think\UploadFile();
		$upload->maxSize = 3145728;
		$upload->allowExts = array("jpg", "gif", "png", "jpeg");
		$upload->savePath = './Uploads/News/article/';

		$upload->thumb = true;
		$upload->thumbMaxWidth = '90,50';
		$upload->thumbMaxHeight = '90,50';
		$upload->thumbPrefix = "d_,e_";
		$upload->thumbRemoveOrigin = true;

		if (!$upload->upload()) {
			$this->ajaxReturn(getReturnArray(300, "上传失败".(string)($upload->getErrorMsg()), "closeCurrent", "pnewslist"));exit();
		} else {
			$info = $upload->getUploadFileInfo();
			$name = $info[0]['savename'];
		}

		$m = M("Pnews");
		$n = $m->create();

		if (empty($n['content']) && $n['state']==2) {
			$this->ajaxReturn(getReturnArray(300, "请添加新闻内容!", "closeCurrent", "pnewslist"));exit();
		}

		$m->picname = $info[0]['savename'];
		$m->addtime = time();
		if ($result = $m->add()) {
			$m->id = $result;

			$map['id'] = array('in', $_SESSION['article_img']);
			$mod = M("Ppicnews");
			$plist = $mod->where($map)->select();
			if (!empty($plist)) {
				//遍历查出的每个图片
				foreach ($plist as $v) {
					//使用正则匹配并判断图片是否存在，存在则设置ppicnews的pid新闻字段
					if (preg_match("/Uploads\/News\/article\/a_{$v['pica']}/", $_POST['content'])) {
						$mod->where("id={$v['id']}")->setField('pid', $m->id);
					} else {
						//图片不在文章内，则执行删除
						unlink("./Uploads/News/article/a_".$v['pica']);
						unlink("./Uploads/News/article/b_".$v['pica']);
						unlink("./Uploads/News/article/c_".$v['pica']);
					}
				}
			}
			unset($_SESSION['article_img']);

			$this->ajaxReturn(getReturnArray(200, "上传成功", "closeCurrent", "pnewslist"));exit();
		} else {
			$this->ajaxReturn(getReturnArray(300, "上传失败", "closeCurrent", "pnewslist"));exit();
		}
	}

	public function del(){

		$m = M("Pnews");
		$pic = $m->find($_GET['id']);
		$map1['pid'] = $_GET['id'];
		$res = M('Ppicnews')->where($map1)->select();
		foreach ($res as $vo) {
			$map['id'] = $vo['id'];
			unlink('./Uploads/News/article/a_'.$vo['pica']);
			unlink('./Uploads/News/article/b_'.$vo['pica']);
			unlink('./Uploads/News/article/c_'.$vo['pica']);
			M('Ppicnews')->where($map)->delete();
		}
		$map2['id'] = $_GET['id'];
		$list = $m->where($map2)->delete();
		if ($list) {
			unlink('./Uploads/News/article/d_'.$pic['picname']);
			unlink('./Uploads/News/article/e_'.$pic['picname']);
			$this->ajaxReturn(getReturnArray(200, "删除成功", "", "pnewslist"));exit();
		} else {
			$this->ajaxReturn(getReturnArray(300, "删除失败", "", "pnewslist"));exit();
		}
	}

	public function edit(){

		$_SESSION['article_img'] = array();
		$m = M("Pnews");
		$this->assign("vo", $m->find($_GET['id']));
		$this->display();
	}

	public function update(){

		$m = M("Pnews");
		$pic = $m->find($_POST['id']);
		$map['pid'] = $pic['id'];
		$n = $m->create();

		if ($_FILES['picname']['name']) {
			
			$upload = new \Think\UploadFile();
			$upload->maxSize  = 3145728;
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath =  './Uploads/News/article/';
			
			//对上传图片的缩放设置
			$upload->thumb = true;
			$upload->thumbMaxWidth = '90,50';
			$upload->thumbMaxHeight = '90,50';
			$upload->thumbPrefix="d_,e_";
			$upload->thumbRemoveOrigin=true;//删除原图
			
			if(!$upload->upload()) {
				$this->ajaxReturn(getReturnArray(300, "上传失败".(string)($upload->getErrorMsg()), "closeCurrent", "pnewslist"));exit();
			}else{
				$info=$upload->getUploadFileInfo();
				$name=$info[0]['savename'];//获取文件名
			}
			
			unlink('./Uploads/News/article/d_'.$pic['picname']);
			unlink('./Uploads/News/article/e_'.$pic['picname']);
			
			$m->picname=$name; // 保存上传的照片根据需要自行组装
		}

		if (empty($pic['content']) && empty($n['content']) && $n['state']==2) {
			$this->ajaxReturn(getReturnArray(300,"请添加新闻内容！","closeCurrent","pnewslist"));exit();
		}

		if ($m->save()) {
			$res = M('Ppicnews')->where($map)->select();
			foreach ($res as $vo) {
				if (preg_match("/{$vo['pica']}/", $_POST['content'])) {
					# code...
				} else {
					M("Ppicnews")->delete($vo['id']);
					unlink("./Uploads/News/article/a_".$vo['pica']);
					unlink("./Uploads/News/article/b_".$vo['pica']);
					unlink("./Uploads/News/article/c_".$vo['pica']);
				}
			}

			if (!empty($_SESSION['article_img'])) {
				//获取当前文章的所有关联图片
				$mp['id']=array('in',$_SESSION['article_img']);
				$mod=M("Ppicnews");
				$plist = $mod->where($mp)->select();
				if(!empty($plist)){
					//遍历查出的每个图片
					foreach($plist as $v){
						//使用正则匹配并判断图片是否存在
						if(preg_match("/Uploads\/News\/article\/a_{$v['pica']}/",$_POST['content'])){
							$mod->where("id={$v['id']}")->setField('pid',$map['pid']);
						}else{
							//若图片不在文章内，则执行删除。
							$mod->delete($v['id']);
							unlink("./Uploads/News/article/a_".$v['pica']);
							unlink("./Uploads/News/article/b_".$v['pica']);
							unlink("./Uploads/News/article/c_".$v['pica']);
						}
					}
				}
				unset($_SESSION['article_img']);
			}

			$this->ajaxReturn(getReturnArray(200, "修改成功!", "closeCurrent", "pnewslist"));exit();
		} else {
			$this->ajaxReturn(getReturnArray(300, "修改失败!", "closeCurrent", "pnewslist"));exit();
		}
	}

	public function detail(){

		$m=M("Pnews");
		$this->assign("vo",$m->find($_GET['id']));
		$this->display('detail');
	}
}