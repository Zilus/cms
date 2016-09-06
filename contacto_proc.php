<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$posts_extra=utf8_encode($_POST['posts_extra']);

$database = new Database();
$sql="UPDATE posts SET posts_extra=:posts_extra  WHERE posts_section=:posts_section";
$database->query($sql);
$database->bind(':posts_section', 'contacto');
$database->bind(':posts_extra', $posts_extra);
if($database->execute()) {
	$redirect="contacto.php?e=2"; 
} else {
	$redirect="contacto.php?e=1"; 
}
header('Location: '.$redirect);
exit();
?>