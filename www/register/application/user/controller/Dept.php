<?php

namespace app\user\controller;


use app\common\controller\UserNoLoginCommonController;
use think\Db;
use think\Session;

class Dept extends UserNoLoginCommonController
{
    public function dpt($id = 0) {
        $dpt = Db::table('smdept')->where('id', $id)->find();
        $hospital = Db::table('smdept')
            ->alias('s')
            ->where('s.name', $dpt['name'])
            ->join('hospital h', 's.hospital = h.id')
            ->field('h.id as hospital_id, h.name as hospital,
            h.pic, h.description, s.id as dept_id, s.name as dept')
            ->select();
        $this->assign('dpt', $dpt);
        $this->assign('hp', $hospital);
        return $this->fetch('dpt');
    }

    public function smdpt($id = 0) {
        $dpt = Db::table('smdept')
            ->alias('s')
            ->where('s.id', $id)
            ->join('hospital h', 's.hospital = h.id')
            ->field('h.id as hospital_id, h.name as hospital,
            h.pic, h.description, s.id as dept_id, s.name as dept')
            ->find();
        for ($i = 1; $i<8; $i++) {
            $days[$i] = date("Y-m-d",strtotime("+".($i+1)."day"));
        }
        $weekarray=array("日","一","二","三","四","五","六");
        $weekarraynum=array(7,1,2,3,4,5,6);
        foreach ($days as $item) {
            $arr=explode("-", $item);
            //参数赋值
            //年
            $year=$arr[0];
            //月，输出2位整型，不够2位右对齐
            $month=sprintf('%02d',$arr[1]);
            //日，输出2位整型，不够2位右对齐
            $day=sprintf('%02d',$arr[2]);
            //时分秒默认赋值为0；
            $hour = $minute = $second = 0;
            //转换成时间戳
            $strap = mktime($hour,$minute,$second,$month,$day,$year);
            $dayszh[$item] = "星期".$weekarray[date("w",$strap)];
            $daysnum = $weekarraynum[date("w",$strap)];
        }

        $regnum = Db::query('select w.day, w.time, sum(regnum)
            from worktime w join doctor d on w.doctor_id = d.id
            where d.smdept = '.$id.' 
            group by w.day, w.time');


        $regnums = null;
        foreach($regnum as $item) {
            $min = Db::table('reg')
                ->join('doctor', 'reg.doctor_id = doctor.id')
                ->where('date', date("Y-m-d",
                    strtotime("+2 day")))
                ->where('time', $item['time'])
                ->where('smdept', $id)
                ->count();
            $regnums[$weekarraynum[$item['day']]][$item['time']] = $item['sum(regnum)'] - $min;
        }

        $this->assign('dpt', $dpt);
        $this->assign('days', $days);
        $this->assign('daysnum', $daysnum);
        $this->assign('dayszh', $dayszh);
        $this->assign('regnums', $regnums);
        return $this->fetch('smdpt');
    }

    public function drdetail() {
        if ($this->request->isGet()) {
            $data = input('get.');
            $res = Db::table('worktime')
                ->alias('w')
                ->join('doctor d', 'w.doctor_id = d.id')
                ->where('w.day', $data['day'])
                ->where('w.time', $data['time'])
                ->where('d.smdept', $data['smdept'])
                ->field('d.id as drid, d.name as drname, 
                d.type as type, d.resume as resume,
                w.regnum as regnum, 
                w.day as day, w.time as time')
                ->select();
            for ($i = 1; $i<8; $i++) {
                $days[$i] = date("Y-m-d",strtotime("+".($i+1)."day"));
            }
            foreach ($res as &$item) {
                $min = Db::table('reg')
                    ->where('date', $days[($data['day']-date('w')+5)%7+1])
                    ->where('time', $item['time'])
                    ->where('doctor_id', $item['drid'])
                    ->count();
                $item['regnum'] = $item['regnum'] - $min;
                $item['date'] = $days[($data['day']-date('w')+5)%7+1];
            }
            return json($res);
        }
    }
}