<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_GET['id']);
	
$database = new Database();		
$sql="UPDATE galeria SET album_status=:album_status WHERE album_id=:album_id";
$database->query($sql);
$database->bindArray(array(
	':album_id' => $id,
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