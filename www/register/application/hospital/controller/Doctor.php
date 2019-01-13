<?php

namespace app\hospital\controller;


use app\common\controller\HospitalCommonController;
use think\Db;
use think\Session;

class Doctor extends HospitalCommonController
{
    public function doctor($id=0) {
        if($this->request->isGet()) {
            if($id == 0) {
                $res = Db::table('doctor')
                    ->join('smdept', 'doctor.smdept = smdept.id')
                    ->join('bgdept', 'smdept.bgdept = bgdept.id')
                    ->join('hospital', 'smdept.hospital = hospital.id')
                    ->where('smdept.hospital', Session::get('id'))
                    ->field('doctor.id, doctor.name, doctor.phone, doctor.email, 
                    doctor.bphone, doctor.bemail, doctor.type, doctor.resume, doctor.photo,
                    bgdept.name as bgdept, smdept.name as smdept, smdept.hospital')
                    ->select();
                $this->assign('res', $res);
                return $this->fetch('doctor');
            }
            else {
                $res = Db::table('doctor')
                    ->where('doctor.id', $id)
                    ->join('smdept', 'doctor.smdept = smdept.id')
                    ->join('bgdept', 'smdept.bgdept = bgdept.id')
                    ->join('hospital', 'smdept.hospital = hospital.id')
                    ->field('doctor.id, doctor.name, doctor.phone, doctor.email, 
                    doctor.bphone, doctor.bemail, doctor.type, doctor.resume, doctor.photo,
                    bgdept.name as bgdept, smdept.name as smdept')
                    ->find();
                $this->assign('res', $res);
                return $this->fetch('viewdr');
            }
        }

        if($this->request->isDelete()) {
            $res = Db::table('doctor')
                ->where('id', $id)
                ->find();
            if(!$res) {
                return json(['valid' => 0, 'msg' => '查找不到此医生']);
            }
            $res = Db::table('doctor')
                ->delete($id);
            if(!$res) {
                return json(['valid' => 0, 'msg' => '删除失败，未知原因']);
            }
            return json(['valid' => 1, 'msg' => '删除成功']);
        }
    }

    public function insertdr() {
        if($this->request->isPost()) {
            $data = input('post.');

            $res = (new \app\common\model\Doctor())->insert($data);
            if(!$res) {
                $this->error('添加失败');
            }
            else {
                redirect('/hospital/doctor');
            }
        }
        $bgdept = Db::table('bgdept')->select();
        $this->assign('bgdept', $bgdept);
        return $this->fetch('insertdr');
    }

    public function modifydr($id) {

    }
}