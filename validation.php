<?php 
$err = [];
$email=$data['email'];
$login=$data['login'];
$password=$data['password'];
$repeat_password=$data['repeat_password'];
if (empty($email)){
    $err[] = 'Введите вашу почту';    
}
if (empty($login)){
    $err[] = 'Введите ваш логин';
}
if (empty($password)){
    $err[] = 'Введите пароль';
}
if (empty($repeat_password)){
    $err[] = 'Повторите пароль';
}
if (!isset($err[0])){
valLogin($login);
if (isset($response)){
    @$err[] = $response;}
valPassword($password);
if (isset($response)){
    @$err[] = $response;}
valEmail($email);
if (isset($response)){
    @$err[] = $response;}
comPass($repeat_password, $password);
if (isset($response)){
    @$err[] = $response;}
}
// copyLogin($login);
// if (isset($response)){
//     @$err[] = $response;
// }


function valLogin($param){
    $param=trim($param);
    $param=stripslashes($param);
        if (!preg_match('/^[0-9a-zA-Zа-яА-Я]{6,12}$/', $param)) {
        global $response;
        $response = 'Недопустимый логин. Логин может состоять из 6-12 букв латинского алфавита';
        }
}

function valPassword($param){
    $param=trim($param);
        if(!preg_match("/^[A-Za-z\d\-_]{6,20}$/", $param)){
        global $response;
        $response = 'Недопустимы пароль. Пароль может состоять из 6-20 букв латинского алфавита';
        }
    

}
function valEmail($param){
    $param=trim($param);
    if (!filter_var($param, FILTER_VALIDATE_EMAIL)) {
    global $response;
    $response = 'Недопустимая почта. Почта должна быть формата "email@mail.com"';
    }
}
function comPass($param1, $param2){
    $param1=trim($param1);
    $param2=trim($param2);
    if ($param1 !== $param2){
        global $response;
        $response = 'Пароли не совпадают';
    }
}
// function copyLogin($param){
//     global $result;
//     $user_cop = R::findOne('users', 'login = ?', [$login]);
//     if (!empty($user_cop)) {
//         global $response;
//         $response = 'Данный пользователь уже существует';
//     }
// }
if (empty($err)){
    global $code;
    $code = 201;
}