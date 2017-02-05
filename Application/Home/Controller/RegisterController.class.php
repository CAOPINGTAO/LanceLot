<?php
namespace Home\Controller;
use Home\Controller\CommonController;

class RegisterController extends CommonController{

	//进入用户注册页面
	public function register(){
		
		$this->display('register');
	}

	//验证码
	// Public function verify(){
	// 	import('ORG.Util.Image');
	// 	Image::buildImageVerify();
		
	// }
	
	//执行注册
	public function req(){
		$data['username']=$_POST['username'];
		$data['password']=md5($_POST['password']);
		$data['email']=$_POST['email'];
		$data['addtime']=time();
		$data['lastlog']=time();
		// $code=md5($_POST['code']);
		$m=M('User');
		$where['username']=$data['username'];
		$list=$m->where($where)->find();
		//判断
		if($data['username']==''){
			$this->error('用户名不能为空，请重新注册！');
		}elseif($data['email']==''){
			$this->error('邮箱不能为空！');
		}elseif($data['username']==$list['username']){
			$this->error('用户已被注册！');
		}else{
			//添加用户
			$_SESSION['username']=$data['username'];
			$data['score']=10;//新注册用户积分为10
			$data['logtimes']=1;//新注册用户登录次数为1	
			$user=D('User')->add($data);
			if($user){
				$this->success('注册成功！恭喜！您获得10积分！','__APP__/Login/index');
			}
		}
	}

	//验证用户名是否被注册
	public function docode(){
		
		$name = $_GET['name']; //获取要验证的用户信息
		
		$m=M("User");
		$user=$m->field('username')->select();
		$a=array();
		foreach($user as $v){
			$a[]=$v['username'];
		}
		
		if(in_array($name,$a)){
			echo "aa";
		}else{
			echo "bb";
		}
		
	}
}