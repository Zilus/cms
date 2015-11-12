<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_GET['id']);
	
$database = new Database();		
$sql="UPDATE galeria SET album_status= :album_status WHERE album_id= :album_id";
$database->query($sql);
$database->bindArray(array(
	':album_id' => $id,
	':album_status' => 1
));
$database->execute();
	
$redirect="galeria.php";	
header('Location: '.$redirect);
exit();		
?>