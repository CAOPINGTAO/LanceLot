<?php
namespace Home\Controller;
use Home\Controller\CommonController;

class TypelistController extends CommonController{

	// 影片类型列表页视图
	public function index(){

		$Model = new \Think\Model();
		$list = $Model->query("SELECT t.fid,t.id,t.typename,COUNT(m.id) 'num' FROM ll_type t LEFT JOIN ll_movie_type mt ON  t.id=mt.tid LEFT JOIN ll_movie m ON mt.fid=m.id AND m.status IN(1,2) GROUP BY t.id order by num desc");
		$typelist = array(array('type' => "类型"), array('type' => "国家/地区"), array('type' => "年代"));

		foreach ($list as $v) {
			if ($v['fid'] == 1 ) {
				array_shift($v);
				$typelist[0]['list'][] = $v;

			}elseif ($v['fid'] == 2 ) {
				array_shift($v);
				$typelist[1]['list'][] = $v;

			}elseif ($v['fid'] == 3 ) {
				array_shift($v);
				$typelist[2]['list'][] = $v;
			}
		}

		$this->assign('typelist', $typelist);
		$this->dialogue();
		$this->display();
	}
	

	// 标签搜索
	public function tags(){

		// 获取类型id
		if (isset($_GET['id'])) {
			$tid = $_GET['id'];
		} else {
			$map['typename'] = $_GET['tags'];   
			$typeid = M('type')->field('id')->where($map)->find();
			$tid = $typeid['id'];    
		}
		
		$t = M('type')->field('typename')->where("id={$tid}")->find();
		$typename = isset($_GET['tags'])?urldecode($_GET['tags']):$t['typename'];

		//分页
		$Model = new \Think\Model();
		$movies = $Model->query("SELECT m.id FROM ll_movie m LEFT JOIN ll_movie_type mt ON mt.fid=m.id WHERE mt.tid={$tid} AND m.status in (1,2)");	
		$count = count($movies);        //满足要求的总记录数  

		$Page = new \Think\Page($count, 10);  //实例化分页类

		$show = $Page->show();         // 分页显示输出

		$tmp = array();
		foreach ($movies as $v) {
			$tmp[] = D('Movie')->relation('actorlist')->where("id = {$v['id']} and status in (1,2)")->select();
		}
		
		$list = array();
		foreach ($tmp as $vo) {
			$list[] = $vo[0];
		}
		
		$this->assign('tag', "电影标签：".$typename);
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->dialogue();
		//友情链接
		$this->link();
		$this->display();

	}

	//经典台词输出
	public function dialogue(){

		$m=M("Dialogue");
		$total=$m->where("status=1")->count();
		$dialogue=$m->where("status=1")->select();
		$this->assign("dialogue",$dialogue[rand(0,$total-1)]);
	}
	
	//友情链接
	public function link(){

		$link=M("Friendlink");
		$this->assign("link",$link->select());
	}	
}