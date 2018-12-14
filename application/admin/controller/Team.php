<?php
/**
 * Created by PhpStorm.
 * User: gfrie
 * Date: 2018/12/12
 * Time: 17:26
 */

namespace app\admin\controller;


use controller\BasicAdmin;
use think\Db;

class Team extends BasicAdmin
{
    public $table = 'SystemLog';

    function index (){
        // 日志行为类别
        $actions = Db::name($this->table)->group('action')->column('action');
        $this->assign('actions', $actions);
        // 日志数据库对象
        list($this->title, $get) = ['系统操作日志', $this->request->get()];
        $db = Db::name($this->table)->order('id desc');
        foreach (['action', 'content', 'username'] as $key) {
            (isset($get[$key]) && $get[$key] !== '') && $db->whereLike($key, "%{$get[$key]}%");
        }
        if (isset($get['create_at']) && $get['create_at'] !== '') {
            list($start, $end) = explode(' - ', $get['create_at']);
            $db->whereBetween('create_at', ["{$start} 00:00:00", "{$end} 23:59:59"]);
        }
        return parent::_list($db);
    }

    function associates(){
        return $this->fetch();
    }

}