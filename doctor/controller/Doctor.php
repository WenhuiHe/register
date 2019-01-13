<?php

namespace app\doctor\controller;

use app\common\controller\DoctorCommonController;
use think\Db;
use think\Session;


class Doctor extends DoctorCommonController
{
    public function index() {

        $res = Db::table('reg')
            ->alias('r')
            ->where('r.doctor_id', Session::get('id'))
            ->where('r.date', date("Y-m-d"))
            ->join('user u', 'r.user_id = u.id')
            ->field('r.id as id, u.id as user_id, u.name as user, r.date as date, r.time as time, 
            u.phone as user_phone, r.description as description, r.status as status, r.suggestion as suggestion')
            ->select();
        $this->assign('res', $res);
        return $this->fetch('index');
    }

    public function allreg() {
        $res = Db::table('reg')
            ->alias('r')
            ->where('r.doctor_id', Session::get('id'))
            ->join('user u', 'r.user_id = u.id')
            ->field('r.id as id, u.id as user_id, u.name as user, 
            r.date as date, r.time as time, 
            u.phone as user_phone, r.description as description, 
            r.status as status, r.suggestion as suggestion')
            ->select();
        $this->assign('res', $res);
        return $this->fetch('allreg');
    }

    public function detail($id=0) {
        if($this->request->isGet()) {
            $res = Db::table('reg')
                ->alias('r')
                ->where('r.id', $id)
                ->join('user u', 'r.user_id = u.id')
                ->field('r.id as id, u.id as user_id, u.name as user, 
                r.date as date, r.time as time, 
                u.phone as user_phone, r.description as description,
                r.status as status, r.suggestion as suggestion')
                ->find();
            $this->assign('res', $res);
            return $this->fetch('detail');
        }


    }

    public function modify($id=0) {
        $res = Db::table('reg')
            ->alias('r')
            ->where('r.id', $id)
            ->join('user u', 'r.user_id = u.id')
            ->field('r.id as id, u.id as user_id, u.name as user, 
                r.date as date, r.time as time, 
                u.phone as user_phone, r.description as description,
                r.status as status, r.suggestion as suggestion')
            ->find();
        $this->assign('res', $res);
        if($this->request->isPost()) {
            $data = input('post.');
            $res = Db::table('reg')->update($data);
            if(!$res) {
                $this->error('修改失败');
            }
            $this->success('修改成功', '/doctor');
        }
        return $this->fetch('modify');
    }

    public function profile() {
        $id = Session::get('id');
        $res = Db::table('doctor')->where('id', $id)->find();
        $this->assign('res', $res);

        if($this->request->isPost()) {
            $data = input('post.');
            $data['password'] = md5('reg'.$data['password']);
            $res = Db::table('doctor')
                ->where('id', $id)
                ->update($data);
            if(!$res) {
                $this->error('修改失败');
            }
            $this->success('修改成功', '/doctor');
        }

        return $this->fetch('profile');
    }
}