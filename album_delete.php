<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_GET['id']);
$database = new Database();

$sql="SELECT * FROM galeria WHERE album_id=:id";
$database->query($sql); 
$database->bind(':id', $id);
$row_a = $database->single();

$sql="SELECT * FROM fotos WHERE foto_album=:foto_album";
$database->query($sql);
$database->bind(':foto_album', $id);
$rows = $database->resultset();
foreach($rows as &$row) {
	@unlink(GALERIA_DIR."/".$row_a['album_dir'].'/'.$row['foto_filename']);
}

$sql="DELETE FROM fotos WHERE foto_album= :foto_album";
$database->query($sql);
$database->bind(':foto_album', $id);
$database->execute();

$sql="DELETE FROM galeria WHERE album_id= :album_id";
$database->query($sql);
$database->bind(':album_id', $id);
if($database->execute()) {
	@rmdir(GALERIA_DIR."/".$row_a['album_dir']);
	$redirect="galeria.php?e=2";
} else {
	$redirect="galeria.php?e=1";
}

header('Location: '.$redirect);
exit();
?>