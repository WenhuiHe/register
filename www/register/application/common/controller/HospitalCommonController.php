<?php

namespace app\common\controller;

use think\Controller;
use think\Session;
use think\Request;

class HospitalCommonController extends Controller
{
    public function __construct(Request $request = null) {

        parent::__construct($request);
        if(!Session::has('role') || Session::get('role') != 'hospital' || !Session::has('loginname')) {
            $this->redirect('/hospital/login');
        }
        $this->assign('user', Session::get('name'));
        $avatar = "static/images/avatar.png";
        $this->assign('avatar', $avatar);
    }
}