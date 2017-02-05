<?php
namespace Home\Controller;
use Think\Controller;

class ReviewController extends Controller{

	//浏览影评详情页
	public function index(){
		//判断影评是否存在不存在重定向
		$t=M("Longreview")->find($_GET["id"]);
		if(empty($t)){
			redirect(__APP__."/List/index");
		}
		//查看影评浏览次数自增
		M()->query("UPDATE `ll_longreview` SET `vnum`=vnum+1 WHERE ( id={$_GET['id']} )");
		
		//关联查询 详情看Longreviewmodel类($_GET["id"] 影评id)
		//查询影评详情和电影详情
		$review=D("Longreview")->relation("movie")->find($_GET["id"]);
		$tmp=M("user")->find($review["uid"]);
		$review["user"]=$tmp;//添加影评作者
		
		// var_dump($review['content']);die();

		//关联查询影评的类型和演员
		$removie=D("Movie")->relation(true)->find($review["fid"]);
		$review["movie"]["types"]=$removie["typelist"];//类别
		$review["movie"]["actors"]=$removie["actorlist"];//演员
		$this->assign("review",$review);
		//如果有两个where语句后者会覆盖前者注意
		$map["fid"]=$review["fid"];
		$map["status"]=array("in",array(1,2));
		
		//根据影片id 查询相关的影评
		$reviewlist=M("Longreview")->where($map)->limit(5)->order("vnum desc")->select();
		foreach($reviewlist as &$relist){
			$tmp=M("user")->find($relist["uid"]);
			$relist["username"]=$tmp["username"];
		}	
		$this->assign("reviewlist",$reviewlist);
		$this->link();
		$this->display("review");
	}

	//回复列表ajax分页
	public function pageload(){
		//根据影评id 查询相关回复 并分页
		$count=M("Reviewreply")->where("rid=".$_GET["id"])->count();
		$page=new \Think\Page($count,5);
		
		$replylist=M("Reviewreply")->where("rid=".$_GET["id"])->limit($page->firstRow.",".$page->listRows)->order("rtime desc")->select();
		
		//根据用户id 追加用户名 转化时间
		foreach($replylist as &$v){
			$v["rtime"]=date("Y-m-d H:i:s",$v["rtime"]);//转换时间
			$tmp=M("user")->find($v["uid"]);
			$v["username"]=$tmp["username"];
		}
		
		//计算总页数
		$totalpage=ceil($count/5);
		$data=array("totalpage"=>$totalpage,"list"=>$replylist,"maxrows"=>$count);
		echo json_encode($data);
		die();
	}

	//添加影评回复信息
	public function rinsert(){
		if(empty($_SESSION["loginuser"])){
			$_POST["error"]=1;
			echo json_encode($_POST);		
			die();
		}
		$_POST["uid"]=$_SESSION["loginuser"]["id"];
		$_POST["rtime"]=time();//回复时间
		$m=M("Reviewreply");
		$m->create();
		$_POST["id"]=$m->add();
		$_POST["username"]=$_SESSION["loginuser"]["username"];
		if(isset($_POST["id"])){
			//添加成功后动态更新影评的回复数
			$rnum=M("Reviewreply")->where("rid=".$_POST["rid"])->count();
			$data["id"]=$_POST["rid"];
			$data["rnum"]=$rnum;
			M("Longreview")->save($data);
			
			$_POST["rtime"]=date("Y-m-d H:i:s",$_POST["rtime"]);//转换时间
			echo json_encode($_POST);			
		}
		die();
	}

	//删除影评回复的信息
	public function delete(){
		//判断登录的用户id是否是当前(需要修改)
		if(!empty($_SESSION["loginuser"])){
			$m=M("Reviewreply");
			$info=$m->find($_POST["id"]);//发表回复者
			if($info["uid"]==$_SESSION["loginuser"]["id"] || $_SESSION["loginuser"]["id"]==$_POST["uid"]){//帖子发表者
				$m->delete($_POST["id"]);
				echo "true";
				//删除成功更新回复数目
				$rnum=M("Reviewreply")->where("rid=".$info["rid"])->count();
				$data["id"]=$info["rid"];
				$data["rnum"]=$rnum;
				M("Longreview")->save($data);
				exit();
			}
		}
		echo "false";
		exit();
	}

	//删除影评信息和所有回复
	public function del(){
		if(empty($_SESSION["loginuser"])){
			echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
			echo "<script type='text/javascript'>alert('不可以乱动别人的东西！');window.history.back();</script>";
			die();
		}
		$m=M("Longreview");
		$info=$m->find($_GET["id"]);//查找文章的发表者
		
		if($info["uid"]!=$_SESSION["loginuser"]["id"]){
			echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
			echo "<script type='text/javascript'>alert('不可以乱动哦！');window.history.back();</script>";
			die();
		}
		$m->delete($_GET["id"]);
		M("Reviewreply")->where("rid=".$_GET["id"])->delete();//删除回复
		//删除成功后跳转列表页
		redirect(__APP__."/List/index");
	}

