<?php
namespace app\api\Model;

use think\Model;

class Classify extends Model{
    //产品分类表(内置10条固定数据)
    protected $table = 'vshop_classify';
    //获取所有的产品分类
    public function getAllClassify(){
        $model = new Classify;
        $data = $model->field('id,name')
            ->select();

        $array = array();
        foreach ($data as $key=>$value){
           // var_dump($value->data['name']);
            $array[][$value->data['id']] = $value->data['name'];
        }

        return $array;
    }
}