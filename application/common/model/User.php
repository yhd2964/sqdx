<?php
namespace app\common\model;

use think\Model;

class User extends Model{

    protected $table = 'vshop_user';

    //根据openid 获取用户信息
    public function getUserInfoByOpenid($openid){
        $user = new User();
        $data = $user->field('id,openid,nickName,headimgurl,sex,signature')
                     ->where('openid',$openid)
                     ->find();

        return $data->data;
    }

    public function getAllUserList(){
        $user = new User;
        $data = $user->field('id,openid,nickName,headimgurl,sex,signature,create_time')
            ->select();

        $array = array();
        $i = 0;
        foreach ($data as $key=>$value){
            //var_dump($value->data['name']);die();
            $array[$i]['id'] = $value->data['id'];
            $array[$i]['nickName'] = $value->data['nickName'];
            $array[$i]['headimgurl'] = $value->data['headimgurl'];
            $array[$i]['sex'] = $value->data['sex'];
            $array[$i]['signature'] = $value->data['signature'];
            $array[$i]['create_time'] = $value->data['create_time'];
            $i++;
        }

        return $array;
    }
}