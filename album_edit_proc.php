<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_POST['album_id']);
	
$database = new Database();		
$sql="UPDATE galeria SET album_name= :album_name WHERE album_id= :album_id";
$database->query($sql);
$database->bindArray(array(
	':album_id' => $id,
	':album_name' => $_POST['album_name']
));
$database->execute();
	
$redirect="galeria.php";	
header('Location: '.$redirect);
exit();		
?>