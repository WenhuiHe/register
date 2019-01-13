<?php

namespace app\hospital\controller;

use think\Controller;
use think\Session;

class Login extends Controller
{
    public function login()
    {
        if(request()->isPost()){
            $res = (new \app\common\model\Hospital())->login(input('post.'));
            if($res['valid'])
            {
                //说明登录成功
                $this->success($res['msg'],'/hospital');exit;
            }else{
                //说明登录失败
                $this->error($res['msg']);exit;
            }
        }
        //加载我们登录页面
        return $this->fetch('login');
    }

    public function logout() {
        Session::delete('id');
        Session::delete('loginname');
        Session::delete('name');
        Session::delete('role');
        $this->redirect('/hospital/login');
    }
}