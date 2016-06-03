<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class CommentController extends CommonController{
	
	//浏览电影新闻评论
	public function index1(){
		//搜索条件有值则做封装
		if(!empty($_REQUEST['keyword'])){
			$where['content']  = array('like', "%{$_REQUEST['keyword']}%");
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
		
		//状态的搜索
		if(!empty($_REQUEST["state"])){
			$map["state"]=$_REQUEST['state'];
		}
		$m=M("Mnewscomment");
		$p=M("Mnews");
		$u=M("User");
		//分页
		$_GET['p']=$_REQUEST['pageNum']+0;//转换参数实现当前页号的传递
		
		$numPerPage=isset($_REQUEST['numPerPage'])?$_REQUEST['numPerPage']:15;
		$count=$m->where($map)->count();//查询满足要求的总记录数
		$Page=new \Think\Page($count,$numPerPage);//实例化分页类 传入总记录数和每页显示的记录数
		
		$list=$m->where($map)->order("addtime desc")->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign("totalCount",$count);//封装总数据条数
		$this->assign("numPerPage",$numPerPage);//封装页大小
		$this->assign("currentPage",$_REQUEST['pageNum']);//当前页
		
		foreach($list as &$v){
			$pnew=$p->field("title")->where("id={$v['nid']}")->select();
			$v['title']=$pnew[0]['title'];
			$user=$u->field("username")->where("id={$v['uid']}")->select();
			$v['username']=$user[0]['username'];
		}
		$this->assign("list",$list);
		$this->display("mnew");
	}

	//浏览人物新闻评论
	public function index2(){
		//搜索条件有值则做封装
		if(!empty($_REQUEST['keyword'])){
			$where['title']  = array('like', "%{$_REQUEST['keyword']}%");
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
		
		//状态的搜索
		if(!empty($_REQUEST["state"])){
			$map["state"]=$_REQUEST['state'];
		}
		
		$m=M("Newscomment");
		$p=M("Pnews");
		$u=M("User");
		
		//分页
		$_GET['p']=$_REQUEST['pageNum']+0;//转换参数实现当前页号的传递
		
		$numPerPage=isset($_REQUEST['numPerPage'])?$_REQUEST['numPerPage']:15;
		$count=$m->where($map)->count();//查询满足要求的总记录数
		$Page=new \Think\Page($count,$numPerPage);//实例化分页类 传入总记录数和每页显示的记录数
		
		$list=$m->where($map)->order("addtime desc")->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign("totalCount",$count);//封装总数据条数
		$this->assign("numPerPage",$numPerPage);//封装页大小
		$this->assign("currentPage",$_REQUEST['pageNum']);//当前页

		foreach($list as &$v){
			$pnew=$p->field("title")->where("id={$v['nid']}")->select();
			$v['title']=$pnew[0]['title'];
			$user=$u->field("username")->where("id={$v['uid']}")->select();
			$v['username']=$user[0]['username'];
		}
		$this->assign("list",$list);
		$this->display("pnew");
	}

	//查看人物新闻评论详情
	public function pcontent(){
		$p=M("Newscomment");
		$this->assign("vo",$p->find($_GET['id']));
		$this->display("pcontent");
	}

	//查看电影新闻评论详情
	public function mcontent(){
		$p=M("Mnewscomment");
		$this->assign("vo",$p->find($_GET['id']));
		$this->display("pcontent");
	}

	//修改人物新闻评论状态
	public function pedit(){
		$m=M("Newscomment");
		$this->assign("vo",$m->find("{$_GET['id']}"));
		$this->display("pedit");
	}

	//执行修改
	public function pupdate(){
		$m=M("Newscomment");
		$m->create();
		if($m->save()){
			$this->ajaxReturn(getReturnArray(200, "修改成功！"));exit();
		}else{
			$this->ajaxReturn(getReturnArray(300, "修改失败！"));exit();
		}
	}
	
	//修改电影新闻评论状态
	public function medit(){
		$m=M("Mnewscomment");
		$this->assign("vo",$m->find("{$_GET['id']}"));
		$this->display("medit");
	}
	
	//执行修改
	public function mupdate(){
		$m=M("Mnewscomment");
		$m->create();
		if($m->save()){
			$this->ajaxReturn(getReturnArray(200, "修改成功！"));exit();
		}else{
			$this->ajaxReturn(getReturnArray(300, "修改失败！"));exit();
		}
	}
}