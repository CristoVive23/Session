<?php

session_start();
ob_start();

require_once "connect.php";

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

//echo "$email - $password"; 

$stmt = $connect->prepare("SELECT * FROM users WHERE email = :email AND password = :password");

$stmt->bindValue(":email", $email);
$stmt->bindValue(":password", $password);

$stmt->execute();

if ($stmt->rowCount() == 1) {
    $infUser = $stmt->fetch();
    //var_dump($infUser);
    $_SESSION['loginOK'] = true;
    $_SESSION['id'] = $infUser['id'];
    $_SESSION['name'] = $infUser['name'];
    $_SESSION['email'] = $infUser['email'];
    $_SESSION['password'] = $infUser['password'];
    $_SESSION['level_access'] = $infUser['level_access'];

    header('Location: dashboard.php');
}else{
    header('Location: index.php');
}