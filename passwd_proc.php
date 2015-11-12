<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_SESSION['id']);
$database = new Database();
$sql="SELECT * FROM users WHERE user_id=:user_id";
$database->query($sql); 
$database->bind(':user_id', $id);
$row = $database->single();

$current=md5($_POST['current']);
$new=md5($_POST['user_passwd']);

if($current==$row['user_passwd']) {
	if($current==$new) {
		$redirect="profile.php?section=passwd";
		header('Location: '.$redirect);
		exit();
	} else {
		if($_POST['user_passwd']!=$_POST['user_passwd2']) {
			$redirect="profile.php??section=passwd";
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
	}
} else {
	$redirect="profile.php?section=passwd";
	header('Location: '.$redirect);
	exit();
}
?>