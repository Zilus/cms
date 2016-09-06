<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');
	
$id=intval($_GET['id']);	
$sql="DELETE FROM posts WHERE posts_id=:posts_id";
$database->query($sql);
$database->bindArray(array(
	':posts_id' => $id
));
if($database->execute()) {
	$redirect="blog.php?e=3";
} else {
	$redirect="blog.php?e=1";
}	

header('Location: '.$redirect);
exit();
?> 