<?php
session_start();
require('../connect/connect.php');

$phone = trim(htmlspecialchars($_POST['phone']));
$password = trim(htmlspecialchars($_POST['password']));

if(empty($phone) || empty($password)){
    die('Заполните все поля');
}

$phoneCheck = $database->query("SELECT * FROM `users` WHERE `phone` = '$phone'")->fetch(2);
if(!$phoneCheck){
    die("Пользователь не найден");
}


if(!password_verify($password, $phoneCheck['password'])){
    die("Пароль не верный");
}

$_SESSION['uid'] = $phoneCheck['id'];
echo"yes";