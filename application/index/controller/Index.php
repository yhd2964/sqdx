<?php
namespace app\index\controller;
use think\Controller;
use think\View;

class Index extends Controller
{
    public function index()
    {
        $view = new View();
        return $view->fetch('index');
    }

    public function welcome(){
        $view = new View();
        return $view->fetch('welcome');
    }
}
