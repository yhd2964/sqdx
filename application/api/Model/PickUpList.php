<?php
namespace app\api\Model;

use think\Model;

class PickUpList extends Model{
    //社区电商-所有自提点列表
    protected $table = 'vshop_self_pick_ip_list';
    //获取所有的产品分类
    public function getAllPickUpList(){
        $model = new PickUpList;
        $data = $model->field('id,name,address,longitude,latitude,contact,telephone')
            ->select();

        $array = array();
        $i = 0;
        foreach ($data as $key=>$value){
             //var_dump($value->data['name']);die();
            $array[$i]['id'] = $value->data['id'];
            $array[$i]['name'] = $value->data['name'];
            $array[$i]['address'] = $value->data['address'];
            $array[$i]['longitude'] = $value->data['longitude'];
            $array[$i]['latitude'] = $value->data['latitude'];
            $array[$i]['contact'] = $value->data['contact'];
            $array[$i]['telephone'] = $value->data['telephone'];
            $i++;
        }

        return $array;
    }
}