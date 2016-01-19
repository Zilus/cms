<?php
include('../config.php');
if (!class_exists('Database')) {
    include('../../lib/database.class.php');
}

$id=intval($_REQUEST['user_id']); 
$database = new Database();

$sql="SELECT * FROM users WHERE user_id = :user_id";
$database->query($sql);
$database->bind(':user_id', $id);
$row_user = $database->single();
$check_passwd = password_verify($_REQUEST['current'], $row_user['user_passwd']);
	
if($check_passwd) {
	echo "true";
} else {
	echo 'false';
}
?>