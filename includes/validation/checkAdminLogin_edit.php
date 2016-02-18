<?php
include('../config.php');
if (!class_exists('Database')) {
    include('../../lib/database.class.php');
}
$user_login = $_REQUEST['user_login']; 
$id=intval($_REQUEST['user_id']); 
$database = new Database();

$sql="SELECT * FROM users WHERE user_login = :user_login";
$database->query($sql);
$database->bind(':user_login', $user_login);
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