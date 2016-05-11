<?php
/**
 * 后台项目公共控制器类
 * User: Lancelot
 * Date: 2016/4/28
 * Time: 13:09
 */

namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{

    //自动登录验证
    public function _initialize(){

        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->redirect('Login/index');
        }
        //echo MODULE_NAME;

        //判断该控制器/方法 是否需要验证
        $notAuth = in_array(MODULE_NAME, explode(',',C('NOT_AUTH_ACTION'))) || in_array(ACTION_NAME, explode(',',C('NOT_AUTH_ACTION')));

        if (C('USER_AUTH_ON') && !$notAuth) {
            import('ORG.Util.RBAC');
            \Org\Util\Rbac::AccessDecision() || $this->error("没有权限");
        }
    }

    public function index(){
        //列表过滤器，生成查询Map对象(该数据对象的全部字段信息)
        $map = $this->_search();
        if(method_exists($this,'_filter')) {
            $this->_filter($map);
        }
        //判断采用自定义的model类
        if(!empty($_POST["actionName"])) {
            $model = D($_POST["actionName"]);
        } else {
            $model = M(CONTROLLER_NAME);
        }

        //根据条件进行查询，然后分配到视图模版中
        if(!empty($model)){
            $this->_list($model, $map);
        }

        $this->display();
        return;
    }

    public function add(){
        $this->display('add');
    }

    public function insert(){

        $model = D(CONTROLLER_NAME);
        unset( $_POST[$model->getPk()]);

        if($model->create() === false) {
            $this->error($model->getError());
        }
        //保存当前数据对象
        if ($result = $model->add()){ //保存成功
            //回调接口
            if (method_exists($this, '_tigger_insert')) {
                $model->id = $result;
                $this->_tigger_insert($model);
            }
            var_dump($result);
            //成功提示
            $this->success('新增成功');
        } else {
            //失败提示
            var_dump($result);
            $this->error('新增失败'.$model->getLastSql());
        }

    }

    public function edit(){
        $model = M(CONTROLLER_NAME);
        $id = $_REQUEST[$model->getPk()];
        $vo = $model->find($id);
        $this->assign('vo', $vo);
        $this->display('edit');
    }

    public function update(){
        $model = D(CONTROLLER_NAME);

        if($model->create() === false) {
            $this->error($model->getError());
        }
        //更新数据
        if($model->save() !== false) {
            //回调接口
            if (method_exists($this, '_tigger_update')) {
                $this->_tigger_update($model);
            }
            //成功提示
            $this->success(L('更新成功'));
        } else {
            //失败提示
            $this->error(L('更新失败'));
        }
    }

    public function delete(){
        //删除指定记录
        $model = M(CONTROLLER_NAME); //实例化控制器模型
        if (!empty($model)) {
            $pk = $model->getPk(); //获取主键
            $id = $_REQUEST[$pk];
            if (isset($id)) {   //如果设置了主键给予删除，否则为非法操作
                $condition = array($pk => array('in', explode(',', $id))); //设置删除条件
                if ($model->where($condition)->delete() !== false) {
                    $this->success('删除成功');
                } else {
                    $this->error('删除失败');
                }
            } else { //没有设置主键，则为非法操作
                $this->error('非法操作');
            }
        }
    }

    //将删除状态置为1
    public function delete_tag(){
        $model = M(CONTROLLER_NAME);
        if (!empty($model)) {
            $pk = $model->getPk();
            $id = $_REQUEST[$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                if ($model->where($condition)->setField('is_delete', 1) !== false) { //设置is_delete字段为1
                    $this->success(L('删除成功'));
                } else {
                    $this->error(L('删除失败'));
                }
            } else {
                $this->error('非法操作');
            }
        }
    }

    /**
     * 根据传递过来的表单生成查询条件
     * 进行列表过滤，过滤掉以'_'开头的数据表
     * @param string $name 数据对象名称即数据表名称
     * @return HashMap
     */
    protected function _search($name=''){
        //生成查询条件
        if (empty($name)) {
            $name = CONTROLLER_NAME;
        }
        $model = M($name);
        $map = array();
        //对当前数据对象的全部字段进行条件封装
        foreach ($model->getDbFields() as $key => $val) {
            if (substr($key, 0, 1) == '_')
                continue;
            if (isset($_REQUEST[$val]) && $_REQUEST[$val] != '') {
                $map[$val] = $_REQUEST[$val];
            }
        }
        return $map;
    }

    /**
     * 根据查询条件进行查询并分配变量到视图模板
     * 进行列表过滤
     * @param $model            数据对象
     * @param array $map        过滤条件
     * @param string $sortBy    排序
     * @param bool $asc         是否升序
     */
    protected function _list($model, $map = array(), $sortBy = '', $asc = false) {

        //用于排序的字段，默认为主键字段
        if (!empty($_REQUEST['_order'])) {
            $order = $_REQUEST['_order'];
        } else {
            $order = !empty($sortBy)?$sortBy:$model->getPk();
        }

        //排序方式默认按照倒序的方式
        //接受 sort参数 0表示降序（倒序），非0都表示升序（顺序）
        if (!empty($_REQUEST['_sort'])) {
            $sort = $_REQUEST['_sort'] == 'asc'?'asc':'desc';
        } else {
            $sort = $asc ? 'asc':'desc';
        }

        //取得满足条件的记录数
        $count = $model->where($map)->count();

        //每页显示的记录数
        if (!empty($_REQUEST['numPerPage'])) {
            $listRows = $_REQUEST['numPerPage'];
        } else {
            $listRows = C('NUM_PER_PAGE');
        }

        //设置当前页码
        if (!empty($_REQUEST['pageNum'])) {
            $nowPage = $_REQUEST['pageNum'];
        } else {
            $nowPage = 1;
        }
        $_GET['p'] = $nowPage;

        //创建分页对象
        $p = new \Think\Page($count, $listRows);

        ////检查到Movie表（MyISAM）因mysql服务异常关闭而损坏
        // var_dump($map);
        // echo "<br>-------".$count."-------<br>";
        // echo "<br>Order:".$order;
        // echo "<br>Sort:".$sort;
        // echo "<br>firstRow:".$p->firstRow;
        // echo "<br>listRows:".$p->listRows;
        //分页数据查询
        $list = $model->where($map)->order($order.' '.$sort)->limit($p->firstRow.','.$p->listRows)->select();

        //回调函数，用于数据加工，例如将用户的id替换成用户名
        if (method_exists($this, '_tigger_list')) {
            $this->_tigger_list($list);
        }
        //分页跳转的时候保证查询条件
        foreach ($map as $key => $val) {
            if (!is_array($val)) {
                $p->parameter .= "$key=" . urlencode($val) . "&";
            }
        }

        //分页显示
        $page = $p->show();

        //列表排序显示
        $sortImg = $sort; //排序图标
        $sortAlt = $sort == 'desc' ? '升序排列' : '降序排列'; //排序提示
        $sort = $sort == 'desc' ? 1 : 0; //排序方式

        // var_dump($list);die();
        //模版赋值显示
        $this->assign('list', $list);
        $this->assign('sort', $sort);
        $this->assign('order', $order);
        $this->assign('sortImg', $sortImg);
        $this->assign('sortType', $sortAlt);
        $this->assign("page", $page);

        $this->assign("search",     $search);           //搜索内省
        $this->assign("values",     $_POST['values']);  //搜索框内容
        $this->assign("totalCount", $count);            //总体数
        $this->assign("numPerPage", $p->listRows);      //每页显示条数
        $this->assign("currentPage",    $nowPage);      //当前页码
    }

    /**
     * 添加事件方法
     * @param $type     事件类型，参考事件Controller类属性
     * @param $content  事件内容
     * @param string $jsoninfo
     */
    protected function addEvent($type, $content, $jsoninfo=''){
        //获取当前登录者信息
        $data['cat_id'] = $type;        //事件类型
        $data["content"] = $content;
        $data["jsoninfo"] = $jsoninfo;
        $data["source"] = $_SESSION['user']['id'];
        $data["is_look"] = 0;
        $data["add_time"] = time();
        //执行添加
        M("Event")->add($data);
    }

}
?>