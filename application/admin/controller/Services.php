<?php
/**
 * Created by PhpStorm.
 * User: gfrie
 * Date: 2018/12/12
 * Time: 22:02
 */

namespace app\admin\controller;


use controller\BasicAdmin;

class Services extends BasicAdmin
{
    function index(){
        return $this->fetch();
    }
}