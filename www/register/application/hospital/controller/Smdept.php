<?php

namespace app\hospital\controller;

use app\common\controller\HospitalCommonController;
use think\Db;
use think\Session;

class Smdept extends HospitalCommonController
{
    public function smdept($id=0) {
        if($this->request->isGet()) {
            $res = Db::table('smdept')
                ->where('hospital', Session::get('id'))
                ->join('bgdept', 'smdept.bgdept = bgdept.id')
                ->field('smdept.id, smdept.name, bgdept.name as bgdept')
                ->select();
            $this->assign('res', $res);
            $bgdept = Db::table('bgdept')->select();
            $this->assign('bgdept', $bgdept);
            return $this->fetch('smdept');
        }

        if($this->request->isDelete()) {
            $res = Db::table('bgdept')
                ->where('id', $id)
                ->find();
            if(!$res) {
                return json(['valid' => 0, 'msg' => '查找不到此科室']);
            }
            $res = Db::table('bgdept')
                ->delete($id);
            if(!$res) {
                return json(['valid' => 0, 'msg' => '删除失败，未知原因']);
            }
            return json(['valid' => 1, 'msg' => '删除成功']);
        }
    }

    public function getsmdept($id) {
        if($this->request->isPost()) {
            $smdept = Db::table('smdept')
                ->where('hospital', Session::get('id'))
                ->where('bgdept', $id)
                ->select();
            return json($smdept);
        }
    }

    public function insertsmdept() {
        if($this->request->isPost()) {
            $data = input('post.');
            $data['hospital'] = Session::get('id');
            $res = Db::table('smdept')->insert($data);
            if(!$res)
                $this->error('插入失败');
            $this->redirect('/hospital/smdept');
        }
    }

}