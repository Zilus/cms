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
$database->execute();	

$redirect="blog.php?e=3";
header('Location: '.$redirect);
exit();
?> 