<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;

class MnewsController extends CommonController{

	public function _filter(&$map){

		if (!empty($_REQUEST["_order"])) {
			$order = $_REQUEST["_order"]." ".$_REQUEST["_sort"];
		}

		if (!empty($_REQUEST["keyword"])) {
			$where["author"] = array("like", "%{$_REQUEST['keyword']}%");
			$where["title"] = array("like", "%{$_REQUEST['keyword']}%");
			$where["_logic"] = "or";
			$map["_complex"] = $where;
		}

		//状态
		if (!empty($_REQUEST["state"])) {
			$map["state"] = $_REQUEST["state"];
		}

		if (!empty($_REQUEST["status"])) {
			$map["status"] = $_REQUEST["status"];
		}
	}

	public function doupload(){

		$resinfo = array("err"=>"", "msg"=>"");

		$upload = new \Think\UploadFile();
		$upload->maxSize  = 3145728;
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
		$upload->savePath =  './Uploads/News/article/';
		
		$upload->thumb = true;
		$upload->thumbMaxWidth = '500,300,180';
		$upload->thumbMaxHeight = '330,250,100';
		$upload->thumbPrefix="a_,b_,c_";
		$upload->thumbRemoveOrigin=true;

		if (!$upload->upload()) {
			$resinfo["err"] = $upload->getErrorMsg();
		} else {
			$info = $upload->getUploadFileInfo();
			$resinfo["msg"] = __ROOT__."/Uploads/News/article/a_".$info[0]['savename'];

			//添加图片信息
			$data["mid"] = 0;
			$data["pica"] = $info[0]['savename'];
			$data["create_time"] = time();
			$id = M("Mpicnews")->add($data);
			$_SESSION['article_img'][] = $id;
		}

		echo json_encode($resinfo);
		exit();
	}

	public function add(){
		//先清空SESSION中保存的图片ID号
		$_SESSION['article_img'] = array();
		$this->display("add");
	}

	public function insert(){

		$callbackType = $_REQUEST['callbackType'];
		$navTabId = $_REQUEST['navTabId'];

		$upload = new \Think\UploadFile();
		$upload->maxSize  = 3145728 ;
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
		$upload->savePath =  './Uploads/News/article/';
		
		$upload->thumb = true;
		$upload->thumbMaxWidth = '450,100';
		$upload->thumbMaxHeight = '148,50';
		$upload->thumbPrefix="d_,e_";
		$upload->thumbRemoveOrigin=true;
		
		if(!$upload->upload()) {
			$this->ajaxReturn(getReturnArray(300, "上传失败".(string)($upload->getErrorMsg()),"closeCurrent", "mnewslist"));exit();
		}else{
			$info = $upload->getUploadFileInfo();
		}

		$m = M("Mnews");
		$n = $m->create();

		if (empty($n['content']) && $n['state']==2) {
			$this->error("请添加新闻内容!");
		}

		$m->picname = $info[0]['savename'];
		$m->addtime = time();
		if ($result = $m->add()) {
			$m->id = $result;
			//获取当前文章的所有关联图片
			//条件为图片ID在SESSION保存的文章图片ID数组中
			$map['id'] = array('in', $_SESSION['article_img']);
			$mod = M("Mpicnews");
			$plist = $mod->where($map)->select();
			if (!empty($plist)) {
				//遍历相关的每张图片
				foreach ($plist as $v) {
					//使用正则匹配来判断图片是否存在, 存在则设置图片表中的mid即电影新闻ID字段
					if (preg_match("/Uploads\/News\/article\/a_{$v['pica']}/", $_POST['content'])) {
						$mod->where("id={$v['id']}")->setField('mid', $m->id);
					} else {
						//若图片不在文章内，执行删除
						$mod->delete($v['id']);
						unlink("./Uploads/News/article/a_".$v['pica']);
						unlink("./Uploads/News/article/b_".$v['pica']);
						unlink("./Uploads/News/article/c_".$v['pica']);
					}
				}
			}
			unset($_SESSION['article_img']);
			$this->ajaxReturn(getReturnArray(200, "上传成功", $callbackType, $navTabId));exit();
		} else {
			$this->ajaxReturn(getReturnArray(300, '上传失败', $callbackType, $navTabId));exit();
		}
	}

