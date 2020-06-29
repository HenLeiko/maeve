<?php
session_start();
require 'db.php';

uploadfilm($_FILES['mini'], $_FILES['side'], $_POST['film_title'], $_POST['film_desc']);

function uploadfilm($mini, $side, $title, $desc) {
    $film = R::dispense('films');
    $film->title = $title;
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
