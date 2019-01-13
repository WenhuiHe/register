<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"/Applications/XAMPP/xamppfiles/htdocs/guahao/public/../application/user/view/login/reg.html";i:1523584530;s:78:"/Applications/XAMPP/xamppfiles/htdocs/guahao/application/common/view/user.html";i:1523580676;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="/static/assets/css/bootstrap.css" />
    <link rel="stylesheet" href="/static/assets/css/font-awesome.css" />
    <!-- text fonts -->
    <link rel="stylesheet" href="/static/assets/css/ace-fonts.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="/static/assets/css/ace.css"
          class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/static/assets/css/ace-part2.css" class="ace-main-stylesheet" />
    <![endif]-->
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/static/assets/css/ace-ie.css" />
    <![endif]-->

</head>
<body>
<style>
    body {
        background-color: white;
    }
    .dbnav {
        background-color: #f5f5f5;
        color: #868686;
        height: 30px;
        font-size: 13px;
        padding-top: 5px;
    }
    .container{
        max-width: 1000px;
    }
    .nav-bar {
        background-color: #60bff2;
    }
    .nav li {
        display: inline-block;
    }
    .nav li a{
        color: white;
        font-size: medium;
        text-align: center;
    }
</style>
<div class="dbnav">
    <div class="container">
        <p class="dbnav-left hidden-sm hidden-xs" style="float: left">
            <span>18811080655 电话预约</span>
        </p>
        <p class="dbnav-left" style="float: right">
            <span>欢迎来到肥肉片挂号统一平台&nbsp;&nbsp;
                <?php if(isset($role) AND $role == 'user'): ?>
                您好，<?php echo $name; ?>  &nbsp;&nbsp; <a href="/user">个人中心</a> &nbsp;&nbsp; <a href="/logout">退出登录</a>
                <?php else: ?>
                请  <a onclick="userlogin()">登录</a>  <a href="/reg">注册</a>
                <?php endif; ?>
            </span>
        </p>
    </div>
</div>
<div class="top">
    <div class="container">
    <div class="row">
        <div style="height: 75px; margin-top: 20px; margin-bottom: 20px;" class="top-left col-xs-12">
            <a href="/" style="text-decoration: none">
                <img src="/static/images/avatar.png" height="100%" style="float: left; border-radius: 90px">
                <h2 style="color: #006db3; padding-left: 90px;">肥肉片预约挂号统一平台</h2>
            </a>
        </div>

    </div>
    </div>
</div>

<div class="main-content">
    <div class="nav-bar">
        <div class="container" >
            <ul class="nav">
                <li><a href="/">按科室挂号</a></li>
                <li><a href="/hp">按医院挂号</a></li>
                <li><a href="/ill">按疾病挂号</a></li>
                <li><a href="/notice">公告</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        

<style>
    .reg-form {
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="reg-form">
    <form class="form-horizontal style-form" method="post" enctype="multipart/form-data" action="/reg">
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">姓名</label>
            <div class="col-sm-9">
                <input name="name" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">手机</label>
            <div class="col-sm-9">
                <input name="phone" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">身份证号</label>
            <div class="col-sm-9">
                <input name="idcard" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">密码</label>
            <div class="col-sm-9">
                <input name="password" type="password" class="form-control" required="required">
            </div>
        </div>
        <div class="col-lg-offset-3 col-lg-3">
            <button class="btn btn-info no-border">注册</button>
        </div>

    </form>
    </div>
    
    
</div>


    </div>

</div>
<div></div>

<!-- Modal -->
<div class="modal fade" id="user-login" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">请输入手机号和密码</h4>
            </div>
            <div class="modal-body form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">手机号</label>
                    <div class="col-sm-10">
                        <input name="phone" type="text" id="user-phone"
                               class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-10">
                        <input name="password" type="password" id="user-password"
                               class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary no-border"
                        data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-success no-border"
                        onclick="login()">登录</button>
            </div>

        </div>
    </div>
</div>


<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='/static/assets/js/jquery.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='/static/assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='/static/assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
</script>

<script src="/static/assets/js/bootstrap.js"></script>
<script>
    function userlogin() {
        $("#user-login").modal('show');
    }
    function login() {
        var user_phone = $("#user-phone").val();
        var user_password = $("#user-password").val();
        $.ajax({
            url: '/login',
            type: 'post',
            data: {phone: user_phone, password: user_password},
            dataType: 'json',
            success: function(result) {
                if(result.valid == 1) {
                    window.location.reload();
                }
                else
                {
                    alert('登录失败，请稍后重试');
                    return false;
                }
            },
            error: function () {
                alert("出错了");
            }
        });
    }
</script>


</body>
</html>