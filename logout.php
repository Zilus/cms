<?php
include('includes/globals.php');
include('includes/functions.php');

session_start();
session_destroy();
if(isset($_COOKIE['oauth'])) {
	$cookie=explode(":",$_COOKIE['oauth']);
	
	$sql="DELETE FROM auth_tokens WHERE token=:token";
	$database->query($sql); 
	$database->bind(':token', $cookie[1]);
	$database->execute();	
	setcookie('oauth', '', time()-3600);
}
header("location: ".INIT_DIR); 
exit();
?>
