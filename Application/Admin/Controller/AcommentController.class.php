<?php
/**
 * 关于演员的评论的控制器类
 * User: Lancelot
 * Date: 2016/5/11
 * Time: 1:03
 */
namespace Admin\Controller;
use Admin\Controller\CommonController;

class AcommentController extends CommonController{

	//封装多字段的搜索条件(加地址符直接修改原值)
	public function _filter(&$map){

		//关键字模糊搜索
		if (!empty($_REQUEST['keyword'])) {
			$map['content'] = array("like", "%{$_REQUEST['keyword']}%");
		}
		if (!empty($_REQUEST['status'])) {
			$map['status'] = $_REQUEST['status'];
		}
	}

	//index中数据加工时替换某个字段显示的回调函数
	public function _tigger_list(&$list){

		//状态显示转换
		foreach ($list as &$v) {
			//判断状态并且转换为中文
			switch ($v['status']) {
				case '1':
					$v['status'] = "正常";
					break;
				case '2':
					$v['status'] = "举报";
					break;
				case '3':
					$v['status'] = "禁言";
					break;
			}
			//搜索发表该评论的用户的用户名
			$tmp = M('user')->find($v['uid']);
			$v["username"] = $tmp['username'];

			//查询演员的中文名
			$tmp = M('Actors')->find($v['aid']);
			$v['cname'] = $tmp['cname'];

			//统计举报数,在report表中查找zid即举报的演员评论ID
			$res = M('report')->where("zid=".$v["id"])->find();
			if ($res) {
				$v["report"] = $res["count"];
			}
		}
	}

	//修改回复状态
	public function update(){
		//状态为正常时举报数清空
		if ($_POST['status'] == 1) {
			$Model = new \Think\Model();
			$Model->query("UPDATE ll_report SET count=0 WHERE zid={$_POST['id']}");
		}

		parent::update();
	}

	//查看段评论内容
	public function content(){

		$vo = M('Acomment')->find($_GET["id"]);
		$this->assert("vo", $vo);
		$this->display();
	}
}