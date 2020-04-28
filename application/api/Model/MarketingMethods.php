<?php
namespace  app\api\Model;

use think\Model;

class MarketingMethods extends Model {
    protected $table = 'vshop_marketing_methods_type';
    public function getALlMethods(){
        $model = new MarketingMethods();
        $methods = $model->field('id,name')
            ->select();

        $array = array();
        foreach ($methods as $key=>$value){
            // var_dump($value->data['name']);
//            $array[] = $value->data['name'];
            $array[][$value->data['id']] = $value->data['name'];
        }

        return $array;
    }
}