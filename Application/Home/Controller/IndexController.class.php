<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    //前台主页
    public function index(){

        //首页影评列表
        $this->reviewlist();
        //调用台词的方法
        $this->dialogue();
        //影片分类
        $this->moviesort();
        //友情链接
        $this->link();
        //正在热映
        $this->hot();
        //近期热门
        $this->recent();
        //评论榜
        $this->review();
        //Top10
        $this->clicknum();

        $this->display("index");
    }

    //最受欢迎的影评
    public function reviewlist(){

        //显示的影评（按点击率rnum desc 5条）
        $list = M()->query("select r.id,r.fid,r.uid,r.title,r.content,u.username,m.filmname,m.picname
                            from ll_longreview r,ll_movie m,ll_user u
                            where r.status in(1,2) and r.fid=m.id and r.uid=u.id
                            order by r.rnum desc limit 0,5");
        //处理显示的影评内容
        foreach($list as &$v){
            $str = strip_tags($v["content"]); //剥去内容中的xml php html标签
            $str = preg_replace("/[\s\ ]*/","",$str); //剥去内容中的tab和空格
            $v["content"] = substr($str,0,450)."......"; //截取钱450个字符
        }
        $this->assign("reviewlist", $list);
    }

    //调用台词的方法,随机显示
    public function dialogue(){

        $m = M("Dialogue");
        $total = $m->where("status=1")->count();
        $dialogue = $m->where("status=1")->select();
        $this->assign("dialogue", $dialogue[rand(0,$total-1)]);
    }

    //影片分类
    public function moviesort(){

        //查询类型fid为分类(fid=1)的分类名，fid=2是按地区，fid=3是按时间
        $mtype = M("type")->where("fid=1")->order("id")->limit(30)->select();
        $this->assign('mtype', $mtype);
    }

    //友情链接
    public function link(){
        $link = M("Friendlink")->select();
        $this->assign("link", $link);
    }

    //口碑榜
    public function hot(){

        $hot = M("Movie")->field('id,filmname,picname,rate')->order("rate desc")->limit("0,4")->select();
        $hide = M("Movie")->field('id,filmname,picname,rate')->order("rate desc")->limit("4,4")->select();
        $this->assign("hot", $hot);
        $this->assign("hide", $hide);
    }

    //近期热播
    public function recent(){

        $recent = M("Movie")->field('id,filmname,picname')->order('showtime desc')->limit(10)->select();
        $this->assign("recent", $recent);
    }

    //热评榜
    public function review(){

        $num = M("Movie")->field('id,filmname,replynum')->order('replynum desc')->limit(10)->select();
        $this->assign("num", $num);
    }

    //Top10点击排行榜
    public function clicknum(){

        $clicknum = M('movie')->field('id,filmname,picname,clicknum')->order('clicknum desc')->limit(8)->select();
        $this->assign("clicknum", $clicknum);
    }

    //搜索
    public function search(){

        $key = trim($_POST['key']);
        //调用台词方法
        $this->dialogue();
        //1. 搜索电影
        $mv['filmname'] = array('like', "%{$key}%");
        $mv['status'] = array('in', '1,2');
        $mv['_logic'] = 'and';

        //搜索分类
        $mt['typename'] = array('like',"%{$key}%");

        // 搜索长评
        $map['title'] = array('like', "%{$key}%");

        $findmv = M('movie')->where($mv)->select();
        $findty = M('type')->where($mt)->select();
        $findlr= M('longreview')->where($map)->select();

        if($findmv && count($findmv)) {
            $where['filmname'] = array('like',"%{$key}%");
            $where['status'] = array('in', '1,2');
            $where['_logic'] = 'and';

            $count = M('movie')->where($where)->count();        //分页总记录数
            $Page = new \Think\Page($count,10);    //分页实例化
            $show = $Page->show();  //分页显示输出

            $Mactor = D('Movie');
            $list = $Mactor->relation('actorlist')->where($where)->order('clicknum desc')->limit($Page->firstRow.','.$Page->listRows)->select();

            $this->assign('tag', "电影搜索："." ".$key);
            $this->assign('list', $list);   
            $this->assign('page', $show);   

	    //友情链接
            $this->link();
            $this->display("Typelist/tags");

        } elseif ($findty && count($findty)) {
	    // 2. 搜索分类
            $tags = $findty;
            $tid = $findty[0]['id'];
            $typename = $findty[0]['typename'];
            //分页
            $Model = new \Think\Model();
            $movies = $Model->query("SELECT m.* FROM ll_movie m LEFT JOIN ll_movie_type mt ON mt.fid=m.id WHERE mt.tid={$tid} AND m.status in (1,2)");
            $count = count($movies);
            $Page = new \Think\Page($count, 10);
            $show  = $Page->show();
            //分页数据查询
            $list = $Model->query("SELECT m.* FROM ll_movie m LEFT JOIN ll_movie_type mt ON mt.fid=m.id WHERE mt.tid={$tid} AND m.status in (1,2) ORDER BY clicknum DESC LIMIT {$Page->firstRow},{$Page->listRows}");

            $this->assign('tag',"电影标签：".$typename);
            $this->assign('list', $list);
            $this->assign('page', $show);

            $this->link();
            $this->display("Typelist/tags");
        } else {
            $this->assign("tag","搜索：".$key);
            $this->hot();
            $this->dialogue();
            $this->link();
            $this->display("recommend");
        }
    }
}