	//影评发布并删除没有的图片
	public function insert(){
		if(empty($_SESSION["loginuser"])){
			echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
			echo "<script type='text/javascript'>alert('请先登录！');window.history.back();</script>";
			die();
		}
		$_POST["fid"]=$_GET["fid"];//影片id
		$_POST["uid"]=$_SESSION["loginuser"]["id"];//发表者id
		$_POST["ptime"]=time();//发表时间
		$m=M("Longreview");
		$m->create();
		// var_dump($m);die();
		$rid=$m->add();//添加成功后的影评id
		if(!$rid){
			$this->error("发表失败！");
			return;
		}
	
		//添加成功后更新评论数
		$sum=0;
		$sum+=M("Longreview")->where("fid=".$_GET["fid"])->count();
		$sum+=M("Shortreview")->where("fid=".$_GET["fid"])->count();
		M("Movie")->query("update ll_movie set replynum={$sum} where id={$_GET['fid']}");
	
		//获取当前文章的所有关联图片
		$map["id"]=array("in",$_SESSION["review_img"]);
		
		$rpic=M("Reviewpic");
		$plist=$rpic->where($map)->select();
		
		//有图片数据进行过滤
		if($plist){
			foreach($plist as $v){
				//判断正则匹配照片是否在影评内容中
				if(preg_match("/\/Uploads\/Review\/{$v['picname']}/",$_POST["content"])){
					//存在修改照片的所属的影评id
					$rpic->where("id=".$v["id"])->setField("rid",$rid);
				}else{
					//图片不在文章则删除库数据和图片文件
					$rpic->delete($v["id"]);
					unlink("./Uploads/Review/".$v["picname"]);
				}
			}
		}
		unset($_SESSION["review_img"]);
		
		//回复成功后积分添加
		M()->query("update ll_user set score=score+10 where id={$_SESSION['loginuser']['id']}");
		
		redirect(U("/Review/index/id/{$rid}"));
	}

	public function judge(){
		if(empty($_SESSION["loginuser"])){
			echo 1;
			die();
		}
		$vo=M("Longreview")->find($_GET["id"]);
		if($vo["uid"]!=$_SESSION["loginuser"]["id"]){
			echo 1;
			die();
		}
		
		echo 2;//用户信息判断成功
		die();
	}

	//影片修改页面
	public function edit(){
		if(empty($_SESSION["loginuser"])){
			echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
			echo "<script type='text/javascript'>alert('不可以乱动哦！');window.history.back();</script>";
			die();
		}
		
		$_SESSION['article_img']=array();//清空session
		$vo=M("Longreview")->find($_GET["id"]);
		if($vo["uid"]!=$_SESSION["loginuser"]["id"]){
			echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
			echo "<script type='text/javascript'>alert('不可以乱动哦！');window.history.back();</script>";
			die();
		}
		
		$this->assign("vo",$vo);
		$this->display("edit");
	}

	//影评修改
	public function update(){
		$rid=$_POST["id"];//回去修改的影评id
		$_POST["ptime"]=time();//修改时间
		$m=M("Longreview");
		$m->create();
		if(!($m->save())){
			$this->error("修改失败");
		}
		//获取所有关联的图片	
		$mod=M("Reviewpic");
		$tmpimg=$mod->where("rid=".$rid)->field("id")->select();//原来数据中存在的图片
		//都放入session中一起进行判断筛选
		foreach($tmpimg as $k){
			$_SESSION["review_img"][]=$k["id"];
		}
		
		$map["id"]=array("in",$_SESSION["review_img"]);
		$plist=$mod->where($map)->select();

		//有结果进行判断
		if($plist){
			foreach($plist as $v){
				if(preg_match("/\/Uploads\/Review\/{$v['picname']}/",$_POST["content"])){
					//如果图片在文章中保存 修改rid
					$mod->where("id=".$v["id"])->setField("rid",$rid);
				}else{
					//如果图片不在文章中则删除图片文件的数据库数据
					$mod->delete($v["id"]);
					unlink("./Uploads/Review/".$v["picname"]);
				}
			}
		}
		unset($_SESSION["review_img"]);
		redirect(__CONTROLLER__."/index/id/{$rid}");
	}

	//编辑器图片上传接口
	public function upload(){
		//上传成功后的结果必须是json格式
		$res=array("err"=>"","msg"=>"");

		$upload=new \Think\UploadFile();
		$upload->maxSize=3145728;//上传大小
		$upload->allowExts=array("jpg","png","jpeg","gif");//设置上传类型
		$upload->savePath="./Uploads/Review/";//设置附件上传目录
		//判断成功与否
		if(!$upload->upload()){
			$res["err"]=$this->error($upload->getErrorMsg());//获取上传的错误信息
			
		}else{
			$info=$upload->getUploadFileInfo();
			$res["msg"]=__ROOT__."/Uploads/Review/".$info[0]["savename"];//获取上传的图片名加路径
			
			//数据库执行图片信息的添加
			$data["tbname"]="longreview";//影评表名
			$data["rid"]=0;//影评id 默认为0 是无主图片 如果成功发表就修改为影评的id
			$data["picname"]=$info[0]["savename"];//图片名
			$data["create_time"]=time();//添加时间
			$id=M("reviewpic")->add($data);//添加并放回图片的id
			$_SESSION["review_img"][]=$id;//保存所有添加过的图片id
		}
		//返回编辑器插件
		echo json_encode($res);
		exit();//防止后面追加内容
		
	}
	
	//友情链接
	public function link(){
		$link=M("Friendlink");
		$this->assign("link",$link->select());
	}
}