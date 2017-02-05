<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;

class IndexController extends CommonController {
    //首页视图
    public function index(){

        $this->assign('username',session('username'));
        $this->display();
    }

    //修改密码视图
    public function password(){

        $this->assign('uid',session('uid'));
        $this->display();
    }

    //修改密码
    public function updatePasswd(){

        $id = session('uid');
        $user = M('auser')->where("id={$id}")->find();
        $result = array();
        $callbackType = $_REQUEST['callbackType'];

        if(md5($_POST['prepasswd']) != $user['password']){
            $result = getReturnArray(300, "原密码错误，请重新输入！", $callbackType);
            $this->ajaxReturn($result);exit();
        }

        if ($_POST['password'] != $_POST['repasswd']) {
            $result = getReturnArray(300, "两次输入的密码不相同!", $callbackType);
            $this->ajaxReturn($result);exit();
        }
        
        $data = array(
            'id' => session('uid'),
            'password' => md5($_POST['password']),
            );
        
        if (M('auser')->save($data)) {
            $result = getReturnArray(200, "修改密码成功", $callbackType);
            $this->ajaxReturn($result);exit(); 
        }else{
            $result = getReturnArray(300, "修改密码失败", $callbackType);
            $this->ajaxReturn($result);exit();
        }

    }

    //登出
    public function logout(){

        session_unset();
        session_destroy();

        $this->redirect('Login/index');
    }
}