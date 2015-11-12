<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_SESSION['id']);

$sql="UPDATE users SET user_fullname=:user_fullname, user_login=:user_login, user_email=:user_email WHERE user_id= :user_id";
$database->query($sql);
$database->bind(':user_id', $id); 
$database->bind(':user_fullname', $_POST['user_fullname']);
$database->bind(':user_login', $_POST['user_login']); 
$database->bind(':user_email', $_POST['user_email']); 
$database->execute();

$redirect="profile.php";
header('Location: '.$redirect);
exit();
?>