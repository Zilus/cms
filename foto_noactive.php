<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_GET['id']);
$album=intval($_GET['album']);

$sql="UPDATE fotos SET foto_status=0 WHERE foto_id= :id";
$database->query($sql);
$database->bind(':id', $id);  
$database->execute();

$redirect="album_fotos.php?id=".$album; 
header('Location: '.$redirect);
exit();
?>