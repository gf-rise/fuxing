<?php
/**
 * Created by PhpStorm.
 * User: gfrie
 * Date: 2018/12/17
 * Time: 14:04
 */

namespace app\admin\controller;


use controller\BasicAdmin;
use service\DataService;
use think\Db;

class Contact extends BasicAdmin
{
    public $table='CmsContact';

    public function index(){
        $this->title = '聯絡我們';
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
        $this->title='添加聯絡方式';
        return $this->_form($this->table, 'form');
    }
    public function edit()
    {
        //
        $this->title = '编辑聯絡方式';
        //轉換GOOGLE URLENCODE
        if($this->request->isPost()){
            $google_map = $this->request->post()['google_map'];
            $google = ['google_map'=>urlencode($google_map)];
            return $this->_form($this->table, 'form','','',$google);
        }
        return $this->_form($this->table, 'form');

    }
    public function show()
    {
        //
        $this->title = '查看聯絡方式';
        return $this->_show($this->table,'show');
    }
    /**
     * 表单提交数据处理
     * @param array $data
     */
    protected function _form_filter($data)
    {
        if ($this->request->isPost()) {
            empty($data['address']) && $this->error('請填寫場所地址名稱');
            empty($data['phone']) && $this->error('請填聯繫電話');
            $data['google_map']=urlencode($data['google_map']);
//            if(!empty($data['google_map'])){
//
//            }
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