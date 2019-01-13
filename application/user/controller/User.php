<?php

namespace app\user\controller;


use app\common\controller\UserCommonController;
use think\Db;
use think\Session;

class User extends UserCommonController
{

    public function register() {
        if ($this->request->isPost()) {
            $data = input('post.');
            $data['user_id'] = Session::get('id');
            $res = Db::table('reg')
                ->insert($data);
            if(!$res) {
                return json(['valid' => 0, 'msg' => '预约失败']);
            }
            return json(['valid' => 1, 'msg' => '预约成功']);
        }

        if($this->request->isGet()) {
            $res = Db::table('reg')
                ->alias('r')
                ->where('r.user_id', Session::get('id'))
                ->join('doctor d', 'r.doctor_id = d.id')
                ->join('smdept s', 'd.smdept = s.id')
                ->join('hospital h', 's.hospital = h.id')
                ->join('bgdept b', 's.bgdept = b.id')
                ->field('r.date as date, r.time as time, h.name as hospital, b.name as bgdept,
                s.name as smdept, r.doctor_id as doctor_id, d.name as doctor')
                ->select();
            $this->assign('res', $res);
            $user = Db::table('user')
                ->where('id', Session::get('id'))
                ->find();
            $this->assign('user', $user);
        }
        if($this->request->isDelete()) {
            $data = input('delete.');
            $data['user_id'] = Session::get('id');
            $res = Db::table('reg')
                ->where('user_id', $data['user_id'])
                ->where('time', $data['time'])
                ->where('date', $data['date'])
                ->where('doctor_id', $data['doctor_id'])
                ->delete();
            if(!$res) {
                return json(['valid' => 0, 'msg' => '取消预约失败']);
            }
            return json(['valid' => 1, 'msg' => '取消预约成功']);
        }
        return $this->fetch('user');
    }


    public function profile() {
        if($this->request->isPost()) {
            $data = input('post.');
            $data['password'] = md5('reg'.$data['password']);
            $res = Db::table('user')
                ->where('id', $data['id'])
                ->find();
            if(!$res) {
                $this->error('查找不到此用户');
            }

            $res = Db::table('user')->where('id', $data['id'])->update($data);
            if(!$res) {
                $this->error('修改失败');exit;
            }
            else{
                $this->success('修改成功', '/user');
            }
        }
    }
}