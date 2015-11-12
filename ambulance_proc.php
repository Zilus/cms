<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$database = new Database();

$sql="UPDATE settings SET settings_value= :settings_value WHERE settings_desc= :settings_desc";
$database->query($sql);
$database->bind(':settings_value', $_POST['settings_value']); 
$database->bind(':settings_desc', 'ambulance');
if($database->execute()) {
	$redirect="ambulance.php?e=2"; 
} else {
	$redirect="ambulance.php?e=1"; 
}
header('Location: '.$redirect);
exit();
?>