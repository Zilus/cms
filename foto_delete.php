<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_GET['id']);
$album=intval($_GET['album']);

$sql="SELECT * FROM fotos WHERE foto_id= :id";
$database->query($sql); 
$database->bind(':id', $id);
$row = $database->single();

$sql="SELECT * FROM galeria WHERE album_id= :album";
$database->query($sql); 
$database->bind(':album', $album);
$row_a = $database->single(); 

$foto=GALERIA_DIR.'/'.$row_a['album_dir'].'/'.$row['foto_filename'];
@unlink($foto);

$thumb=GALERIA_DIR.'/'.$row_a['album_dir'].'/thumb-'.$row['foto_filename'];
@unlink($thumb);

$sql="DELETE FROM fotos WHERE foto_id = :id";
$database->query($sql);
$database->bind(':id', $id); 
$database->execute();

$redirect="album_fotos.php?id=".$album;
header('Location: '.$redirect);
exit();
?>