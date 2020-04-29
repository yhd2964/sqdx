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
        if (empty($param)){
            $data = ['status' => 'error', 'msg' => '缺少参数'];
            return json($data);
        }

        $model = new ShoppingCart();
        $res = $model->getShoppingCartByOpenid($openId);

        $data = ['status'=>'success','data'=>$res];
        return json($data);
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

        $arr = array('status'=>'success','msg'=>'加入成功');
        return json($arr);
    }

    //改变购物车数量
    public function changeCartNumber(Request $request){
        $param = $request->param();
        if (empty($param)){
            $data = ['status' => 'error', 'msg' => '缺少参数'];
            return json($data);
        }
        $cartId = $param['cartId'];
        $openId = $param['openId'];
        $num = $param['num'];

        $model = new VshopCart();
        $model->isUpdate(true)->save(['id'=>$cartId,'num'=>$num]);

        $arr = array('status'=>'success','msg'=>'成功');
        return json($arr);
    }

    //删除购物
    public function deleteShoppingCart(Request $request){

    }
}