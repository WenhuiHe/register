<?php

namespace app\common\controller;

use think\Controller;
use think\Session;
use think\Request;

class AdminCommonController extends Controller
{
    public function __construct(Request $request = null) {

        parent::__construct($request);
        if(!Session::has('role') || Session::get('role') != 'admin' || !Session::has('phone')) {
            $this->redirect('/admin/login');
        }
        $this->assign('user', Session::get('phone'));
        $avatar = "static/images/avatar.png";
        $this->assign('avatar', $avatar);
    }
}