<?php
include('../config.php');
if (!class_exists('Database')) {
    include('../../lib/database.class.php');
}
$user_email = mysql_real_escape_string($_REQUEST['user_email']) ; 
$database = new Database();

$sql="SELECT user_email FROM users WHERE user_email = :user_email";
$database->query($sql);
$database->bind(':user_email', $user_email);
$database->execute();
$count=$database->rowCount();
	
if($count==1) {
	echo 'false';
} else {
	echo 'true';
}
?>