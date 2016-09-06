<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_SESSION['id']);

$hash=$_POST['hash'];
$sizelimit_x = $_POST['wi'];
$sizelimit_y = $_POST['he'];
$image = UPLOAD_DIR."/".$hash;
$path = AVATAR_DIR."/".$hash;

$sql="SELECT * FROM users WHERE user_id=:id";
$database->query($sql); 
$database->bind(':id', $id);
$row = $database->single();

if($row['user_avatar']!="") {
	@unlink(AVATAR_DIR."/".$row['user_avatar']);
}

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
	
$sql="UPDATE users SET user_avatar='$hash' WHERE user_id= :id";
$database->query($sql);
$database->bind(':id', $id); 
if($database->execute()) {
	unlink($image);
	//Avatar Fix
	$_SESSION['avatar'] = AVATAR_DIR."/".$hash;
	$redirect="profile.php?section=avatar";
} else {
	$redirect="profile.php?section=avatar";
}	

header('Location: '.$redirect);
exit();
?> 