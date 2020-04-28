<?php
namespace app\api\controller;

use app\api\Model\VshopCart;
use think\Controller;
use think\Db;
use think\Request;

class ShoppingCart extends Controller{
    //根据用户openid获取用户购物车列表
    public function getShoppingCartByOpenid(Request $request){
        $openId = $request->post('openId');

        $model = new ShoppingCart();
        $data = $model->getShoppingCartByOpenid($openId);

        return $data;
    }

    //加入购物车
    public function addShoppingCart(Request $request){
        $openId = $request->post('openId');
        $productId = $request->post('productId');
        $productName = $request->post('productName');
        $num = $request->post('num');

        $model = new VshopCart();
        $model->openId = $openId;
        $model->productId = $productId;
        $model->productName = $productName;
        $model->num = $num;
        $model->create_time = Db::raw("now()");
        $model->save();

        $arr = array('status'=>0,'msg'=>'加入成功');
        return json($arr);
    }

    //删除购物车
    public function deleteShoppingCart(Request $request){

    }
}