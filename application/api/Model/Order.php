<?php
namespace app\api\Model;

use think\Model;

class Order extends Model{
    protected $table = 'vshop_order';

    public function closeOrderByOrderId($orderId){

    }
}