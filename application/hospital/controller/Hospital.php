<?php

namespace app\hospital\controller;


use app\common\controller\HospitalCommonController;
use think\Db;
use think\Session;

class Hospital extends HospitalCommonController
{
    public function index() {
        $count['smdept'] = Db::table('smdept')->where('hospital', Session::get('id'))->count();
        $count['doctor'] = Db::table('doctor')
            ->join('smdept', 'doctor.smdept = smdept.id')
            ->where('hospital', Session::get('id'))
            ->count();
        $count['user'] = Db::table('user')
            ->join('reg', 'user.id = reg.user_id')
            ->join('doctor', 'doctor.id = reg.doctor_id')
            ->join('smdept', 'doctor.smdept = smdept.id')
            ->where('hospital', Session::get('id'))
            ->count();
        $count['reg'] = Db::table('reg')
            ->join('doctor', 'doctor.id = reg.doctor_id')
            ->join('smdept', 'doctor.smdept = smdept.id')
            ->where('hospital', Session::get('id'))
            ->count();
        $this->assign('count', $count);
        return $this->fetch('index');
    }

    public function profile() {
        $id = Session::get('id');
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
                redirect('/hospital');
            }
        }
        return $this->fetch('hospital');
    }

}