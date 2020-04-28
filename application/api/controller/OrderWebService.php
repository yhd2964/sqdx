<?php
namespace app\api\controller;

use app\api\Model\Order;
use think\console\command\make\Model;
use think\Controller;
use think\Request;

class OrderWebService extends Controller{
    //订单提交
    public function submitOrderDetail(Request $request){
        $param = $request->param();
        $openId = $param['openId'];
        $ShoppingCartList = $param['ShoppingCartList'];
        $addressId = $param['addressId'];
        $remark = $param['remark'];

        $dataList = array();
        //查询默认收货地址
        $address = new Model('vshop_addresslibrary');
        $address->find($addressId);


    }

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