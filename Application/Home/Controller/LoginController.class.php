<?php
/**
 * 前台登录控制器.
 * User: Lancelot
 * Date: 2016/4/26
 * Time: 14:01
 */
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller{

	//进入登陆页面
	public function index(){
		
		$this->display("login");
	}
	
	// //验证码
	// Public function verify(){
		
	// 	import('ORG.Util.Image');
	// 	Image::buildImageVerify();
	// }

	//获取验证码 $id用于生成不同的验证码
    public function verify($id = 1){
        $config = array(
            'fontSize' => 13
        , // 验证码字体大小
            'length' => 4, // 验证码位数
            'imageH' => 30,
            'imageW' => 100,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

	//执行登陆
	public function login(){
		
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$code=md5($_POST['code']);
		//验证码判断
		$verify = new \Think\Verify();
		$code = I('param.code');
		if($code==''){
			$this->error('验证码不能为空！');
		}
		if(!$verify->check($code)) {
			$this->error('验证码输入错误！');
		}
		// if($_SESSION['verify']!=$code){
		// 	$this->error('验证码输入错误！');
		// }
		$m=M("user");
		$where=array("username"=>$username,"password"=>$password);
		$data=$m->where($where)->field("password",true)->find();
		if(!$data){
			$this->error("用户名或密码不正确，请重新输入！");
		}
		
		//判断用户状态
		if($data['disable']!=0){
			redirect(U("/User/forbid"));
		}

		//判断是否可以登录
		if($data){
			$_SESSION['loginuser']=$data;
			//$data['logtimes']++;//用户登录次数加1
			$data['logtimes']++;//用户登录次数加1
			//判断如果不是在同一天登陆
			if(date("Y-m-d",$data['lastlog'])!=date("Y-m-d",time())){
				$data['score']+=1;//用户积分加2
			}
			$data['lastlog'] = time();
			$data['login_ip']   = $_SERVER['REMOTE_ADDR'];
			
			//登陆阶段级别验证
			//创建级别数据库操作对象
			$l = M("Ulevel");
			
			//检索所有的级别信息
			$list = $l->order("level")->select();
			
			//遍历所有级别信息，并判断用户所属级别
			foreach($list as $k=>$v){
				if($data['score']>$v['lscore']){
					//$m->where("id={$_SESSION['loginuser']['id']}")->setField("levle",$k);
					$data['level'] = $v['level'];
				}
			}

			$m->save($data);
			$id=$_GET['id'];
			//echo $id;
			if($id==1){
				header("Location:{$_SERVER['HTTP_REFERER']}");
			}else{
				$this->redirect('Index/index');
			}
		}else{
			$this->error("登录失败！");
		}
	}

	//退出
	function loginout(){
	
		$_SESSION=array();
		if(isset($_COOKIE[session_name()])){
			setcookie(session_name(),'',time()-1,'/');
		}
		session_destroy();
		$this->redirect('Index/index');
	}
}