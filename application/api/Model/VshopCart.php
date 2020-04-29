<?php
namespace  app\api\Model;

use think\Model;

class VshopCart extends Model{
    protected $table = 'vshop_cart';
    //根据用户openid获取用户购物车列表
    public function getAllShopCartList($openid){
        $model = new VshopCart;
        $data = $model->field('id,productId,productName,num,price')
            ->select();

        $array = array();
        $i = 0;
        foreach ($data as $key=>$value){
            //var_dump($value->data['name']);die();
            $array[$i]['id'] = $value->data['id'];
            $array[$i]['productId'] = $value->data['productId'];
            $array[$i]['productName'] = $value->data['productName'];
            $array[$i]['price'] = $value->data['price'];
            $array[$i]['num'] = $value->data['num'];
            $i++;
        }

        return $array;
    }
}