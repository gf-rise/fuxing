<?php
/**
 * Created by PhpStorm.
 * User: gfrie
 * Date: 2018/12/12
 * Time: 22:00
 */

namespace app\admin\controller;


use controller\BasicAdmin;
use service\DataService;
use think\Db;

class Job extends BasicAdmin
{
    public $table='CmsJob';

    public function index(){
        $this->title = '人才招募';
        $db = Db::name($this->table)->where(['is_deleted' => '0'])->whereOr('is_deleted',null);
        return parent::_list($db->order('sort asc,id desc'));
    }

    public function auth()
    {
        return $this->_form($this->table, 'auth');
    }

    public function create()
    {
        //
        $this->title='添加招慕';
        return $this->_form($this->table, 'form');
    }
    public function edit()
    {
        //
        $this->title = '编辑招慕資訊';
        return $this->_form($this->table, 'form');
    }
    public function show()
    {
        //
        $this->title = '查看招募資訊';
        return $this->_show($this->table,'show');
    }
    /**
     * 表单提交数据处理
     * @param array $data
     */
    protected function _form_filter($data)
    {
        if ($this->request->isPost()) {
            empty($data['position_name']) && $this->error('請填寫職位名稱');
            empty($data['requirements']) && $this->error('請填寫技能需求');
        }
    }

    /**
     * Banner啟用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume(){
        if (DataService::update($this->table)) {
            $this->success("Banner啟用成功！", '');
        }
        $this->error("Banner啟用成功，請稍候再試！");
    }

    /**
     * Banner禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
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