<?php
namespace app\index\controller;

use think\Controller;
use think\View;

class Goods extends Controller{
    public function goodsList(){
        $view = new View();
        return $view->fetch('goodsList');
    }


    public function addGoods(){
        $view = new View();
        return $view->fetch('addGoods');
    }

    public function editGoods(){
        $view = new View();
        return $view->fetch('editGoods');
    }


    public function delGoods(){
        $view = new View();
        return $view->fetch('delGoods');
    }
}
