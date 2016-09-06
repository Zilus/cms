<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');
	
$sql="INSERT INTO posts (posts_title, posts_content) VALUES (:posts_title, :posts_content)";
$database->query($sql);
$database->bindArray(array(
	':posts_title' => $_POST['posts_title'],
	':posts_content' => $_POST['posts_content']
));
if($database->execute()) {
	$redirect="blog.php?e=2";
} else {
	$redirect="blog.php?e=1";
}	

header('Location: '.$redirect);
exit();
?> 