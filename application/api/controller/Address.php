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
        if (empty($param)){
            $data = ['status' => 'error', 'msg' => '缺少参数'];
            return json($data);
        }
        //社区电商自提点id
        $self_pick_up_id = $param['self_pick_up_id'];
        $openid = $param['openid'];

        $model = new PickUpAddress();
        $model->openid = $openid;
        $model->self_pick_up_id = $self_pick_up_id;
        $model->is_default = 0;
        $model->create_time = date('Y-m-d H:i:s');
        $model->save();

        $data = ['status' => 'success', 'msg' => '自提点地址添加成功'];
        return json($data);
    }

    //删除自提点地址
    public function delAddress(Request $request){
        $param = $request->param();
        if (empty($param)){
            $data = ['status' => 'error', 'msg' => '缺少参数addressId'];
            return json($data);
        }
        //需要删除的自提点地址id
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

    //根据用户openid 获取用户的历史自提点列表
    public function getAddressListByOpenid(Request $request){
        $param = $request->param();
        if (empty($param['openid'])){
            return json(['status' => 'error', 'msg' => '缺少参数openid']);
        }

        $openid = $param['openid'];
        $model = new PickUpAddress();
        $res = $model->getAddressListByOpenid($openid);

        return json(['status'=>'success','data'=>$res]);
    }
}