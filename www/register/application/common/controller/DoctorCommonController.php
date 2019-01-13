<?php

namespace app\common\controller;

use think\Controller;
use think\Session;
use think\Request;

class DoctorCommonController extends Controller
{
    public function __construct(Request $request = null) {

        parent::__construct($request);
        if(!Session::has('role') || Session::get('role') != 'doctor' || !Session::has('phone')) {
            $this->redirect('/doctor/login');
        }
        $this->assign('user', Session::get('name'));
        $avatar = "static/images/avatar.png";
        $this->assign('avatar', $avatar);
    }
}