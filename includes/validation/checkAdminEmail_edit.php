<?php
include('../config.php');
if (!class_exists('Database')) {
    include('../../lib/database.class.php');
}
$user_email = $_REQUEST['user_email']; 
$id=intval($_REQUEST['user_id']); 
$database = new Database();

$sql="SELECT * FROM users WHERE user_email = :user_email";
$database->query($sql);
$database->bind(':user_email', $user_email);
$database->execute();
$count=$database->rowCount();
	
if($count==1) {
	$row = $database->single(); 
	if($row['user_id']==$id) {
		echo 'true';
	} else {
		echo "false";
	}
} else {
	echo 'true';
}
?>