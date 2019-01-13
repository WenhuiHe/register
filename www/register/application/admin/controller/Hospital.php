<?php

namespace app\admin\controller;


use app\common\controller\AdminCommonController;
use think\Db;

class Hospital extends AdminCommonController
{
    public function hospital($id=0) {
        if($this->request->isGet()) {
            if($id == 0) {
                $res = Db::table('hospital')->select();
                $this->assign('res', $res);
                return $this->fetch('hospital');
            }
            else {
                $res = Db::table('hospital')
                    ->where('id', $id)
                    ->find();
                $this->assign('res', $res);
                return $this->fetch('viewhp');
            }
        }

        if($this->request->isDelete()) {
            $res = Db::table('hospital')
                ->where('id', $id)
                ->find();
            if(!$res) {
                return json(['valid' => 0, 'msg' => '查找不到此医院']);
            }
            $res = Db::table('hospital')
                ->delete($id);
            if(!$res) {
                return json(['valid' => 0, 'msg' => '删除失败，未知原因']);
            }
            return json(['valid' => 1, 'msg' => '删除成功']);
        }
    }

    public function inserthp() {
        if($this->request->isPost()) {
            $data = input('post.');
            $pic = $_FILES['pic']['tmp_name'];
            $upload_ret = false;

            if($pic){
                // 上传的路径，建议写物理路径
                $uploadDir = 'static/upload';
                // 创建文件夹
                if(!file_exists($uploadDir)){
                    mkdir($uploadDir, 0777);
                }
                // 用时间戳来保存图片，防止重复
                $targetFile = $uploadDir . '/' . time() . $_FILES['pic']['name'];
                // 将临时文件 移动到我们指定的路径，返回上传结果
                $upload_ret = move_uploaded_file($pic, $targetFile) ? true : false;
                if(!$upload_ret) {
                    $this->error('图片上传失败');
                }
                $data['pic'] = $targetFile;
            }

            $res = (new \app\common\model\Hospital())->insert($data);
            if(!$res['valid']) {
                $this->error($res['msg']);
            }
            else {
                redirect('/admin/hospital');
            }
        }
        return $this->fetch('inserthp');
    }

    public function modifyhp($id) {
        $res = Db::table('hospital')->where('id', $id)->find();
        $this->assign('res', $res);
        if($this->request->isPost()) {
            $date = input('post.');
            $res = Db::table('hospital')->where('id', $id)->find();

            if(!$res) {
                $this->error('没有此医院');exit;
            }

            $pic = $_FILES['pic']['tmp_name'];
            $upload_ret = false;
            if($pic){
                // 上传的路径，建议写物理路径
                $uploadDir = 'static/upload';
                // 创建文件夹
                if(!file_exists($uploadDir)){
                    mkdir($uploadDir, 0777);
                }
                // 用时间戳来保存图片，防止重复
                $targetFile = $uploadDir . '/' . time() . $_FILES['pic']['name'];
                // 将临时文件 移动到我们指定的路径，返回上传结果
                $upload_ret = move_uploaded_file($pic, $targetFile) ? true : false;
                if(!$upload_ret) {
                    $this->error('图片上传失败');exit;
                }
                $data['pic'] = $targetFile;
            }

            if(!isset($data['pic']))
                $data['pic'] = 'static/upload/hospital.jpg';

            $res = Db::table('hospital')
                ->where('id', $id)
                ->update(['loginname' => $date['loginname'], 'name' => $date['name'],
                    'password' => md5('reg'.$date['password']), 'description' => $date['description'],
                    'pic' => $data['pic']]);

            if(!$res) {
                $this->error('修改失败');exit;
            }
            else {
                redirect('/admin/hospital');
            }
        }
        return $this->fetch('modifyhp');
    }
}