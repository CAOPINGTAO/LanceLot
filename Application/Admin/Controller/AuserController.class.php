<?php
/**
 * 后台用户管理
 * User: Lancelot
 * Date: 2016/5/4
 * Time: 18:21
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class AuserController extends CommonController{

    public function index(){

        $order = "id asc";

        //排序条件
        if (!empty($_REQUEST['_order'])) {
            $order = $_REQUEST['_order']." ".$_REQUEST['_sort'];
        }

        //用户总数
        $auser = D('UserRelation')->relation(true)->count();

        //分页处理
        $_GET['p'] = $_REQUEST['pageNum'] + 0;  //当前页号
        //每页显示的记录条数
        $numPerPage = isset($_REQUEST['numPerPage']) ? $_REQUEST['numPerPage'] : C('NUM_PER_PAGE');
        //分页数据查询
        $Page = new \Think\Page($auser, $numPerPage);
        $list = D('UserRelation')->field('password', true)->limit($Page->firstRow.','.$Page->listRows)->relation(true)->select();

        //变量分配
        $this->assign('list', $list);
        $this->assign('totalCount', $auser);                //总记录数
        $this->assign('numPerPage', $numPerPage);           //每页显示记录数
        $this->assign('pageNumShow', C('NUM_PER_PAGE'));    //每页显示记录数
        $this->assign('currentPage', $_REQUEST['pageNum']); //当前页

        $this->display();
    }

    //封装搜索条件
    public function _filter(&$map){
        //搜索条件有值则作封装
        if (!empty($_REQUEST['keyword'])) {
            $where['username'] = array('like', "%{$_REQUEST['keyword']}%");
            $where['fullname'] = array('like', "%{$_REQUEST['keyword']}%");
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
        }
    }

    //搜做结果分页
    public function index2(){
        //搜索条件有值则进行封装
        $where['username'] = array('like', "%{$_REQUEST['keyword']}%");
        $where['fullname'] = array('like', "%{$_REQUEST['keyword']}%");
        $where['_logic'] = 'or';
        $map['_complex'] = $where;
        $map['status'] = $_POST['status'];

        //实例化自定义的模型类UserRelation,是以单例模式实现的。支持跨项目和分组调用
        $auser = D('UserRelation')->where($map)->relation(true)->count();

        //分页处理
        $_GET['p'] = $_REQUEST['pageNum'] + 0;  //当前页码
        $numPerPage = isset($_REQUEST['numPerPage']) ? $_REQUEST['numPerPage'] : C('NUM_PER_PAGE');

        //实例化分类
        $Page = new \Think\Page($auser, $numPerPage);
        //分页查询（获取所有符合查询条件的用户信息，排除password字段）
        $list  = D('UserRelation')->where($map)->field('password', true)->limit($Page->firstRow.','.$Page->listRows)->relation(true)->select();

        //分配变量
        $this->assign('list', $list);
        $this->assign('totalCount', $auser);                    //总记录数
        $this->assign('numPerPage', $numPerPage);               //分页数
        $this->assign('pageNumShow', C('NUM_PER_PAGE'));        //每页显示记录数
        $this->assign('currentPage', $_REQUEST['pageNum']);     //当前页

        $this->display('Auser/index');
    }

    public function insert(){

        $_POST['login_time'] = time();
        $_POST['password'] = md5($_REQUEST['password']);
        $_POST['login_ip'] = get_client_ip();
        parent::insert();
    }

    //分配角色视图
    public function setRole(){

        $id = $_GET['id'];
        $user = M('Auser')->field('id,username,fullname')->where(array('id'=>$id))->find();
        $role = M('role')->select();

        $this->assign('user', $user);
        $this->assign('role', $role);
        $this->display();
    }

    //分配角色处理
    public function setRoleHandle(){

        $uid = $_POST['uid'];   //用户id
        //删除用户原有角色
        M('Role_user')->where(array('user_id'=>$uid))->delete();

        $role = array();
        foreach ($_POST['role_id'] as $v) {
            $role[] = array(
                'role_id'   =>  $v,
                'user_id'   =>  $uid
            );
        }

        if (M('Role_user')->addAll($role)) {
            $this->success('设置成功');
        } else {
            $this->error('设置失败');
        }
    }
}

?>