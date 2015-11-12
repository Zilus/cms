<?php
include('../config.php');
if (!class_exists('Database')) {
    include('../../lib/database.class.php');
}
$current = md5($_REQUEST['current']);  
$id=intval($_REQUEST['user_id']); 
$database = new Database();

$sql="SELECT * FROM users WHERE user_id = :user_id AND user_passwd = :current";
$database->query($sql);
$database->bind(':user_id', $id);
$database->bind(':current', $current);
$database->execute();
$count=$database->rowCount();
	
if($count==1) {
	echo "true";
} else {
	echo 'false';
}
?>