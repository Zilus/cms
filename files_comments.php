<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_POST['id']);
$seed = '0123456789abcdefghijklmnopqrstuvwxyz';
$hash = sha1(uniqid($seed . mt_rand(), true));
$comments=utf8_encode($_POST['comments']);

$database = new Database();
$sql="INSERT INTO files_comments (comments_file, comments_author, comments_comment, comments_date) VALUES (:comments_file, :comments_author, :comments_comment, NOW())";
$database->query($sql);
$database->bindArray(array(
	':comments_file' => $id,
	':comments_author' => $_SESSION['id'],
	':comments_comment' => $comments
));
if($database->execute()) {
	$redirect='files_detail.php?mes='.$hash.'&id='.$row['file_month'].'&f='.$id.'&day='.$hash.'&file='.$row['file_filename'].'&e=2&y='.$row['file_year'].'&year='.date('Y').$hash.date('m');
} else {
	$redirect='files_detail.php?mes='.$hash.'&id='.$row['file_month'].'&f='.$id.'&day='.$hash.'&file='.$row['file_filename'].'&e=1&y='.$row['file_year'].'&year='.date('Y').$hash.date('m');
}
header('Location: '.$redirect);
exit();
?> 
