<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_POST['user_id']);
$database = new Database();

if($_POST['user_passwd'] ==""){
	$sql="UPDATE users SET user_fullname=:user_fullname, user_login=:user_login, user_email=:user_email, user_level=:user_level WHERE user_id=:user_id";
	$database->query($sql);
	$database->bindArray(array(
		':user_id' => $id,
		':user_fullname' => $_POST['user_fullname'],
		':user_login' => $_POST['user_login'],
		':user_email' => $_POST['user_email'],
		':user_level' => $_POST['user_level']
	));
	if($database->execute()) {
		$redirect="admins.php?e=2";
	} else {
		$redirect="admins.php?e=1";
	}
	header('Location: '.$redirect);
	exit();
} else {
	$passwd=password_hash($_POST['user_passwd'], PASSWORD_DEFAULT);
	$sql="UPDATE users SET user_fullname=:user_fullname, user_login=:user_login, user_email=:user_email, user_passwd=:user_passwd, user_level=:user_level WHERE user_id=:user_id";
	$database->query($sql);
	$database->bindArray(array(
		':user_id' => $id,
		':user_fullname' => $_POST['user_fullname'],
		':user_login' => $_POST['user_login'],
		':user_email' => $_POST['user_email'],
		':user_passwd' => $passwd,
		':user_level' => $_POST['user_level']
	)); 
	if($database->execute()) {
		$redirect="admins.php?e=2";
	} else {
		$redirect="admins.php?e=1";
	}	
	header('Location: '.$redirect);
	exit();
}	
?>