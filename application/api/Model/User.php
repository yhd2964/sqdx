<?php
namespace app\api\Model;

use think\Model;

class User extends Model{

    protected $table = 'users';

    public function getUserInfoByOpenid($openid){
        $user = new User();
        $data = $user->field('id,openid,nickName,headimgurl,sex,signature')
                     ->where('openid',$openid)
                     ->find();

        return $data->data;
    }
}