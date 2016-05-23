<?php
/**
 * 用户个人中心
 * User: Lancelot
 * Date: 2016/5/2
 * Time: 13:21
 */

namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{

		//浏览用户中心首页
		public function index(){
			//获得用户id
			$id = $_GET['uid'];
			
			//获得来访者id
			$vid = $_SESSION['loginuser']['id'];

			//创建数据库操作对象
			$user = D("User");
			
			//创建来访表操作对象
			$v = M("Visitor");
			
			//获取当前用户的来访数
			$vcount = $v->where("uid={$id}")->count();
			
			//获得当前用户的来访情况
			$vlist = $v->where("uid={$id}")->order("vtime desc")->select();
			
			//判断用户是否近期来访过，如果还有记录，删除记录执行更新
			$v->where("uid={$id} and vid={$vid}")->delete();
			
			if($_SESSION['loginuser'] != null  and $id != $vid){ //必须是登陆用户才能记载
				//判断用户来访数量
				if($vcount<9){
					//用户来访数小于8，直接添加
					$data['uid'] = $id;
					$data['vid'] = $vid;
					$data['vtime'] = time();
					
					$v->data($data)->add();
				}else{
					//用户来访数大于8，执行队列操作,删除最久一条
					$v->where("uid={$uid}")->order("addtime asc")->limit("1")->delete();
					
					//执行添加
					$data['uid'] = $id;
					$data['vid'] = $vid;
					$data['vtime'] = time();
					$v->data($data)->add();
				}
			}

			//遍历来访者信息并追加
			foreach($vlist as &$vi){
				//获得每个来访者的名称信息
				$visitorname = $user->where("id={$vi['vid']}")->getField("username");
				
				//将获得的用户名追加
				$vi['visitorname'] = $visitorname;
			}
			
			//获取用户喜欢的电影类型
			$mytypelist = $user->field("password",true)->relation("mytypes")->find($id);
			
			//获取用户全部信息
			$vo = $user->field("password",true)->relation(true)->find($id);

			//判断是否存在该用户
			if($id==null || $vo == null){
				//不存在该用户，直接跳回自己的页面
				redirect(U("/User/index/uid/{$_SESSION['loginuser']['id']}"));
			}
			
			//判断用户是否被禁言
			if($vo['disable']!=0){
				redirect(U("/User/forbid"));
			}
			
			//查询用户级别的名称，并封装
			$vo['levelname'] = M("Ulevel")->where("level={$vo['level']}")->getField("levelname");
			
			//得到长评的电影信息放入长评对应字段中
			$vo['longreview'][0]['filmname']= M('Movie')->where("id={$vo['longreview'][0]['fid']}")->getField("filmname");
			$vo['longreview'][0]['picname'] = M('Movie')->where("id={$vo['longreview'][0]['fid']}")->getField("picname");
			$str = strip_tags($vo['longreview'][0]['content']);
			$str=preg_replace("/[\s\ ]*/","",$str);
			$vo['longreview'][0]['content']=substr($str,0,450)."......";

			//得到短评的电影信息放入短评对应字段中
			$vo['shortreview'][0]['filmname']= M('Movie')->where("id={$vo['shortreview'][0]['fid']}")->getField("filmname");
			$vo['shortreview'][0]['picname'] = M('Movie')->where("id={$vo['shortreview'][0]['fid']}")->getField("picname");
			
			//得到回复的影评信息以及对应的电影信息放入回复对应字段中
			$vo['reviewreply'][0]['retitle']= M('Longreview')->where("id={$vo['reviewreply'][0]['rid']}")->getField("title");
			$vo['reviewreply'][0]['fid']= M('Longreview')->where("id={$vo['reviewreply'][0]['rid']}")->getField("fid");
			
			$vo['reviewreply'][0]['filmname'] = M('Movie')->where("id={$vo['reviewreply'][0]['fid']}")->getField("filmname");
			$vo['reviewreply'][0]['picname'] = M('Movie')->where("id={$vo['reviewreply'][0]['fid']}")->getField("picname");
			
			$str = strip_tags($vo['reviewreply'][0]['content']);
			$str=preg_replace("/[\s\ ]*/","",$str);
			$vo['reviewreply'][0]['content']=substr($str,0,450)."......";
			
			//日志信息截取
			$str = strip_tags($vo['diary'][0]['content']);
			$str=preg_replace("/[\s\ ]*/","",$str);
			$vo['diary'][0]['content']=substr($str,0,450)."......";
			
			
			//获得留言者信息
			$vo['message'][0]['username'] = M('User')->where("id={$vo['message'][0]['uid2']}")->getField("username");
			
			//留言信息截取
			$str = strip_tags($vo['message'][0]['content']);
			$str=preg_replace("/[\s\ ]*/","",$str);
			$vo['message'][0]['content']=substr($str,0,450)."......";
			
			//创建关注表数据库操作对象
			$m = M("Attention");
			
			//获得当前用户关注对象的id列表
			$iattlist = $m->where("uid={$id}")->getField("bid",true);
			$vo['iattnum'] = count($iattlist); //获得我关注的人数
			
			//获得关注当前用户的对象的id列表
			$attmelist = $m->where("bid={$id}")->getField("uid",true);
			$vo['attmenum'] = count($attmelist); //获得关注我的人数
			
			//判断我是否关注当前用户
			if(in_array($_SESSION['loginuser']['id'],$attmelist)){
				$vo['attstatus'] = "true"; //追加关注状态
			}
			
			//两者取交集，获得互粉的数组列表
			$hufenlist = array_intersect($iattlist,$attmelist);
			$vo['hufennum'] = count($hufenlist); //获得互粉的人数

			//随机取出5个好友，并遍及出其图片信息
			$myfriendlist = array(); //定义数组用来保存好友信息
			
			//定义最大循环次数
			$num = $vo['hufennum']<5?$vo['hufennum']:5;
			
			//循环遍历
			for($i=0;$i<$num;$i++){
				$myfriendlist[] = $user->field("id,username,headpic")->find($hufenlist[$i]);
			}
			
			//获得七天之后的时间戳
			$endday = strtotime(date("Y-m-d",strtotime("+7 day")));
			
			//设定接收数组
			$birthdaylist = array();
			
			//计数器 只取6个
			$bnum = 0;
			
			//遍历好友
			foreach($hufenlist as $b){
				if($bnum==6){
					break;
				}
				//获得该好友的生日，并转化成今年时间戳
				$fbirthday = M("User")->where("id={$b}")->getField("birthday");
				
				//获得好友月份及日期
				$arr = explode("-",$fbirthday);
				$m = $arr[1];
				$d = $arr[2];
				
				$fbirthtime = mktime(0,0,0,$m,$d);
				
				//判断当前用户今年生日是不是在七天之内
				if($fbirthtime>time() && $fbirthtime<$endday){
					$birthdaylist[] = $user->field("id,username,birthday")->find($b);
					$bnum++;
				}
			}
			
			//获得喜欢类型总数
			$mytypenum = count($mytypelist['mytypes']);
			
			//追加到用户中
			$vo['mytypenum'] = $mytypenum;
			
			//创建相册数据库操作对象
			$p = M("Photoalbum");
			
			//获得该用户最新5个相册
			$photolist = $p->where("uid={$id}")->order("addtime desc")->limit("5")->select();
			
			//向首页放置信息
			$this->assign("vo",$vo);
			$this->assign("myfriendlist",$myfriendlist);
			$this->assign("mytypes",$mytypelist['mytypes']);
			$this->assign("vlist",$vlist);
			$this->assign("photolist",$photolist);
			$this->assign("birthdaylist",$birthdaylist);
			
			//加载模板并输出
			$this->display("index");
		}
		
		//用户资料浏览页
		public function myinfo(){
			//创建数据库操作对象
			$m = D("User");
			
			//获取用户信息
			$vo = $m->relation("mytypes")->find($_GET['uid']);
			
			//讲信息输出到前台
			$this->assign("vo",$vo);
			
			//载入模板并输出
			$this->display("myinfo");
		}
		
		//用户资料修改页
		public function changemyinfo(){
			//判断是否是本用户	
			if($_SESSION['loginuser']['id'] != $_GET['uid']){
				$this->error("非本用户，无权操作");
			}
		
			//创建数据库操作对象
			$m = M("user");
			
			//获取用户信息
			$vo = $m->find($_SESSION['loginuser']['id']);
			
			//讲信息输出到前台
			$this->assign("vo",$vo);
			
			//加载模板并输出
			$this->display("changemyinfo");
		}
		
		//执行用户资料修改
		public function dochangeinfo(){
			//判断是否是本用户	
			if($_SESSION['loginuser']['id'] != $_POST['id']){
				$this->error("非本用户，无权操作");
			}
			
			if($_POST['name']==null){
				$this->error("姓名不能为空");
			}
			
			if(!preg_match("/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/",trim($_POST['email']))){
				$this->error("邮箱格式错误");
			}
			
			//获得数据库操作对象
			$m = M("User");

			//获取数据进行封装
			$data['id'] = $_SESSION['loginuser']['id'];
			$data['name'] = $_POST['name'];
			$data['email'] = $_POST['email'];
			$data['sex'] = $_POST['sex'];
			$data['birthday'] = $_POST['birthday'];
			$data['address'] = $_POST['address'];
			
			//执行修改并判断结果
			if($m->save($data)){
				//修改成功
				redirect(U("/User/myinfo/uid/{$_SESSION['loginuser']['id']}"));
			}else{
				//修改失败
				$this->error("修改失败");
			}	
		}
		
		//用户密码修改表单
		public function changepass(){
			//判断是否是本用户	
			if($_SESSION['loginuser']['id'] != $_GET['uid']){
				$this->error("非本用户，无权操作");
			}
			
			//加载模板并输出
			$this->display("changepass");
		}
		
		//执行用户密码修改
		public function dochangepass(){	
			//获得前台表单数据
			$oldpass = $_POST['oldpass'];
			$newpass = $_POST['newpass'];
			$repass = $_POST['repass'];
			
			//判断两次密码输入是否一致
			if($newpass != $repass){
				$this->error("新密码两次输入不一致");
				exit();
			}
			
			//判断用户原密码是否正确
			$username = $_SESSION['loginuser']['username'];
			$password = md5($oldpass);
			$m = M("user");
			$where = array("username"=>$username,"password"=>$password);
			$data = $m->where($where)->find();
			if(!$data){
				$this->error("原密码输入错误，请重新输入！");
				exit();
			}
			
			//通过判断，执行更改
			$newpass = md5($newpass);
			if($m->where("id={$_SESSION['loginuser']['id']}")->setField("password",$newpass)){
				//修改成功
				$this->success("密码修改成功",U("User/myinfo/uid/{$_SESSION['loginuser']['id']}"));
			}else{
				//修改失败
				$this->error("密码修改失败");
			}
		}
		
		//载入替换头像页面
		public function changepic(){
			//载入头像修改页面
			$this->display("changepic");
		}
		
		//执行图片上传方法
		public function doupload(){

			$upload = new \Think\UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Uploads/User/Headpic/';// 设置附件上传目录
			$newfile="null";
			if(!$upload->upload()) {// 上传错误提示错误信息
				//$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				$newfile = $info[0]['savename']; // 保存上传的照片根据需要自行组装
			}
			echo "<script>window.parent.doLoad('{$newfile}');</script>";
			exit();
		}
		
		//执行确定图片裁剪
		public function dochangepic(){
				//获得用户id
				$id = $_SESSION['loginuser']['id'];

				//获得图片名称
				$headpic = $_POST['headpic'];
		
				//获得数据库操作对象
				$m = M("User");
				
				//获得用户之前头像信息箱
				$oldheadpic = $m->where("id={$id}")->getField("headpic");
				
				//删除原图
				unlink("./Uploads/User/Headpic/".$oldheadpic);
				
				//执行图片名保存
				$m->where("id={$id}")->setField("headpic",$headpic);
				$_SESSION['loginuser']=$m->field("password",true)->find($id);
				
				redirect(U("/User/myinfo/uid/{$id}"));
		}
		
		//执行图片裁剪
		public function doCrop(){
			//获取要裁剪的信息
			$sx=$_POST['sx'];	//裁剪x起始坐标
			$sy=$_POST['sy'];	//裁剪y起始坐标
			$sw=$_POST['sw'];	//裁剪宽度
			$sh=$_POST['sh'];	//裁剪高度
			$picname=$_POST['picname']; //被裁剪的图片名
			$path='./Uploads/User/Headpic/';//图片目录路径
			
			cropImage($picname,$path,$sx,$sy,$sw,$sh,""); 
			//最后一个参数是指定图片前缀（值为“”表示覆盖原图片）
			exit("ok");
		}
		
		//公告列表页载入
		public function noticelist(){
			//判断用户是否登录
			if($_SESSION['loginuser']==null){
				$this->error("必须登陆才可以发相册");
			}
			
			//获得页面的uid
			$uid = $_GET['uid'];
			
			//获得当前用户id判断是否是同一个人
			if($uid != $_SESSION['loginuser']['id']){
				$this->error("无法查看他人的公告");
			}
		
			//创建数据库操作对象
			$m = M("notice");

			$count      = $m->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $m->where("status=1")->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();

			//向模板放置信息
			$this->assign("listtitle","公告列表");
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出

			//加载模板并输出
			$this->display("noticelist");
		}
		
		//公告内容页面载入
		public function mynotice(){
			//判断用户是否登录
			if($_SESSION['loginuser']==null){
				$this->error("必须登陆才可以发相册");
			}

			//获得传递过来的公告ID
			$uid = $_GET['uid'];
			
			//获得公告id
			$id = $_GET['id'];
			
			//获得当前用户id判断是否是同一个人
			if($uid != $_SESSION['loginuser']['id']){
				$this->error("无法查看他人的公告");
			}
			
			//创建数据库操作对象
			$m = M("notice");
			
			//获取具体公告信息
			$vo = $m->find($id);
			
			//向模板输出信息
			$this->assign("vo",$vo);
			
			//加载模板并输出
			$this->display("mynotice");
		}
		
		//个人影评列表页
		public function mylongreview(){
			//获取前台用户ID信息
			$id = $_GET['uid'];
			
			//创建数据库操作对象，获取用户信息
			$username = M("User")->where("id={$id}")->getField("username");

			//设定搜索条件
			$map['uid'] = $id;
			$map['status']=array("in",array(1,2));
						
			//获取总数据条数
			$count = M("Longreview")->where($map)->count();
			
			//获取总页数
			$totalPages = ceil($count/10);
			
			//创建分页对象
			$page = new \Think\Page($count,10);
			
			//分页显示输出
			$show = $page->show();
			
			//搜索所有该用户影评信息
			$list = M("Longreview")->order("ptime desc")->where($map)->limit($page->firstRow.",".$page->listRows)->select();
			
			//遍历该用户影评信息，获得电影相关信息
			foreach($list as &$v){
				$fid = $v['fid'];
				//获得电影操作对象，获得信息
				$film = M("Movie")->find("{$fid}");
				
				$v['filmname'] = $film['filmname']; //获得对应电影名并保存
				$v['picname'] = "b_".$film['picname']; //获得对应电影封面图片
				
				//处理影评长度
				$str=strip_tags($v["content"]);
				$str=preg_replace("/[\s\ ]*/","",$str);
				$v["content"]=substr($str,0,450)."......";
			}
			
			//向模板引擎加载信息
			$this->assign("listtitle",$username."的影评");
			$this->assign("list",$list);
			$this->assign("page",$show);
			
			//加载模板并输出
			$this->display("mylongreview");
		}
		
		//个人用户站内信列表
		public function letterlist(){
			//获得当前用户id
			$uid = $_SESSION['loginuser']['id'];
			
			//创建站内信数据库操作对象
			$m = M("Uletter");

			$count      = $m->where("uid={$uid}")->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出
			
			//执行查询
			$letterlist = $m->where("uid={$uid}")->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			
			//遍历处理信息
			foreach($letterlist as &$v){
				$str=strip_tags($v["content"]);
				$str=preg_replace("/[\s\ ]*/","",$str);
				$v["content"]=substr($str,0,450)."......";
			}
			
			//向模板引擎放置信息
			$this->assign("listtitle","我的站内通知");
			$this->assign("list",$letterlist);
			
			//载入信息列表模板
			$this->display("letterlist");
		}
		
		//个人用户站内信内容页
		public function myletter(){
			//获取用户id
			$uid = $_SESSION['loginuser']['id'];
			
			//获取站内信id
			$lid = $_GET['lid'];
			
			//创建站内信数据库操作对象
			$m = M("Uletter");
			
			//修改站内信状态
			$m->where("id={$lid}")->setField("status",1);
			
			//获得站内信信息
			$vo = $m->find($lid);
			
			//将信息载入到模板
			$this->assign("vo",$vo);
			
			//加载模板并输出
			$this->display("myletter");
		}
		
		//载入用户禁止页面
		public function myforbid(){
			//获得用户id
			$uid = $_GET['id'];
			
			//创建数据库操作对象
			$user = M("User");
			
			//获得用户信息
			$vo = $user->find($uid);
			
			//向模板中加载信息
			$this->assign("vo",$vo);
			
			//载入模板
			$this->display("myforbid");
		}
}
