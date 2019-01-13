<?php

namespace app\common\validate;

use think\Validate;

class Doctor extends Validate
{
    protected $rule = [
        'phone'=>'require',
        'name'=>'require',
        'password'=>'require',
    ];
    protected $message = [
        'phone.require'=>'请输入手机',
        'name.require'=>'请输入姓名',
        'password.require'=>'请输入密码',
    ];
}