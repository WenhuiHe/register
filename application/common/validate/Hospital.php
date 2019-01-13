<?php

namespace app\common\validate;

use think\Validate;

class Hospital extends Validate
{
    protected $rule = [
        'loginname'=>'require',
        'name'=>'require',
        'password'=>'require',
    ];
    protected $message = [
        'loginname.require'=>'请输入登录名',
        'name.require'=>'请输入医院名称',
        'password.require'=>'请输入密码',
    ];
}