<?php
namespace app\index\controller;

use think\Controller;
use think\View;

class Sign extends Controller{
//    登录
    public function signIn(){
        $view = new View();
        return $view->fetch('signIn');
    }
//    登出
    public function signOut(){
        $view = new View();
        return $view->fetch('signOut');
    }
}
