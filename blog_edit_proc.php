<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');
	
$id=intval($_POST['posts_id']);	
$sql="UPDATE posts SET posts_title=:posts_title, posts_content=:posts_content, posts_edit=NOW() WHERE posts_id=:posts_id";
$database->query($sql);
$database->bindArray(array(
	':posts_title' => $_POST['posts_title'],
	':posts_content' => $_POST['posts_content'],
	':posts_id' => $id
));
if($database->execute()) {
	$redirect="blog.php?e=4";
} else {
	$redirect="blog.php?e=1";
}		

$redirect="blog.php?e=4";
header('Location: '.$redirect);
exit();
?> 