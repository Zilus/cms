<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_POST['album_id']);
	
$database = new Database();		
$sql="UPDATE galeria SET album_name=:album_name WHERE album_id=:album_id";
$database->query($sql);
$database->bindArray(array(
	':album_id' => $id,
	':album_name' => $_POST['album_name']
));

if($database->execute()) {
	$redirect="galeria.php?e=2";
} else {
	$redirect="galeria.php?e=1";
}	
header('Location: '.$redirect);
exit();		
?>