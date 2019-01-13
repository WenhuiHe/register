<?php

namespace app\common\validate;


use think\Validate;

class HospitalLogin extends Validate
{
    protected $rule = [
        'loginname'=>'require',
        'password'=>'require',
    ];
    protected $message = [
        'loginname.require'=>'请输入登录名',
        'password.require'=>'请输入密码',
    ];
}