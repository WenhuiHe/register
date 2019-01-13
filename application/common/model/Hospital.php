<?php

namespace app\common\model;

use think\Db;
use think\Model;
use think\Session;

class Hospital extends Model
{
    public function login($data)
    {
        //1.执行验证
        $validate = new \app\common\validate\HospitalLogin();
        //如果验证不通过
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }

        //2.比对用户名和密码是否正确
        $userInfo = Hospital::where('loginname', $data['loginname'])
            ->where('password',md5('reg'.$data['password']))
            ->find();

        if (!$userInfo) {
            //说明在数据库未匹配到相关数据
            return ['valid' => 0, 'msg' => '用户名或者密码不正确'];
        }

        //3.将用户信息存入到session中
        Session::set('id', $userInfo['id']);
        Session::set('loginname', $userInfo['loginname']);
        Session::set('name', $userInfo['name']);
        Session::set('role', 'hospital');
        return ['valid'=>1,'msg'=>'登录成功', 'phone'=>Session::get('loginname')];
    }

    public function insert($data) {
        //1.执行验证
        $validate = new \app\common\validate\Hospital;
        //如果验证不通过
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        $data['password'] = md5('reg'.$data['password']);
        $res = Db::table('hospital')->insert($data);
        if(!$res)
            return ['valid' => 0, 'msg' => '插入失败'];

        return ['valid' => 0, 'msg' => '插入成功'];
    }
}