<?php

namespace app\common\controller;

use think\Controller;
use think\Session;
use think\Request;
use think\Db;

class UserNoLoginCommonController extends Controller
{
    public function __construct(Request $request = null) {

        parent::__construct($request);
        if(Session::has('name'))
            $this->assign('name', Session::get('name'));
        if(Session::has('role'))
            $this->assign('role', Session::get('role'));
        $avatar = "static/images/avatar.png";
        $this->assign('avatar', $avatar);
        $bgdept = Db::table('bgdept')->select();
        $this->assign('bgdept', $bgdept);
        $smdept = [];
        foreach ($bgdept as $item) {
            $s = $item['id'];
//            $smdept[$s] = Db::table('smdept')
//                ->where('bgdept', $item['id'])
//                ->distinct(true, 'id')
//                ->field('id, name')
//                ->select();
            $smdept[$s] = Db::query("select *, count(distinct name) from smdept 
              where bgdept = ".$item['id']. " group by name");
        }
        $this->assign('smdept', $smdept);
    }
}