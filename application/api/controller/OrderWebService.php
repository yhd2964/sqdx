<?php
namespace app\api\controller;

use app\api\Model\Order;
use think\Controller;
use think\Request;

class OrderWebService extends Controller{
    //根据订单id取消订单    POST
    public function closeOrderByOrderId(Request $request){
        $orderId = $request->post('orderId');
        $model = new Order($orderId);

    }

    //根据用户openid获取用户所有订单列表
    public function getOrderList(Request $request){
        $openId = $request->post('openId');
    }
}