	public function del(){

		$m = M("Mnews");
		//查询该条新闻的图片信息,删除图片(注意文章中的图片上传时除原图外还生成了3张缩略图)
		$pic = $m->find($_GET["id"]);
		$map1["mid"] = $_GET["id"];
		$res = M("mpicnews")->where($map1)->select();
		foreach ($res as $vo) { // 遍历每张查到的图片,删除资源和数据库信息
			$map["id"] = $vo["id"];
			unlink('./Uploads/News/article/a_'.$vo['pica']);
			unlink('./Uploads/News/article/b_'.$vo['pica']);
			unlink('./Uploads/News/article/c_'.$vo['pica']);
			M("mpicnews")->where($map)->delete();
		}
		//删除新闻
		$map2["id"] = $_GET["id"];	
		$res1 = $m->where($map2)->delete();
		if ($res1) {
			unlink('./Uploads/News/article/d_'.$pic['picname']);
			unlink('./Uploads/News/article/e_'.$pic['picname']);
			$this->ajaxReturn(getReturnArray(200, "删除成功", "", "mnewslist"));exit();
		} else {
			$this->ajaxReturn(getReturnArray(300, "删除失败", "", "mnewslist"));exit();
		}
	}

	public function edit(){

		$_SESSION['article_img'] = array();

		$m = M("Mnews");
		$vo = $m->find($_GET['id']);
		$this->assign("vo", $vo);
		$this->display();
	}

	public function update(){

		$m = M("Mnews");
		$pic = $m->find($_POST['id']);
		$map["mid"] = $pic["id"];
		$n = $m->create();

		if ($_FILES['picname']['name']) {
			
			$upload = new \Think\UploadFile();
			$upload->maxSize  = 3145728 ;
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath =  './Uploads/News/article/';
			
			//对上传图片的缩放设置
			$upload->thumb = true;
			$upload->thumbMaxWidth = '450,100';
			$upload->thumbMaxHeight = '148,50';
			$upload->thumbPrefix="d_,e_";
			$upload->thumbRemoveOrigin=true;
			
			if(!$upload->upload()) {
				$this->ajaxReturn(getReturnArray(300, "上传文件失败".(string)($upload->getErrorMsg())));exit();
			}else{
				$info=$upload->getUploadFileInfo();
				$name=$info[0]['savename'];
			}
			
			unlink('./Uploads/News/article/d_'.$pic['picname']);
			unlink('./Uploads/News/article/e_'.$pic['picname']);
			
			$m->picname=$name;
		}

		if (empty($pic['content']) && empty($n['content']) && $n['state']==2) {
			$this->ajaxReturn(getReturnArray(300,"请添加新闻内容!"));
		}

		if ($m->save()) {
			//上传成功后对该新闻关联的所有图片进行检查，如果其名不再content中，删除
			$res = M("mpicnews")->where($map)->select();
			foreach ($res as $vo) {
				if (preg_match("/{$vo['pica']}/", $_POST['content'])) {
					# code...
				} else {
					M("Mpicnews")->delete($vo['id']);
					unlink("./Uploads/News/article/a_".$vo['pica']);
					unlink("./Uploads/News/article/b_".$vo['pica']);
					unlink("./Uploads/News/article/c_".$vo['pica']);
				}
			}
			if(!empty($_SESSION['article_img'])){
				//获取当前文章的所有关联图片
				$mp['id']=array('in',$_SESSION['article_img']);
				$mod=M("Mpicnews");
				$plist = $mod->where($mp)->select();
				if(!empty($plist)){
					//遍历查出的每个图片
					foreach($plist as $v){
						//使用正则匹配并判断图片是否存在
						if(preg_match("/Uploads\/News\/article\/a_{$v['pica']}/",$_POST['content'])){
							$mod->where("id={$v['id']}")->setField('mid',$map['mid']);
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
			$this->ajaxReturn(getReturnArray(200, "修改成功", "closeCurrent", "mnewslist"));
		} else {
			$this->ajaxReturn(getReturnArray(300, "修改失败", "closeCurrent", "mnewslist"));
		}
	}

	public function detail(){

		$m = M("Mnews");
		$this->assign("vo",$m->find($_GET['id']));
		$this->display('detail');
	}
}