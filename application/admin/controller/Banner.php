<?php

namespace app\admin\controller;

use controller\BasicAdmin;

use service\DataService;
use think\Db;
use think\Request;

class Banner extends BasicAdmin
{



    public $table = "CmsBanner";

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
        $this->title = 'Banner管理';
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
        return $this->_form($this->table, 'form');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return void
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return void
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @return \think\Response
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit()
    {
        //
        $this->title = '编辑Banner';
        return $this->_form($this->table, 'form');
    }

    /**
     * 表单提交数据处理
     * @param array $data
     */
    protected function _form_filter($data)
    {
        if ($this->request->isPost()) {
            empty($data['img']) && $this->error('請上傳Banner圖片');
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
