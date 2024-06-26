<?php
// $database = new PDO("mysql:host=localhost;charset=utf8;dbname=razum10_platform", 'razum10', 'Pzjhw6bJ');

try{
    $host = 'localhost';
    $dbname = 'razumNeiro';
    $user = 'root';
    $pass = '';
    $database = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", $user, $pass);
    return $database;
}
catch(PDOException $err){
    die("Ошибка подключения: " . $err);
}
?>
