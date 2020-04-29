<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\View;

class Sign extends Controller{
    //登录-渲染页面
    public function signIn(){
        $view = new View();
        return $view->fetch('signIn');
    }


    //登录操作处理
    public function signInAction(){
        //获取参数
        //var_dump(input());
        $username = input('username');
        $pass = input('pass');
        if (empty($username) || empty($pass)){
           $this->error('用户名或者密码不能为空','Sign/signIn');
            //$data = ['code'=>0,'msg'=>'帐号或者密码不能为空'];
            //return json($data);
        }

        $model = new \app\index\Model\BackendManager();
        $model = $model->where('account',$username)
            ->where('password',$pass)
            ->find();

        if (isset($model) && !empty($model)){
             $data = ['code'=>1,'msg'=>'登录成功'];
            return json($data);

        }else{
             $data = ['code'=>0,'msg'=>'登录失败'];
             return json($data);

        }
    }


//    登出--渲染页面
    public function signOut(){
        $view = new View();
        return $view->fetch('signOut');
    }
}
