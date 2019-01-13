<?php

namespace app\common\validate;

use think\Validate;

class AdminLogin extends Validate
{
    protected $rule = [
        'phone'=>'require',
        'password'=>'require',
    ];
    protected $message = [
        'phone.require'=>'请输入用户名',
        'password.require'=>'请输入密码',
    ];
}