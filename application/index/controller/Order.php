<?php
namespace app\index\controller;

use think\Controller;
use think\View;

class Order extends Controller{
    public function orderList(){
        $view = new View();
        return $view->fetch('orderList');
    }


    public function editOrder(){
        $view = new View();
        return $view->fetch('editOrder');
    }


    public function delOrder(){
        $view = new View();
        return $view->fetch('delOrder');
    }
}