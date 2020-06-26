<?php
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$response = [];

$user = R::dispense('users');
$user->email = $data['email'];
$user->login = $data['login'];
$user->password = $data['password'];
R::store($user);