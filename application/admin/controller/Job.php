<?php
/**
 * Created by PhpStorm.
 * User: gfrie
 * Date: 2018/12/12
 * Time: 22:00
 */

namespace app\admin\controller;


use controller\BasicAdmin;

class Job extends BasicAdmin
{
    function index(){
        return $this->fetch();
    }

}