<?php
namespace app\api\Model;
use think\Model;
class PickUpAddress extends Model {
    //用户自己选择的历史自提点列表
    protected $table = 'my_pick_up_address_list';
}