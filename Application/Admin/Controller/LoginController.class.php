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
            'fontSize' => 20
        , // 验证码字体大小
            'length' => 4, // 验证码位数
            'imageH' => 40,
            'imageW' => 150,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    //验证登录
    public function checkLogin(){
        //检查验证码是否正确
        $Verify = new \Think\Verify();
        $code = I('param.code');
        var_dump($code);
        if (!$Verify->check($code)) {
            $this->error(L('验证码错误'));
        }

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $user = M('auser')->where(array('username' => $username))->find();

        if (!$user || $user['password'] != $password ){
            $this->error('帐号或密码错误！');
        }

        if ($user['status']) {
            $this->error('此用户被锁定');
        }

        $data = array(
            'id'    =>  $user['id'],
            'login_time'    =>  time(),
            'login_ip'      =>  get_client_ip(),
        );

        M('auser')->save($data);

        //SESSION
        session(C('USER_AUTH_KEY'), $user['id']);
        session('username', $username);
        session('logintime', date('Y-m-d H:i:s', $data['login_time']));
        session('loginip', $data['login_ip']);

        //超级管理员识别
        if ($user['username'] == C('RBAC_SUPERADMIN')) {
            session(C('ADMIN_AUTH_KEY'), true);
        }

        \Org\Util\Rbac::saveAccessList();

        //跳转至后台首页
        $this->redirect('Index/index');
    }
}