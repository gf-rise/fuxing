<?php
/**
 * Created by PhpStorm.
 * User: gfrie
 * Date: 2018/12/17
 * Time: 11:57
 */

namespace controller;


use think\App;
use think\Controller;
use think\Db;

class BasicIndex extends Controller
{
    /**
     * 页面标题
     * @var string
     */
    public $title;

    /**
     * 默认操作数据表
     * @var string
     */
    public $table;

    public $config;

    public function __construct(App $app = null)
    {

        parent::__construct($app);
        $config = Db::name('SystemConfig')->column('value','name');

        $this->config['logo'] = isset($config['site_logo'])?$config['site_logo']:'';   //logo
        $this->config['site_url'] = isset($config['site_url'])?$config['site_url']:'';   //logo
        $this->config['icon'] = isset($config['browser_icon'])?$config['browser_icon']:'';   //logo
        $this->config['app_name'] = isset($config['app_name'])?$config['app_name']:'';   //名稱
        $this->config['site_name'] = isset($config['site_name'])?$config['site_name']:'';  //站點名稱
        $this->config['ver'] = isset($config['app_version'])?$config['app_version']:'';     //版本
        $this->config['copyright'] = isset($config['site_copy'])?$config['site_copy']:'';  //copy
        $this->config['keywords']=isset($config['keywords'])?$config['keywords']:'';      //keywords
        $this->config['description']=isset($config['description'])?$config['description']:'';  //description
        $this->config['email']=isset($config['email'])?$config['email']:'';      //keywords
        $this->config['tel']=isset($config['tel'])?$config['tel']:'';  //description
        $this->config['line']=isset($config['line'])?$config['line']:'';      //keywords
        $this->config['facebook']=isset($config['facebook'])?$config['facebook']:'';  //description
    }

}