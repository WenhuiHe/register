<?php

namespace app\admin\controller;


use app\common\controller\AdminCommonController;
use think\Db;

class Bgdept extends AdminCommonController
{
    public function bgdept($id=0) {
        if($this->request->isGet()) {
            $res = Db::table('bgdept')->select();
            $this->assign('res', $res);
            return $this->fetch('bgdept');
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

    public function insertbgdept() {
        if($this->request->isPost()) {
            $data = input('post.');
            $res = Db::table('bgdept')->insert($data);
            if(!$res)
                $this->error('插入失败');
            $this->redirect('/admin/bgdept');
        }
    }

}