<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"/Applications/XAMPP/xamppfiles/htdocs/guahao/public/../application/user/view/user/user.html";i:1523615646;s:78:"/Applications/XAMPP/xamppfiles/htdocs/guahao/application/common/view/user.html";i:1523580676;}*/ ?>
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
    .user-panel {
        margin-top: 20px;
    }
    .reg-table{
        padding: 10px;
        border: none;
    }
    .user-panel .nav li a {
        color: #888888;
    }
</style>

<div class="container">
        <!-- #section:elements.tab -->
        <div class="tabbable user-panel">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#reg">
                        我的预约
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#profile">
                        我的信息
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#modify">
                        修改资料
                    </a>
                </li>

            </ul>

            <div class="tab-content">
                <div id="reg" class="tab-pane fade in active">
                    <div class="row">
                        <div class="table-responsive reg-table">
                            <table class="table table-striped table-bordered table-hover" id="worktime-table">
                                <thead>
                                <tr>
                                    <th>预约日期</th>
                                    <th>时间</th>
                                    <th>医院</th>
                                    <th>科室</th>
                                    <th>医生</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): if( count($res)==0 ) : echo "" ;else: foreach($res as $key=>$item): ?>
                                <tr>
                                    <td><?php echo $item['date']; ?></td>
                                    <td>
                                        <?php if($item['time'] == 1): ?>
                                        上午
                                        <?php elseif($item['time'] == 2): ?>
                                        下午
                                        <?php else: ?>
                                        晚上
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $item['hospital']; ?></td>
                                    <td><?php echo $item['bgdept']; ?>-<?php echo $item['smdept']; ?></td>
                                    <td><?php echo $item['doctor']; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info no-border"
                                                onclick="cancelreg('<?php echo $item['date']; ?>', <?php echo $item['time']; ?>, <?php echo $item['doctor_id']; ?>)">取消预约</button>
                                    </td>
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="profile" class="tab-pane fade">
                    <form class="form-horizontal style-form">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">姓名</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" class="form-control" required="required" value="<?php echo $user['name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">手机</label>
                            <div class="col-sm-9">
                                <input name="phone" type="text" class="form-control" required="required" value="<?php echo $user['phone']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">身份证</label>
                            <div class="col-sm-9">
                                <input name="idcard" type="text" class="form-control" required="required" value="<?php echo $user['idcard']; ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="modify" class="tab-pane fade">
                    <form class="form-horizontal style-form" method="post" action="/user/profile">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">姓名</label>
                            <div class="col-sm-9">
                                <input name="id" type="text" value="<?php echo $user['id']; ?>" style="display: none">
                                <input name="name" type="text" class="form-control" required="required" value="<?php echo $user['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">手机</label>
                            <div class="col-sm-9">
                                <input name="phone" type="text" class="form-control" required="required" value="<?php echo $user['phone']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">身份证</label>
                            <div class="col-sm-9">
                                <input name="idcard" type="text" class="form-control" required="required" value="<?php echo $user['idcard']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">密码</label>
                            <div class="col-sm-9">
                                <input name="password" type="password" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <button class="btn btn-info no-border">提交修改</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
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



<script>
    function cancelreg(date, time, doctor_id) {
        $.ajax({
            url: '/user/register',
            type: 'delete',
            data: {date: date, time: time, doctor_id: doctor_id},
            datatype: 'json',
            success: function (res) {
                if(!res.valid) {
                    alert(res.msg);
                }
                else {
                    alert(res.msg);
                    window.location.reload();
                }
            },
            error: function () {
                alert('出错了');
            }
        })
    }
</script>


</body>
</html>