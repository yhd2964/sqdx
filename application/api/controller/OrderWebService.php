<?php
namespace app\api\controller;

use app\api\Model\Order;
use app\api\Model\PickUpAddress;
use think\console\command\make\Model;
use think\Controller;
use think\Request;

class OrderWebService extends Controller{
    //订单提交
    public function submitOrderDetail(Request $request){
        //获取参数
        $param = $request->param();
        if (empty($param)){
            $data = ['status' => 'error', 'msg' => '缺少参数'];
            return json($data);
        }
        $openId = $param['openId'];//openid
        $ShoppingCartList = $param['ShoppingCartList'];//商品列表
        $addressId = $param['addressId'];//选择的自提点id
        $remark = $param['remark'];//备注

        $dataList = array();
        //查询默认收货地址
        $address = new PickUpAddress();
        $res = $address->find($addressId);


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