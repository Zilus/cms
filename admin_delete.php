<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_GET['id']);
$database = new Database();

$sql="SELECT * FROM users WHERE user_id=:id";
$database->query($sql); 
$database->bind(':id', $id);
$row = $database->single();

if($row['user_avatar']!="") {
	$photo = "images/avatar/".$row['user_avatar'];
	unlink($photo);
}

$sql="DELETE FROM users WHERE user_id=:user_id";
$database->query($sql);
$database->bind(':user_id', $id);

if($database->execute()) {
	$redirect="admins.php?e=2";
} else {
	$redirect="admins.php?e=1";
}
header('Location: '.$redirect);
exit();
?> 