<?php
namespace app\api\controller;

use app\api\Model\PickUpList;
use think\Controller;

class PickUpWebService extends Controller{
    //获取所有的自提点列表
    public function getAllPickUpList(){
        $model = new PickUpList();
        $res = $model->getAllPickUpList();

        $data = ['status'=>1,'data'=>$res];
        return json($data);
    }
}