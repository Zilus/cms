<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_POST['id']);
$sql="SELECT * FROM galeria WHERE album_id= :album_id";
$database->query($sql); 
$database->bind(':album_id', $id);
$row_a = $database->single();

$hash=$_POST['hash'];
$sizelimit_x = $_POST['wi'];
$sizelimit_y = $_POST['he'];
$image = UPLOAD_DIR."/".$hash;
$photo = GALERIA_DIR."/".$row_a['album_dir']."/".$hash;
$path = GALERIA_DIR."/".$row_a['album_dir'].'/thumb-'.$hash;


$src = imagecreatefromjpeg($image);

if($_POST['w'] > $_POST['h']) {
	$scalex = ( $sizelimit_x / $_POST['w'] );
    $scaley = $scalex;
} else {
	$scalex = ( $sizelimit_y / $_POST['h'] );
	$scaley = $scalex;
}
$new_width = $_POST['w'] * $scalex;
$new_height = $_POST['h'] * $scaley;
$dest = imagecreatetruecolor($new_width, $new_height);
imagecopyresized($dest, $src, 0, 0, $_POST['x'], $_POST['y'], $new_width, $new_height,$_POST['w'], $_POST['h']);
$compress = 90;
imagejpeg($dest,$path,$compress);
imagedestroy($dest);
imagedestroy($src);
	
$sql="INSERT INTO fotos (foto_album, foto_filename) VALUES (:foto_album, :foto_filename)";
$database->query($sql);
$database->bindArray(array(
	':foto_album' => $id,
	':foto_filename' => $hash
));
$database->execute();	
rename($image, $photo);

$redirect="album_fotos.php?e=2&id=".$id;
header('Location: '.$redirect);
exit();
?> 