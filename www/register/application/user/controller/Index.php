<?php

namespace app\user\controller;




use app\common\controller\UserNoLoginCommonController;

class Index extends UserNoLoginCommonController
{
    public function index() {
        return $this->fetch('index');
    }
}