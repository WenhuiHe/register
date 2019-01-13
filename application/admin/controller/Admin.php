<?php

namespace app\admin\controller;

use app\common\controller\AdminCommonController;
use think\Db;

class Admin extends AdminCommonController
{
    public function index() {
        $count['hospital'] = Db::table('hospital')->count();
        $count['smdept'] = Db::table('smdept')->count();
        $count['doctor'] = Db::table('doctor')->count();
        $count['user'] = Db::table('user')->count();
        $count['reg'] = Db::table('reg')->count();
        $count['admin'] = Db::table('admin')->count();

        $this->assign('count', $count);
        return $this->fetch('index');
    }

    public function admin($id=0) {
        if($this->request->isGet()) {
            if($id == 0) {
                $res = Db::table('admin')->select();
                $this->assign('res', $res);
                return $this->fetch('admin');
            }
            else {
                $res = Db::table('admin')
                    ->where('id', $id)
                    ->find();
                $this->assign('res', $res);
                return $this->fetch('view');
            }
        }

        if($this->request->isDelete()) {
            $res = Db::table('admin')
                ->where('id', $id)
                ->find();
            if(!$res) {
                return json(['valid' => 0, 'msg' => '查找不到此管理员']);
            }
            $res = Db::table('admin')
                ->delete($id);
            if(!$res) {
                return json(['valid' => 0, 'msg' => '删除失败，未知原因']);
            }
            return json(['valid' => 1, 'msg' => '删除成功']);
        }
    }

    public function insert() {
        if($this->request->isPost()) {
            $data = input('post.');
            $data['password'] = md5('reg'.$data['password']);
            $res = Db::table('admin')->insert($data);
            if(!$res) {
                $this->error('添加失败');
            }
            else{
                $this->success('添加成功', '/admin/admin');
            }
        }
        return $this->fetch('insert');
    }

    public function modify($id) {
        $res = Db::table('admin')
            ->where('id', $id)
            ->find();
        if(!$res) {
            $this->error('查找不到此管理员');
        }

        $this->assign('res', $res);
        if($this->request->isPost()) {
            $data = input('post.');
            $data['password'] = md5('reg'.$data['password']);
            $res = Db::table('admin')
                ->where('id', $id)
                ->find();
            if(!$res) {
                $this->error('查找不到此管理员');
            }

            $res = Db::table('admin')->where('id', $id)->update($data);
            if(!$res) {
                $this->error('修改失败');exit;
            }
            else{
                $this->success('修改成功', '/admin/admin');
            }
        }
        return $this->fetch('modify');
    }
}