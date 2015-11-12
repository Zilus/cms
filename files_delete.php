<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$d=intval($_GET['d']);

$database = new Database();
$sql="SELECT * FROM files WHERE file_id= :id";
$database->query($sql); 
$database->bind(':id', $d);
$row = $database->single();
$file = "archivos/".$row['file_filename'];
@unlink($file);


$sql="=".$d;
$query=mysql_query($sql);

$sql="DELETE FROM files WHERE file_id=:id";
$database->query($sql);
$database->bind(':id', $d);
$database->execute(); 

$redirect="files.php";	
header("cache-Control: no-cache, must-revalidate");
header("Location: $redirect" );
exit();	
?> 
