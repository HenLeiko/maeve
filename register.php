<?php
session_start();
require_once 'db.php';
include 'wrigthlog.php';
date_default_timezone_set('UTC');
$data = $_POST;
$err = [];
$date = date('l jS \of F Y');
print_r($data);
require 'validation.php';

if (empty($err)) {
    $users = R::dispense('users');
    $profile = R::dispense('profiles');
    $users->email = $data['email'];
    $users->login = $data['login'];
    $users->password = $data['password'];
    $users->reg_date = $date;
    $users->status = 'active';
    $users->rol = 'Пользователь';

    $profile->user = $users;
    $profile->reg_date = $date;
    $profile->last_online = $date;
    R::store($users);
    R::store($profile);
    $user = R::findOne('users', 'login = ?', [$data['login']]);

    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $data['login'];
    $_SESSION['status'] = 'active';
    
    $text = 'Регистрация успешно пройдена пользователем: '. $_SESSION['login'];
    logFile($text);
    $code = 201;
    echo $code;
} else {
    echo array_shift($err);
}