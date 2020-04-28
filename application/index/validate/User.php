<?php
namespace app\index\validate;

use think\Validate;

class User extends Validate{
    protected $rules = [
        'username'=>'require|max:25',
        'pass'=>'require|min:7'
    ];
}