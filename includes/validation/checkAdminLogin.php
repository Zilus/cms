<?php
include('../config.php');
if (!class_exists('Database')) {
    include('../../lib/database.class.php');
}
$user_login = $_REQUEST['user_login']; 
$database = new Database();

$sql="SELECT user_login FROM users WHERE user_login = :user_login";
$database->query($sql);
$database->bind(':user_login', $user_login);
$database->execute();
$count=$database->rowCount();
	
if($count==1) {
	echo 'false';
} else {
	echo 'true';
}
?>