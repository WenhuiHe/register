<?php

namespace app\doctor\controller;


use app\common\controller\DoctorCommonController;
use think\Db;
use think\Session;

class Worktime extends DoctorCommonController
{
    public function worktime() {
        if($this->request->isGet()) {
            $res = Db::table('worktime')
                ->where('doctor_id', Session::get('id'))
                ->select();
            $worktime = null;
            foreach($res as $item) {
                $worktime[$item['day']][$item['time']] = $item['regnum'];
            }
            $this->assign('worktime', $worktime);
        }
        return $this->fetch('worktime');
    }

    public function modify() {
        if($this->request->isPost()) {
            $data = input('post.');
            $data['doctor_id'] = Session::get('id');
            $res = Db::table('worktime')
                ->where('day', $data['day'])
                ->where('time', $data['time'])
                ->where('doctor_id', $data['doctor_id'])
                ->find();
            if($res && $data['regnum'] == 0) {
                $res = Db::table('worktime')->where('id', $res['id'])->delete();
            }
            elseif($res && $data['regnum'] != $res['regnum']) {
                $res = Db::table('worktime')
                    ->where('id', $res['id'])
                    ->update(['regnum' => $data['regnum']]);
            }
            else {
                $res = Db::table('worktime')->insert($data);
            }

            if(!$res){
                return json(['valid' => 0, 'msg' => '修改失败，稍后再试']);
            }
            return json(['valid' => 1, 'msg' => '修改成功']);
        }

    }


}