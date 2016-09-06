<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=$_SESSION['id'];
$path = $_FILES['file']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

$seed = '0123456789abcdefghijklmnopqrstuvwxyz';
$hash = sha1(uniqid($seed . mt_rand(), true));
$hash = substr($hash, 0, 10).".".$ext;
$file="archivos/".$hash;

$file_title=$_POST['file_title'];
$day=date('d');
$mes=date('m');
$ano=date('Y');
$comments=utf8_encode($_POST['comentarios']);


if($_FILES['file']['size'] != 0) {
	if(move_uploaded_file($_FILES [ 'file' ][ 'tmp_name' ], $file)) {
		$database = new Database();
		$sql="INSERT INTO files (file_title, file_filename, file_day, file_month, file_year, file_comment, file_author) VALUES (:file_title, :file_filename, :file_day, :file_month, :file_year, :file_comment, :file_author)";
		$database->query($sql);
		$database->bindArray(array(
			':file_title' => $file_title,
			':file_filename' => $hash,
			':file_day' => $day,
			':file_month' => $mes,
			':file_year' => $ano,
			':file_comment' => $comments,
			':file_author' => $id
		));
		if($database->execute()) {
			$redirect="files.php?e=2";	
		} else {
			$redirect="files.php?e=1";	
		}		
		
		header("cache-Control: no-cache, must-revalidate");
		header("Location: $redirect" );
		exit();	
	}
	$redirect="files.php?e=1";	
	header("cache-Control: no-cache, must-revalidate");
	header("Location: $redirect" );
	exit();	
} else {
	$redirect="files.php?e=1";	
	header("cache-Control: no-cache, must-revalidate");
	header("Location: $redirect" );
	exit();
}

?> 
