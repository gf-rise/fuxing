<?php
/**
 * Created by PhpStorm.
 * User: gfrie
 * Date: 2018/12/14
 * Time: 15:17
 */

namespace app\admin\controller;


use controller\BasicAdmin;
use service\DataService;
use think\Db;

class Lawyer extends BasicAdmin
{
    public $table = "CmsLawyer";
    public function index(){

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

    public function auth()
    {
        return $this->_form($this->table, 'auth');
    }

    public function create()
    {
        //
        $this->title='增加律師';
        return $this->_form($this->table, 'form');
    }

    public function edit()
    {
        //
        $this->title = '律師詳情';
        return $this->_form($this->table, 'form');
    }

    public function show()
    {
        //
        $this->title = '查看新聞';
        return $this->_show($this->table,'show');
    }
    /**
     * 表单提交数据处理
     * @param array $data
     */
    protected function _form_filter($data)
    {
        if ($this->request->isPost()) {
            empty($data['lawyer_name']) && $this->error('律師名稱必須填寫');
        }
    }
    /**
     * Banner啟用
     */
    public function resume(){
        if (DataService::update($this->table)) {
            $this->success("Banner啟用成功！", '');
        }
        $this->error("Banner啟用成功，請稍候再試！");
    }
    /**
     * Banner禁用
     */
    public function forbid()
    {
        if (DataService::update($this->table)) {
            $this->success("Banner禁用成功！", '');
        }
        $this->error("Banner禁用成功，請稍候再試！");
    }
    /**
     * 删除指定资源
     *
     * @return void
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $this->success("Banner刪除成功！", '');
        }
        $this->error("Banner刪除成功，請稍候再試！");
    }
}