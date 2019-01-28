<?php

// +----------------------------------------------------------------------
// | ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/ThinkAdmin
// +----------------------------------------------------------------------

namespace app\index\controller;


use app\index\model\Contact;
use app\index\model\About;
use app\index\model\Banner;
use app\index\model\Job;
use app\index\model\News;
use app\index\model\Services;
use controller\BasicIndex;


/**
 * 应用入口控制器
 * @author Anyon <zoujingli@qq.com>
 */
class Index extends BasicIndex
{


    public function index()
    {

        $this->assign('config',$this->config);

        $banner = Banner::where('status',1)->order('sort','asc')->select();
        $services = Services::where('status',1)->order('sort','asc')->select();
        $about = About::where('status',1)->limit(1)->find();
        $news = News::where('status',1)->limit(8)->order('sort','asc')->select();
        $job = Job::where('status',1)->limit(8)->order('sort','asc')->select();
        $contact = Contact::where('status',1)->order('sort','asc')->select();
        $this->assign(['banner'=>$banner,'services'=>$services,'about'=>$about,'news'=>$news,'job'=>$job,'contact'=>$contact]);
        return $this->fetch();
    }

    public function main(){
        $this->assign('config',$this->config);

        $banner = Banner::where('status',1)->order('sort','asc')->select();
        $this->assign('banner',$banner);
        return $this->fetch();
    }
}
