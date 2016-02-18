<?php
include('../config.php');
if (!class_exists('Database')) {
    include('../../lib/database.class.php');
}
$album_name = $_REQUEST['album_name']; 
$database = new Database();

$sql="SELECT album_name FROM galeria WHERE album_name = :album_name";
$database->query($sql);
$database->bind(':album_name', $album_name);
$database->execute();
$count=$database->rowCount();
	
if($count==1) {
	echo 'false';
} else {
	echo 'true';
}
?>