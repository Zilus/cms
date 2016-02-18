<?php
include('../config.php');
if (!class_exists('Database')) {
    include('../../lib/database.class.php');
}
$album_name = $_REQUEST['album_name'];
$id=intval($_REQUEST['album_id']); 
$database = new Database();

$sql="SELECT * FROM galeria WHERE album_name = :album_name";
$database->query($sql);
$database->bind(':album_name', $album_name);
$database->execute();
$count=$database->rowCount();
	
if($count==1) {
	$row = $database->single(); 
	if($row['album_id']==$id) {
		echo 'true';
	} else {
		echo "false";
	}
} else {
	echo 'true';
}
?>