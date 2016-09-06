<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_GET['id']);
$album=intval($_GET['album']);

$sql="UPDATE fotos SET foto_status=1 WHERE foto_id=:id";
$database->query($sql);
$database->bind(':id', $id);  

if($database->execute()) {
	rename($image, $photo);
	$redirect="album_fotos.php?e=2&id=".$id;
} else {
	$redirect="album_fotos.php?e=1&id=".$id;
}

header('Location: '.$redirect);
exit();
?>