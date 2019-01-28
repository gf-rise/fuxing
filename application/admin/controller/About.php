<?php
/**
 * Created by PhpStorm.
 * User: gfrie
 * Date: 2018/12/12
 * Time: 22:02
 */

namespace app\admin\controller;


use controller\BasicAdmin;
use service\DataService;
use think\Db;

class About extends BasicAdmin
{
    public $table = "CmsAbout";

    /**
     * 显示资源列表
     *
     * @return \think\Response
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '简介管理';
        $db = Db::name($this->table)->where(['is_deleted' => '0'])->whereOr('is_deleted',null);
        return parent::_list($db->order('sort asc,id desc'));
    }


    /**
     * 授权管理
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function auth()
    {
        return $this->_form($this->table, 'auth');
    }

    /**
     * 显示创建资源表单页.
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function create()
    {
        //
        $this->title='添加简介';
        return $this->_form($this->table, 'form');
    }
    public function edit()
    {
        //
        $this->title = '编辑简介';
        return $this->_form($this->table, 'form');
    }
    public function show()
    {
        //
        $this->title = '查看简介';
        return $this->_show($this->table,'show');
    }
    /**
     * 表单提交数据处理
     * @param array $data
     */
    protected function _form_filter($data)
    {
        if ($this->request->isPost()) {
            empty($data['content']) && $this->error('請填寫简介內容');
            empty($data['title']) && $this->error('請填寫简介標題');
        }
    }

    /**
     * Banner啟用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume(){
        if (DataService::update($this->table)) {
            $this->success("啟用成功！", '');
        }
        $this->error("啟用失败，請稍候再試！");
    }

    /**
     * Banner禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbid()
    {
        if (DataService::update($this->table)) {
            $this->success("禁用成功！", '');
        }
        $this->error("禁用成功，請稍候再試！");
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
            $this->success("刪除成功！", '');
        }
        $this->error("刪除成功，請稍候再試！");
    }
}