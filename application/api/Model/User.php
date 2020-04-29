<?php
namespace app\api\Model;

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
}