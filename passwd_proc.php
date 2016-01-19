<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_SESSION['id']);
$database = new Database();
$pass=$_POST['user_passwd'];
$new=password_hash($_POST['user_passwd'], PASSWORD_DEFAULT);

if($pass=="") {
	$redirect="profile.php?section=passwd&e=2";
	header('Location: '.$redirect);
	exit();
} else {
	$sql="UPDATE users SET user_passwd=:user_passwd WHERE user_id=:user_id";
	$database->query($sql); 
	$database->bind(':user_id', $id);
	$database->bind(':user_passwd', $new);
	$database->execute();
	
	$redirect="profile.php";			
	header('Location: '.$redirect); 
	exit();
}

?>