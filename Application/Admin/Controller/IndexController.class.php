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
    public function updatePassword(){

        $id = session('uid');
        $user = M("auser")->where("id={$id}")->find();

        if(md5($_POST['prepasswd']) != $user['password']){
            $this->error('原密码错误请重新输入！');
        }

        if($_POST['password'] != $_POST['repasswd']){
            $this->error('两次密码不一致');
        }

        $data = array(
            'id'    =>  $id,
            'password'  =>  md5($_POST['password']),
        );

        if(M('auser')->save($data)){
            $this->success('修改密码成功');
            file_put_contents(C("LOG_PATH"),$id." update password success.\n");
        }else{
            $this->error('修改密码失败');
            file_put_contents(C("LOG_PATH"),$id." update password fail.\n");
        }
    }

    //登出
    public function logout(){

        session_unset();
        session_destroy();

        $this->redirect('Login/index');
    }
}