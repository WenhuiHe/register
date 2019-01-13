<?php

namespace app\common\validate;

use think\Validate;

class DoctorLogin extends Validate
{
    protected $rule = [
        'phone'=>'require',
        'password'=>'require',
    ];
    protected $message = [
        'phone.require'=>'请输入手机',
        'password.require'=>'请输入密码',
    ];
}