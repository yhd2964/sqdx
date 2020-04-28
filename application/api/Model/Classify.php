<?php
namespace app\api\Model;

use think\Model;

class Classify extends Model{
    protected $table = 'vshop_classify';
    public function getAllClassify(){
        $model = new Classify();
        $data = $model->field('id,name')
            ->select();

        $array = array();
        foreach ($data as $key=>$value){
           // var_dump($value->data['name']);
//            $array[] = $value->data['name'];
            $array[][$value->data['id']] = $value->data['name'];
           // $array[]['id'] = $value->data['id'];
           // $array[]['name'] = $value->data['name'];
        }

        return $array;
    }
}