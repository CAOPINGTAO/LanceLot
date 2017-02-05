<?php
namespace Home\Controller;
use Home\Controller\CommonController;

class PrevueController extends CommonController{

	public function index(){
		
		$m=M("Prevue");
		$count=$m->where("status=1")->count();
		$page=new \Think\Page($count,9);
		//排序
		if($_GET["order"]=="a"){
			$order="addtime";
		}else{
			$order="clicknum";
		}
		
		$list=$m->where("status=1")->order("{$order} desc")->limit($page->firstRow.",".$page->listRows)->select();
		foreach($list as &$v){
			$tmp=M("Movie")->field("filmname")->find($v["fid"]);
			$v["filmname"]=$tmp["filmname"];
		}
		//设置分页样式
		$page->setConfig('theme',"%totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first%  %end%");
		$this->assign("page",$page->show());
		$this->assign("list",$list);
		$this->display("videolist");
		
	}
	
	//预告片播放
	public function play(){
		//点击数自增
		M()->query("update ll_prevue set clicknum=clicknum+1 where id={$_GET['id']}");
		
		$video=M("Prevue")->find($_GET["id"]);
		$tmp=M("Movie")->field("filmname")->find($video["fid"]);
		$video["filmname"]=$tmp["filmname"];
		$video["video_play_path"]=C("VIDEO_PLAY_PATH");
		
		$this->assign("video",$video);
		$this->display("prevue");
	}
}