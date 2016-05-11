<?php
/**
 * 前台用户信息管理
 * User: Lancelot
 * Date: 2016/5/11
 * Time: 10:20
 */
namespace Admin\Controller;
use Admin\Controller\CommonController;

class UserController extends CommonController{
	//封装搜索条件
	public function _filter(&$map){
		//搜索条件有值则做封装
		if (!empty($_REQUEST['keyword'])) {
			$where['username'] = array("like", "%{$_REQUEST['keyword']}%");
			$where['name'] = array("like", "%{$_REQUEST['keyword']}%");
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
	}

	// 数据加工
	public function _tigger_list(&$list){
		//遍历得到数据
		foreach ($list as &$user) {
			//创建级别表数据库操作对象
			$l = M("Ulevel");

			// 获得用户的级别
			$user['level'] = $l->where("level={$user['level']}")->getField("levelname");
		}
	}
	
	// 载入用户详细页面
	public function detail(){
		//获取用户id
		$uid = $_GET['id'];
		$user = M('User');
		$vo = $user->find($uid);

		$this->assign("vo", $vo);
		$this->display("detail");
	}

	// 用户禁言设置
	public function forbid(){
		//获得用户id
		$uid = $_GET['id'];

		//创建数据库操作对象
		$m = M("User");

		$data['disable'] = 2;
		$data['id'] = $uid;

		//执行修改
		if ($m->save($data)) {
			$this->success("设置成功");
		} else {
			$this->error("已经设置过");
		}
	}

	// 解除用户禁言
	public function free(){
		//获取用户id
		$uid = $_GET['id'];

		$m = M('User');

		$data['disable'] = 0;
		$data['id'] = $uid;

		if ($m->save($data)) {
			$this->success("设置成功");
		} else {
			$this->error("已经设置过");
		}
	}

	// 添加站内信视图
	public function addletter(){

		$uid = $_GET['id'];
		$this->assign("uid", $uid);
		$this->display("addletter");
	}

	// 添加站内信(当前登录者发送给该用户)
	public function insertletter(){

		//被发送者id
		$uid = $_POST['uid'];
		$m = M("Uletter");

		//数据封装
		$data['uid'] = $uid;	//被发送者id
		$data['title'] = $_POST['title'];	//站内信标题
		$data['content'] = $_POST['content'];	//站内信内容
		$data['addtime'] = time();
		$data['status'] = 0;

		if ($m->add($data)) {
			$this->success("发送成功");
		} else {
			$this->error("发送失败");
		}
	}

	// 用户长评论视图
	public function checklongreview(){

		$uid = $_REQUEST['id'];
		$m = M("Longreview");
		$pageNum = $_REQUEST['pageNum'] + 0; //当前页号
		$numPerPage = isset($_REQUEST["numPerPage"]) ? $_REQUEST["numPerPage"] : C("NUM_PER_PAGE");

		$count = $m->where("uid={$uid}")->count();
		$page = new \Think\Page($count, $numPerPage);
		//分页查询，以发表时间降序排序
		$list = $m->field("id,title,ptime")->where("uid={$uid}")->order("ptime desc")->limit($page->firstRow.','.$page->listRows)->select();

		//字段整理
		foreach ($list as &$vo) {
			$vo['addtime'] = $vo['ptime'];
		}

		$this->assign("list", $list);
		$this->assign("totalCount", $count);
		$this->assign("numPerPage", $numPerPage);
		$this->assign("currentPage", $pageNum);
		$this->assign("type", "checklongreview");

		$this->detail();
	}

	// 用户段评论视图
	public function checkshortreview(){

		$uid = $_REQUEST['id'];
		$m = M("Shortreview");
		$pageNum = $_REQUEST['pageNum'] + 0;
		$numPerPage = isset($_REQUEST["numPerPage"]) ? $_REQUEST["numPerPage"] : C("NUM_PER_PAGE");

		$count = $m->where("uid={$uid}")->count();
		$page = new \Think\Page($count, $numPerPage);
		$list = $m->field("id, fid, content, rtime")->where("uid={$uid}")->order("rtime desc")->limit($page->firstRow.','.$page->listRows)->select();

		//字段处理。因为这几个方法同一调用的是同一个模板，所以不同的字段需要整理
		foreach ($list as &$vo) {
			$vo['addtime'] = $vo['rtime']; //回复时间
			$vo['title'] = $vo['content'];
		}

		$this->assign("list", $list);
		$this->assign("totalCount", $count);
		$this->assign("numPerPage", $numPerPage);
		$this->assign("currentPage", $pageNum);
		$this->assign("type", "checkshortreview");

		$this->detail();
	}

	// 用户心情视图
	public function checkpmood(){

		$uid = $_REQUEST['id'];
		$m = M("Pmood");
		$pageNum = $_REQUEST['pageNum'] + 0;
		$numPerPage = isset($_REQUEST["numPerPage"]) ? $_REQUEST["numPerPage"] : C("NUM_PER_PAGE");

		$count = $m->where("uid={$uid}")->count();
		$page = new \Think\Page($count, $numPerPage);
		$list = $m->field("id, content, addtime")->where("uid={$uid}")->order("addtime desc")->limit($page->firstRow.','.$page->listRows)->select();

		//字段处理。因为这几个方法同一调用的是同一个模板，所以不同的字段需要整理
		foreach ($list as &$vo) {
			$vo['title'] = $vo['content'];
		}

		$this->assign("list", $list);
		$this->assign("totalCount", $count);
		$this->assign("numPerPage", $numPerPage);
		$this->assign("currentPage", $pageNum);
		$this->assign("type", "checkpmood");

		$this->detail();
	}

	// 用户日记视图
	public function checkdiary(){

		$uid = $_REQUEST['id'];
		$m = M("Diary");
		$pageNum = $_REQUEST['pageNum'] + 0;
		$numPerPage = isset($_REQUEST["numPerPage"]) ? $_REQUEST["numPerPage"] : C("NUM_PER_PAGE");

		$count = $m->where("uid={$uid}")->count();
		$page = new \Think\Page($count, $numPerPage);
		$list = $m->field("id, title, addtime")->where("uid={$uid}")->order("addtime desc")->limit($page->firstRow.','.$page->listRows)->select();

		$this->assign("list", $list);
		$this->assign("totalCount", $count);
		$this->assign("numPerPage", $numPerPage);
		$this->assign("currentPage", $pageNum);
		$this->assign("type", "checkdiary");

		$this->detail();
	}

	// 用户相册视图
	public function checkphotoalbum(){

		$uid = $_REQUEST['id'];
		$m = M("Photoalbum");
		$pageNum = $_REQUEST['pageNum'] + 0;
		$numPerPage = isset($_REQUEST["numPerPage"]) ? $_REQUEST["numPerPage"] : C("NUM_PER_PAGE");

		$count = $m->where("uid={$uid}")->count();
		$page = new \Think\Page($count, $numPerPage);
		$list = $m->field("id, title, addtime")->where("uid={$uid}")->order("addtime desc")->limit($page->firstRow.','.$page->listRows)->select();

		$this->assign("list", $list);
		$this->assign("totalCount", $count);
		$this->assign("numPerPage", $numPerPage);
		$this->assign("currentPage", $pageNum);
		$this->assign("type", "checkphotoalbum");

		$this->detail();
	}

	// 站内信模版
	public function checkletter(){

		$uid = $_REQUEST['id'];
		$m = M("Uletter");
		$pageNum = $_REQUEST['pageNum'] + 0;
		$numPerPage = isset($_REQUEST["numPerPage"]) ? $_REQUEST["numPerPage"] : C("NUM_PER_PAGE");

		$count = $m->where("uid={$uid}")->count();
		$page = new \Think\Page($count, $numPerPage);
		$list = $m->field('id, title, addtime, staus')->where("uid={$uid}")->order("addtime desc")->limit($page->firstRow.','.$page->listRows)->select();

		$this->assign("list", $list);
		$this->assign("totalCount", $count);
		$this->assign("numPerPage", $numPerPage);
		$this->assign("currentPage", $pageNum);
		$this->assign("type", "checkletter");

		$this->detail();
	}
}