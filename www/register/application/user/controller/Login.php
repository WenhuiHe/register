<?php

namespace app\user\controller;

use think\Controller;
use think\Db;
use think\Session;

class Login extends Controller
{
    public function login()
    {
        if(request()->isPost()){
            $res = (new \app\common\model\User())->login(input('post.'));
            if($res['valid'])
            {
                return json($res);
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
        Session::delete('phone');
        Session::delete('name');
        Session::delete('role');
        $this->redirect('/');
    }

    public function reg() {

        if($this->request->isPost()) {
            $data = input('post.');
            $data['password'] = md5('reg'.$data['password']);
            $res = Db::table('user')
                ->insert($data);
            if(!$res)
                $this->error('注册失败');
            $this->success('注册成功', '/');
        }
        return $this->fetch('reg');
    }
}