<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');
$database = new Database();
		
$passwd = md5($_POST['user_passwd']);	
$sql='INSERT INTO users (user_fullname, user_login, user_email, user_passwd, user_level) VALUES (:user_fullname, :user_login, :user_email, :user_passwd, :user_level)';			
$database->query($sql);
$database->bindArray(array(
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
?>