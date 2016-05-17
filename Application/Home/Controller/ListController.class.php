<?php
/**
 * 前台影评列表入口文件.
 * User: Lancelot
 * Date: 2016/5/15
 * Time: 14:29
 */
namespace Home\Controller;
use Think\Controller;

class ListController extends Controller{

	//浏览影评列表页reviewlist.html
    public function index(){

		//排序方法
		$order="rnum";
		$toptitle="最受欢迎";
		if(!empty($_GET["order"])){
			$order=$_GET["order"];
		}
		if($order=="rnum"){
			$toptitle="最受欢迎";
		}else{
			$toptitle="最新发表";
		}
		
		$this->assign("display","block");
		
		//如果接收到影片的id就显示所有影片相关的影评
		if(!empty($_GET["fid"])){
			$map["fid"]=$_GET["fid"];//添加分页条件
			$where=" r.fid={$_GET['fid']} and";//封装所有影评的查询where条件 显示相关电影影评
			$info=M("Movie")->find($_GET['fid']);
			$toptitle=$info["filmname"];//修改显示的标题头 指定电影名
			$this->assign("display","none");//隐藏副标题头开关 
		}
		
		//分页
		$map["status"]=array("in",array(1,2));
		$count=M("Longreview")->where($map)->count();
		$page=new \Think\Page($count, C('NUM_PER_PAGE'));
		
		//查询所有的影评（按点击率）
		$list=M()->query("select r.id,r.fid,r.uid,r.title,r.content,u.username,m.filmname,m.picname from ll_longreview r,ll_movie m,ll_user u where{$where} r.status in (1,2) and r.fid=m.id and r.uid=u.id order by r.{$order} desc limit {$page->firstRow},{$page->listRows}");
		
		//处理现实的影评内容
		foreach($list as &$v){
			// $v["content"]=wordwrap(strip_tags($v["content"]),120,"<br/>",true);
			$str=strip_tags($v["content"]);
			$str=preg_replace("/[\s\ ]*/","",$str);
			$v["content"]=substr($str,0,450)."......";
			//$v["content"]=strip_tags($v["content"]);
		}

		$this->assign("toptitle",$toptitle);
		//设置分页样式
		$page->setConfig(theme,"%totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% ");
		$this->assign("pageshow",$page->show());
		$this->assign("list",$list);
		//台词
		$this->dialogue();
		//幻灯片
		$this->link();
		$this->display("reviewlist");
	}
	
	//经典台词输出
	public function dialogue(){
		
		$m=M("Dialogue");
		$total=$m->where("status=1")->count();
		$dialogue=$m->where("status=1")->select();
		$this->assign("dialogue",$dialogue[rand(0,$total-1)]);
	}
	
	//排行榜（点击量排行）
	public function movielist(){
		
		$movie = M('movie');     // 实例化movie对象
		// 分页处理
		$Mactor = D('Movie');
		$count = $Mactor->relation('actorlist')->where('status in (1,2)')->count();
		$Page = new \Think\Page($count, C("NUM_PER_PAGE")); // 实例化分页类
		$show = $Page->show();  // 分页显示输出

		// 分页数据查询
		$list = $Mactor->relation('actorlist')->where('status in (1,2)')->order('clicknum desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('tag', "LanceLot电影排行榜".$_GET['tags']);
		
		$this->assign('list', $list);
		$this->assign('page', $show);
		
		//台词
		$this->dialogue();
		//友情链接
		$this->link();
		$this->display("Typelist/tags");
	}

	// top10
	public function movietop(){
		
		$top = M('movie')->order('clicknum desc')->limit(10)->select();
		$this->assign('tag', "Top10排行榜");
		$this->assign('list', $top);
		//友情链接
		$this->link();
		$this->display("Typelist/tags");
	}
	
	//友情链接
	public function link(){
		
		$link=M("Friendlink");
		$this->assign("link",$link->select());
	}	
}
