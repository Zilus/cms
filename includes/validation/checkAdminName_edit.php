<?php
include('../config.php');
if (!class_exists('Database')) {
    include('../../lib/database.class.php');
}
$user_fullname = mysql_real_escape_string($_REQUEST['user_fullname']);
$id=intval($_REQUEST['user_id']); 
$database = new Database();

$sql="SELECT * FROM users WHERE user_fullname = :user_fullname";
$database->query($sql);
$database->bind(':user_fullname', $user_fullname);
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