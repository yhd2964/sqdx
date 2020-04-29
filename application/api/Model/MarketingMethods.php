<?php
namespace  app\api\Model;

use think\Model;

class MarketingMethods extends Model {
    //市场营销方式分类表(内置三条数据)
    protected $table = 'vshop_marketing_methods_type';
    //获取所有的营销方式分类
    public function getALlMethods(){
        $model = new MarketingMethods();
        $methods = $model->field('id,name')
            ->select();

        $array = array();
        foreach ($methods as $key=>$value){
            // var_dump($value->data['name']);
            $array[][$value->data['id']] = $value->data['name'];
        }

        return $array;
    }
}