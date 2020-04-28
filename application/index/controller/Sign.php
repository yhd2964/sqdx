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


    //登录操作
    public function signInAction(Request $request){
        $param = $request->param();
        $username = $param['username'];
        $pass = $param['pass'];
        if (empty($username) || empty($pass)){
            $this->error('用户名或者密码不能为空','Sign/signIn');
        }

        $model = new \app\index\Model\BackendManager();
        $model = $model->where('account',$username)
            ->where('password',$pass)
            ->find();
        if (isset($model) && !empty($model)){
            // $data = ['code'=>1,'msg'=>'登录成功'];
            //return json($data);
            $view = new View();
            return $view->fetch('index/welcome');
        }else{
            // $data = ['code'=>0,'msg'=>'登录失败'];
            //return json($data);

            $this->error();
            $view = new View();
            return $view->fetch('signIn');
        }
    }


//    登出--渲染页面
    public function signOut(){
        $view = new View();
        return $view->fetch('signOut');
    }
}
