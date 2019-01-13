<?php

use \think\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});


Route::any('admin/login', 'admin/Login/login');
Route::any('admin/logout', 'admin/Login/logout');
Route::any('admin/hospital/insert', 'admin/Hospital/inserthp');
Route::any('admin/hospital/modify/:id', 'admin/Hospital/modifyhp');
Route::any('admin/hospital/:id', 'admin/Hospital/hospital');
Route::any('admin/hospital', 'admin/Hospital/hospital');

Route::any('admin/admin/insert', 'admin/Admin/insert');
Route::any('admin/admin/modify/:id', 'admin/Admin/modify');
Route::any('admin/admin/:id', 'admin/Admin/admin');
Route::any('admin/admin', 'admin/Admin/admin');

Route::any('admin/bgdept/insert', 'admin/Bgdept/insertbgdept');
Route::any('admin/bgdept/:id', 'admin/Bgdept/bgdept');
Route::any('admin/bgdept', 'admin/Bgdept/bgdept');
Route::any('admin', 'admin/Admin/index');


Route::any('hospital/login', 'hospital/Login/login');
Route::any('hospital/logout', 'hospital/Login/logout');
Route::any('hospital/doctor/insert', 'hospital/Doctor/insertdr');
Route::any('hospital/doctor/:id', 'hospital/Doctor/doctor');
Route::any('hospital/doctor', 'hospital/Doctor/doctor');
Route::any('hospital/smdept/getsmdept/:id', 'hospital/Smdept/getsmdept');
Route::any('hospital/smdept/insert', 'hospital/Smdept/insertsmdept');
Route::any('hospital/smdept', 'hospital/Smdept/smdept');
Route::any('hospital/profile', 'hospital/Hospital/profile');
Route::any('hospital', 'hospital/Hospital/index');

Route::any('doctor/login', 'doctor/Login/login');
Route::any('doctor/logout', 'doctor/Login/logout');
Route::any('doctor/worktime/modify', 'doctor/Worktime/modify');
Route::any('doctor/worktime', 'doctor/Worktime/worktime');
Route::any('doctor/allreg', 'doctor/Doctor/allreg');
Route::any('doctor/reg/detail/:id', 'doctor/Doctor/detail');
Route::any('doctor/reg/modify/:id', 'doctor/Doctor/modify');
Route::any('doctor/profile', 'doctor/Doctor/profile');
Route::any('doctor', 'doctor/Doctor/index');


Route::any('/login', 'user/Login/login');
Route::any('/logout', 'user/Login/logout');
Route::any('/reg', 'user/Login/reg');
Route::any('/index', 'user/Index/index');
Route::any('/dpt/:id', 'user/Dept/dpt');
Route::any('/smdpt/drdetail', 'user/Dept/drdetail');
Route::any('/smdpt/reg', 'user/User/register');
Route::any('/smdpt/:id', 'user/Dept/smdpt');
Route::any('/user/profile', 'user/User/profile');
Route::any('/user', 'user/User/register');
Route::any('/', 'user/Index/index');









return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
