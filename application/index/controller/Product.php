<?php
namespace app\index\controller;

use think\Controller;
use think\View;

class Product extends Controller{
    public function productList(){
        $view = new View();
        return $view->fetch('productList');
    }

    public function addProduct(){
        $view = new View();
        return $view->fetch('addProduct');
    }

    public function editProduct(){
        $view = new View();
        return $view->fetch('editProduct');
    }


    public function delProduct(){
        $view = new View();
        return $view->fetch('delProduct');
    }
}
