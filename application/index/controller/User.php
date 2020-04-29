<?php
namespace app\index\controller;


use think\Controller;


class User extends Controller{
    //获取前台用户列表
    public function getUserList(){

        $model = new \app\common\model\User();
        $data = $model->getAllUserList();

        $this->assign(['userList'=>$data]);

        return $this->fetch('getUserList');
    }
}