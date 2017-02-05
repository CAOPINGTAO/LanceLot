<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    //前台主页
    public function index(){

        //幻灯片
        $this->ppt();
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

    //幻灯片
    public function ppt(){

        //实例化 加载PPt表，等同于$m = new \Think\Model('Ppt');
        $m = M("Ppt");
        $ppt = $m->where("state=1")->limit(7)->select();
        //实例化各个模型
        $movie = M("Movie");
        $ma = M("Movie_actor");
        $a = M("Actors");
        $mt = M("Movie_type");
        $t = M("Type");
        //根据电影id mid查询电影的相关信息
        foreach($ppt as &$v1){
            $mo = $movie->where("id={$v1['mid']}")->select();
            $v1['nation'] = $mo[0]['nation'];   //注意查询出来只会有一个结果，因为每部电影都是唯一的，且查询的结果是多维数组
            $v1['language'] = $mo[0]['language'];
            $v1['replynum'] = $mo[0]['replynum'];
            $v1['showtime'] = $mo[0]['showtime'];
            //查询影片相关演员
            $ma1 = $ma->field("aid")->where("fid={$v1['mid']}")->limit(2)->select();
            foreach($ma1 as $av){
                $a1 = $a->field("cname")->where("id={$av['aid']}")->select();
                $v1['cname'][] = $a1[0]['cname'];
            }
            //查询电影所属类型
            $mt1 = $mt->field("tid")->where("fid={$v1['mid']}")->select();
            foreach($mt1 as $tv){
                $t1 = $t->field("typename")->where("fid=1 and id={$tv['tid']}")->select();
                $v1['typename'][] = $t1[0]['typename'];
            }
        }
        //现在PPT的相关信息已拼接在$ppt中，分配过去就行
        $this->assign("ppt", $ppt);
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

    //正在热映
    public function hot(){

        $hot = M("Movie")->field('id,filmname,picname,rate')->order("id asc")->limit("0,4")->select();
        $hide = M("Movie")->field('id,filmname,picname,rate')->order("id asc")->limit("4,4")->select();
        $this->assign("hot", $hot);
        $this->assign("hide", $hide);
    }

    //近期热播
    public function recent(){

        $recent = M("Movie")->field('id,filmname,picname')->order('addtime desc')->limit(10)->select();
        $this->assign("recent", $recent);
    }

    //热评榜
    public function review(){

        $num = M("Movie")->field('id,filmname,replynum')->order('replynum desc')->limit(10)->select();
        $this->assign("num", $num);
    }

    //Top10点击排行榜
    public function clicknum(){

        $clicknum = M("Movie")->field('id,filmname,picname,clicknum')->order('clicknum desc')->limit(8)->select();
        $this->assign("clicknum", $clicknum);
    }

    //搜索
    public function search(){

        $key = trim($_POST['key']);
        //调用台词方法
        $this->dialogue();
        //1 搜电影
        $mv['filmname'] = array('like', "%{$key}%");
        $mv['status'] = array('in', '1,2');
        $mv['_logic'] = 'and';

        //2 按分类搜索
        $mt['typename'] = array('like',"%{$key}%");

        //3 搜索长评
        $map['title'] = array('like', "%{$key}%");

        $findmv = M("Movie")->where($mv)->select();
        $findty = M("Type")->where($mt)->select();
        $findmap= M("Longreview")->where($map)->select();

        if($findmv && count($findmv)) {
            $where['filmname'] = array('like',"%{$key}%");
            $where['status'] = array('in', '1,2');
            $where['_logic'] = 'and';

            $count = M("Movie")->where($where)->count();        //分页总记录数
            $Page = new \Think\Page($count,C("PAGE_COUNT_ONE"));    //分页实例化
            $show = $Page->show();  //分页显示输出

            $Mactor = D('Movie');
            $list = $Mactor->relation('actorlist')->where($where)->order('clicknum desc')->limit($Page->firstRow.','.$Page->listRows)->select();

            $this->assign('tag', "电影搜索："." ".$key);
            $this->assign('list', $list);   //赋值数据集
            $this->assign('page', $show);   //赋值分页输出

            $this->link();
            $this->display("Typelist/tags");

        } elseif ($findty && count($findty)) {
            $tid = $findty[0]['id'];
            $typename = $findty[0]['typename'];
            //分页
            $Model = new \Think\Model();
            $movies = $Model->query("SELECT m.* FROM ll_movie m LEFT JOIN ll_movie_type mt ON mt.fid=m.id WHERE mt.tid={$tid} AND m.status in (1,2)");
            $count = count($movies);
            $Page = new \Think\Page($count, C("PAGE_COUNT_ONE"));
            $show  = $Page->show();
            //分页数据查询
            $list = $Model->query("SELECT m.* FROM ll_movie m LEFT JOIN ll_movie_type mt ON mt.fid=m.id WHERE mt.tid={$tid} AND m.stauts in (1,2) ORDER BY clicknum DESC LIMIT {$Page->firstRow},{$Page->listRows}");

            $this->assign('tag',"电影标签：".$typename);
            $this->assign('list', $list);
            $this->assign('page', $show);

            $this->link();
            $this->display("Typelist/tags");
        } else {
            $this->assign('tag',"搜索：".$key);
            $this->hot();
            $this->dialogue();
            $this->link();
            $this->display("recommend");
        }
    }
}