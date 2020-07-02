<?php
session_start();
require 'db.php';
require 'debug.php';
date_default_timezone_set('UTC');
$date = date('l jS \of F Y');

if (!empty($_FILES['mini']) && !empty($_FILES['side']) && !empty($_POST['film_title']) && !empty($_POST['film_desc'])){
    uploadfilm($_FILES['mini'], $_FILES['side'], $_POST['film_title'], $_POST['film_desc-mini'], $_POST['film_desc']);
    var_dump($_POST);
} 

if (isset($_POST['subscribe']) && isset($_SESSION['login'])){
    sub($_POST['subscribe'], $date);
}

if (!empty($_POST['sex']) || !empty($_POST['age']) || !empty($_POST['film']) || !empty($_FILES['avatar'])) {
    about_user($_POST['sex'], $_POST['age'], $_POST['film'], $_FILES['avatar']);
}


function subscribe($type, $date) {
    $user = R::findOne('users', 'login = ?', [$_SESSION['login']]);
    $user->subscribe = $type;
    $user->sub_date = $date;
    R::store($user);
}

function uploadfilm($mini, $side, $title, $mini_desc, $desc) {
    $film = R::dispense('films');
    $film->title = $title;
    $film->mini_desc = $mini_desc;
    $film->desc = $desc;
    $film->side = uploadside($side);
    $film->mini = uploadmini($mini);
    R::store($film);
}
function uploadside($side) {

    $name_side = $side["name"];
        
    $extension = pathinfo($name_side, PATHINFO_EXTENSION);
    $new_name_side = uniqid().'.'.$extension;
        
    move_uploaded_file($side["tmp_name"],"resource/film_banners/side/" . $new_name_side);
    return $new_name_side;
}

function uploadmini($mini) {

    $name_mini = $mini["name"];
        
    $extension = pathinfo($name_mini, PATHINFO_EXTENSION);
    $new_name_mini = uniqid().'.'.$extension;
        
    move_uploaded_file($mini["tmp_name"],"resource/film_banners/mini/" . $new_name_mini);
    return $new_name_mini;
}

function about_user($user_id, $sex, $age = null, $like = null, $avatar = null){
    if (empty($age)) {
        $age = 'не указан';
    }
    if (empty($like)) {
        $like = 'не указан';
    }
    if (empty($avatar['name'])) {
        $avatar = 'defult.png';
    } else {
        $avatar = save_avatar($avatar);
    }

    $user = R::findOne('profiles', "user_id = ?", [$user_id]);
    $user->avatar = $avatar;
    $user->sex = $sex;
    $user->age = $age;
    $user->like_film = $like;
    R::store($user);
    $_SESSION['avatar'] = $avatar;
}

function save_avatar($avatar) {
    $name_mini = $avatar["name"];
    $extension = pathinfo($name_mini, PATHINFO_EXTENSION);
    $new_name_avatar = uniqid().'.'.$extension;
    echo '</pre>';
    var_dump($new_name_avatar);
    echo '</pre>';
    move_uploaded_file($avatar["tmp_name"],"resource/avatars/" . $new_name_avatar);
    return $new_name_avatar;
}

function sub($sub, $date) {
    $login = $_SESSION['login'];
    $user = R::findOne('users', 'login = ?', [$login]);
    $user->subscribe = $sub;
    $user->sub_date = $date;
    R::store($user);
    return 200;
}