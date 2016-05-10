<?php
/**
 * 电影信息管理
 * User: Lancelot
 * Date: 2016/5/9
 * Time: 17:56
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class MovieController extends CommonController{

	//搜索条件封装
	public function _filter(&$map){
		//有值则进行封装
		if (!empty($_REQUEST['keyword'])) {
			$where['filmname'] = array('like', "%{$_REQUEST['keyword']}%");
			$where['petname'] = array('like', "%{$_REQUEST['keyword']}%");
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
	}

	//添加影片基本信息
	public function insert(){
		//文件上传
		$upload = new \Think\UploadFile();
		$upload->maxSize = 3145728;

        $upload->thumb = true;
        $upload->thumbMaxWidth = '50,70,100,140';
        $upload->thumbMaxHeight = '50,100,150,200';
        $upload->thumbPrefix = 'a_,b_,c_,d_';

        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->savePath = './Uploads/Movie/Cover/'; //设置附件上传目录

        if (!$upload->upload()) {
        	//上传错误提示
        	 $this->error($upload->getErrorMsg());
        } else {
        	//上传成功，获取上传文件信息
        	$info = $upload->getUploadFileInfo();
        }

        $_POST['showtime'] = strtotime($_POST['showtime']);
        $_POST['picname'] = $info[0]['savename'];
        $_POST['addtime'] = time();

        //添加影片基本信息
        parent::insert();
	}

	/**
	 *	删除影片时
	 *	1. 删除影片的基本信息;
	 *	2. 删除影片的封面图片及相关缩略图
	 *	3. 删除与影片相关联的类别信息
	 **/
	public function delete(){

		$map['id'] = $_GET['id'];
		$movie = M('movie')->where($map)->find();
		$picname = $movie['picname'];

		// 2. 删除影片的封面图片及相关缩略图
		$path = "./Uploads/Movie/Cover";
		unlink($path."/".$picname);
		unlink($path."/a_".$picname);
		unlink($path."/b_".$picname);
		unlink($path."/c_".$picname);
		unlink($path."/d_".$picname);

		// 1. 删除影片基本信息
		parent::delete();
	}

	/*
	 *	更新影片基本信息时
	 * 	1. 判断是否有图片上传，如果有图片上传，则在新图片上传成功后删除原有图片
	 *	2. 如果没有图片上传，则更新其他信息
	 */
	public function update(){

		if($_FILES['picname']['error'] == 4){
			// 没有图片上传时
			$_POST['picname'] = $_POST['pname'];

			$_POST['showtime'] = strtotime($_POST['showtime']);
			parent::update();
		}

		// 删除影片的原封面图片及相关缩略图
		$picname = $_POST['pname'];
		$_POST['showtime'] = strtotime($_POST['showtime']);

		$path = "./Uploads/Movie/Cover";
		unlink($path."/".$picname);
		unlink($path."/a_".$picname);
		unlink($path."/b_".$picname);
		unlink($path."/c_".$picname);
		unlink($path."/d_".$picname);


		// 上传新图片
		$upload = new \Think\UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小

		$upload->thumb = true;
		$upload->thumbMaxWidth  = '50,70,100,140';
		$upload->thumbMaxHeight = '50,100,150,200';
		$upload->thumbPrefix = "a_,b_,c_,d_";

		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Uploads/Movie/Cover/';// 设置附件上传目录

		if(!$upload->upload()) {
			// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{
			// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}

		$_POST['picname'] = $info[0]['savename'];
		parent::update();
	}

	// 查看详情
	public function content(){
		$map['id'] = $_GET['id'];
		$vo = M('movie')->field('content')->where($map)->find();
		$this->assign('content', $vo['content']);
		$this->display();
	}

	// 设置分类视图
	public function setMType(){

		// 获取影片ID
		$movid = $_GET['id'];
		$mt = M('movie_type')->where("fid={$movid}")->select();
	
		if($mt && count($mt)>0){
			$this->error('此影片已设置分类信息！');
			exit();
		}
		$type = M('type')->select();

		$mtype = array('类型' => array(), '国家/地区' => array(), '年代' => array());
		foreach ($type as $vo) {
			if ($vo['fid'] == 1) {
				$mtype1['类型'][] = $vo;			
			}
		}

		foreach ($type as $vo) {
			if ($vo['fid'] == 2) {
				$mtype2['国家/地区'][] = $vo;
			}elseif ($vo['fid'] == 3){
				$mtype2['年代'][] = $vo;
			}
		}

		$this->assign('movie_id', $movid);
		$this->assign('type1', $mtype1);
		$this->assign('type2', $mtype2);
		
		$this->display("setMType");
	}

	// 设置分类表单处理
	public function setTypeHandle(){

		$fid = array_shift($_POST);	
		$movie_type = M('movie_type');
		$movie = M('Movie')->where($fid)->find();

		foreach ($_POST as $value) {
			if (is_array($value)) {
				foreach ($value as $v) {
					$data['fid'] = $fid;
					$data['tid'] = $v;
					if (!$movie_type->data($data)->add()) {
						$this->error("设置失败！");
					}	
				}
			}else{
				$data['fid'] = $fid;
				$data['tid'] = $value;
				if (!$movie_type->data($data)->add()) {
					$this->error("设置失败！");
				}	
			}
		}
		
		$this->success("设置成功！");
	}

	// 查看影片分类
	public function showType(){

		$map['id'] = $_GET['id'];
		$movie = M('movie')->field('id,filmname,addtime')->where($map)->find();

		$mt['fid'] = $movie['id'];
		$mtype = M('movie_type')->field('tid')->where($mt)->select();
		
		foreach ($mtype as $vo) {
			$t['id'] = $vo['tid'];
			$type[] = M('type')->field('fid,typename')->where($t)->find();
		}
		$movie['type'] = $type;

		$this->assign('mt', $movie);
		$this->display();
	}

	// 修改分类视图
	public function edittype(){
		// 获取影片ID
		$movid = $_GET['id'];
		$type = M('type')->select();

		$mtype = array('类型' => array(), '国家/地区' => array(), '年代' => array());
		foreach ($type as $vo) {
			if ($vo['fid'] == 1) {
				$mtype1['类型'][] = $vo;			
			}
		}

		foreach ($type as $vo) {
			if ($vo['fid'] == 2) {
				$mtype2['国家/地区'][] = $vo;
			}elseif ($vo['fid'] == 3){
				$mtype2['年代'][] = $vo;
			}
		}

		$this->assign('movie_id', $movid);
		$this->assign('type1', $mtype1);
		$this->assign('type2', $mtype2);
		$this->display();
	}

	// 修改分类表单处理
	public function editTypeHandle(){
		// 删除影片原有类型
		// var_dump($_POST); 
		M('movie_type')->where("fid = {$_POST['movid']}")->delete();
		
		// 为影片添加新类型
		$fid = array_shift($_POST);
		$movie_type = M('movie_type');
		$movie = M('Movie')->where($fid)->find();

		foreach ($_POST as $value) {
			if (is_array($value)) {
				foreach ($value as $v) {
					$data['fid'] = $fid;
					$data['tid'] = $v;
					if (!$movie_type->data($data)->add()) {
						$this->error("设置失败！");
					}	
				}
			}else{
				$data['fid'] = $fid;
				$data['tid'] = $value;
				if (!$movie_type->data($data)->add()) {
					$this->error("设置失败！");
				}	
			}
		}
		$this->success("设置成功！");
	}

	// 上传剧照视图
	public function uploads(){
		$movid = $_GET['id'];
		$this->assign('movid', $movid);
		$this->display();
	}

	// 上传剧照处理
	public function uploadsHandle(){

		//实例化上传类
		$upload = new \Think\UploadFile();
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Uploads/Movie/mPhotos/';// 设置附件上传目录

		$upload->thumb = true;
		$upload->thumbMaxWidth  = '100';
		$upload->thumbMaxHeight = '100';
		$upload->thumbPrefix = "m_";

		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}

		//添加剧照信息
		$pic = M('filmpic');
		foreach ($info as $val) {
			$data['fid'] = $_POST['id'];
			$data['picname'] = $val['savename'];

			if (!$pic->add($data)) {
				$this->error('添加剧照失败！');
			}
		}

		//修改影片剧照是否设置字段
		M('Movie')->where("id={$_POST['id']}")->setField('hasphotos', 1);
		$this->success('成功设置影片剧照信息！');
	}

	//修改剧照视图
	
}
