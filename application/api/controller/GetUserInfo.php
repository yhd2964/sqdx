<?php
namespace  app\api\controller;
use app\api\Model\User;
use think\Controller;

class  GetUserInfo extends Controller{
    //获取用户信息根据openid
    public function  getUserInfoByOpenid(){
        $openid = isset($_POST['openid'])?$_POST['openid']:'';
        if (empty($openid)){
            $data = ['status'=>'error','msg'=>'缺少参数openid'];
            return json($data) ;
        }else{
            $model = new User();
            $userInfo = $model->getUserInfoByOpenid($openid);
            $userInfo = ['status'=>'success','data'=>$userInfo];
            return json($userInfo);
        }
    }
}