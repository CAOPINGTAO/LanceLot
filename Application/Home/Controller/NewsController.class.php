<?php
/**
 * Created by PhpStorm.
 * User: Lancelot
 * Date: 2016/4/25
 * Time: 21:17
 */

namespace Home\Controller;
use Think\Controller;

class NewsController extends Controller{

    //新闻主页
    public function news(){
        //查询电影新闻表中的信息、
        $mnews = M("Mnews");
        $pnews = M("Pnews");
        $mpicnews = M("Mpicnews");
        $ppicnews = M("Ppicnews");
        //近期热点的查询（最近五天上传并且点击最高的6条新闻）
        $t = time() - 864000;
        $mlist1 = $mnews->where("state=2 and status=1 and addtime>{$t}")->order("looknum desc")->limit(6)->select();
        $this->assign("mlist1", $mlist1);

        //影视前瞻
        $mlist2 = $mnews->where("state=2 and status=3")->order('addtime desc')->limit(2)->select();
        $this->assign("mlist2", $mlist2);

        //精彩抢先看
        $mlist3 = $mnews->where("state=2 and status=3")->order('addtime desc')->limit(2,3)->select();
        foreach($mlist3 as &$v3){   //获取电影资讯的图片名
            $where3['mid'] = $v3['id'];
            $mpic3 = $mpicnews->where($where3)->select();
            $v3['pica'] = $mpic3[0]['pica'];
        }
        $this->assign("mlist3", $mlist3);

        //左侧的电影新闻
        $mlist4 = $mnews->where("state=2 and status=1")->order('addtime desc')->limit(2)->select();
        foreach($mlist4 as &$v4){
            $where4['mid'] = $v4['id'];
            $mpic4 = $mpicnews->where($where4)->select();
            $v4['pica'] = $mpic4[0]['pica'];
        }
        $this->assign("mlist4", $mlist4);

        //中间的电影新闻
        $mlist5 = $mnews->where("state=2 and status=1")->order('addtime desc')->limit(2,7)->select();
        $this->assign("mlist5", $mlist5);

        //右侧的电影新闻
        $mlist6 = $mnews->where("state=2 and status=2")->order('addtime desc')->limit(3)->select();
        $this->assign("mlist6", $mlist6);

        //左侧的人物新闻
        $plist2 = $pnews->where("state=2 and status=1")->order('addtime desc')->limit(2)->select();
        foreach($plist2 as &$p2){
            $where2['pid'] = $p2['id'];
            $ppic2 = $ppicnews->where($where2)->select();
            $p2['pica'] = $ppic2[0]['pica'];
        }
        $this->assign("plist2", $plist2);

        //中间的人物新闻
        $plist3 = $pnews->where("state=2 and status=1")->order('addtime desc')->limit(2,7)->select();
        $this->assign("plist3", $plist3);

        //右侧的任务新闻
        $plist4 = $pnews->where("state=2 and status=2")->order('addtime desc')->limit(4)->select();
        $this->assign("plist4", $plist4);

        $this->display("news");

    }
}