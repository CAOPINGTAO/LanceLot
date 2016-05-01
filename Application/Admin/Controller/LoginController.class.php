<?php
/**
 * 后台登录控制器类
 * User: Lancelot
 * Date: 2016/5/1
 * Time: 16:19
 */

namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{

    //后台登录视图
    public function index(){

        $this->display();
    }

    //获取验证码 $id用于生成不同的验证码
    public function verify($id = 1){
        $config = array(
            'fontSize' => 16, // 验证码字体大小
            'length' => 4, // 验证码位数
            'imageH' => 40,
            'imageW' => 210,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry($id);
    }

    //验证登录
    public function checkLogin(){
        //检查验证码是否正确
        $Verify = new \Think\Verify();
        $code = I('param.code');
        if ($Verify->check($code) === false) {
            $this->error(L('验证码错误'));
        }

        $username = $_POST['username'];
    }
}