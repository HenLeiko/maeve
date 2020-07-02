<?php
require 'db.php';
require 'debug.php';
if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $film = R::findOne('films', 'title = ?', [$title]);
    $views_january = $film->view_january;
    $views_february = $film->view_february;
    $views_march = $film->view_march;
    $views_april = $film->view_april;
    $views_may = $film->view_may;
    $views_june = $film->view_june;
    $views_july = $film->view_july;
    $data = [
        'January' => $views_january ,
        'February' => $views_february,
        'March' => $views_march,
        'April' => $views_april,
        'May' => $views_may,
        'June' => $views_june,
        'July' => $views_july,
    ];
    echo json_encode($data);
}