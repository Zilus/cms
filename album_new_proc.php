<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$database = new Database();

$seed = '0123456789abcdefghijklmnopqrstuvwxyz';
$hash = sha1(uniqid($seed . mt_rand(), true));
$hash = substr($hash, 0, 10);

$dir = GALERIA_DIR."/".$hash;		
if(!file_exists($dir)) {
	mkdir($dir,0777); 
}
	
$sql='INSERT INTO galeria (album_name, album_dir, album_status) VALUES (:album_name, :album_dir, :album_status)';			
$database->query($sql);
$database->bindArray(array(
	':album_name' => $_POST['album_name'],
	':album_dir' => $hash,
	':album_status' => 1
));
if($database->execute()) {
	$redirect="galeria.php?e=2";
} else {
	$redirect="galeria.php?e=1";
}
header('Location: '.$redirect);
exit();
?>