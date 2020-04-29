<?php
namespace app\api\controller;

use app\api\Model\PickUpAddress;
use think\Controller;
use think\Request;
//用户行为
class Address extends Controller{
    //用户添加方便自己的自提点地址
    public function addAddress(Request $request){
        $param = $request->param();
        //自提点id
        $addressId = $param['addressId'];
        $openid = $param['openid'];

        $model = new PickUpAddress();
        $model->openid = $openid;
        $model->self_pick_up_id = $addressId;
        $model->is_default = 0;
        $model->create_time = date('Y-m-d H:i:s');
        $model->save();

        $data = ['status' => 'success', 'msg' => '地址添加成功'];
        return json($data);
    }

    //删除自提点地址
    public function delAddress(Request $request){
        $param = $request->param();
        //自提点id
        $addressId = $param['addressId'];

        $res = PickUpAddress::destroy(['id'=>$addressId]);
        if ($res){
            $data = ['status' => 'success', 'msg' => '删除成功'];
            return json($data);
        }else{
            $data = ['status' => 'error', 'msg' => '删除失败'];
            return json($data);
        }
    }
}