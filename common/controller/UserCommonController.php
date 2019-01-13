<?php

namespace app\common\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Request;

class UserCommonController extends UserNoLoginCommonController
{
    public function __construct(Request $request = null) {

        parent::__construct($request);
        if(!Session::has('role') || Session::get('role') != 'user' || !Session::has('phone')) {
            $this->assign('login', false);
        }

    }
}