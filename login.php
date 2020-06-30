<?php
require 'db.php';
session_start();
include 'wrigthlog.php';
date_default_timezone_set('UTC');
$data = $_POST;
$err = [];
$date = date('l jS \of F Y');


$user = R::findOne('users', 'login = ?', [$data['login']]);
if (isset($user)){
    if ($data['password'] == $user->password){
        $profile = R::findOne('profiles', 'user_id = ?', [$user['id']]);
        $user->last_online = $date;
        R::store($user);
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $data['login'];
        $_SESSION['avatar'] = $profile['avatar'];
        @$users->status = 'active'; 
        $text = 'Авторизация успешно пройдена пользователем: '. $_SESSION['login'];
        $code = 200;
        echo $code;
    } else {
        $err[] = 'Не верный пароль'; 
    }
} else {
    $err[] = 'Пользователь с таким логином не найден';
    }

    
echo array_shift($err);
