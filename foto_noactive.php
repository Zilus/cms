<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_GET['id']);
$album=intval($_GET['album']);

$sql="UPDATE fotos SET foto_status=:foto_status WHERE foto_id=:id";
$database->query($sql);
$database->bind(':id', $id); 
$database->bind(':foto_status', 0);  
if($database->execute()) {
	$redirect="album_fotos.php?e=2&id=".$album; 
} else {
	$redirect="album_fotos.php?e=1&id=".$album; 
}	

header('Location: '.$redirect);
exit();
?>