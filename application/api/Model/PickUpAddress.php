<?php
namespace app\api\Model;
use think\Model;
class PickUpAddress extends Model {
    //用户自己选择的历史自提点列表
    protected $table = 'my_pick_up_address_list';
    //根据用户openid获取用户历史自提点列表
    public function getAddressListByOpenid($openid){
        $model = new PickUpAddress;
        $res = $model->where(array('openid'=>$openid))->select();

        $array = array();
        $i = 0;
        foreach ($res as $key=>$value){
            $array[$i]['id'] = $value->data['id'];
            $array[$i]['self_pick_up_id'] = $value->data['self_pick_up_id'];
            $array[$i]['self_pick_up_name'] = $this->getSelfPickUpNameById($value->data['self_pick_up_id']);
            $i++;
        }

        return $array;
    }

    protected function getSelfPickUpNameById($id){
        $model = new PickUpList();
        $res = $model->where(['id'=>$id])->find();
        //var_dump($res->data);
        return $res->data['name'];
    }
}