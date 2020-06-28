<?php
require 'db.php';
session_start();
date_default_timezone_set('UTC');
$data = $_POST;
$err = [];
$date = date('l jS \of F Y');


$user = R::findOne('users', 'login = ?', [$data['login']]);
if (isset($user)){
    if ($data['password'] == $user->password){
        $user->last_online = $date;
        R::store($user);
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $data['login'];
        $code = 200;
        echo $code;
    } else {
        $err[] = 'Не верный пароль'; 
    }
} else {
    $err[] = 'Пользователь с таким логином не найден';
    }

    
echo array_shift($err);
    