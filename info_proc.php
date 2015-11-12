<?php
session_start();
include('includes/globals.php');
include('includes/kick.php');

$database = new Database();

$sql="UPDATE settings SET settings_value= :settings_value WHERE settings_desc= :settings_desc";
$database->query($sql);
$database->bind(':settings_value', $_POST['title']); 
$database->bind(':settings_desc', 'title');
$database->execute();

$sql="UPDATE settings SET settings_value= :settings_value WHERE settings_desc= :settings_desc";
$database->query($sql);
$database->bind(':settings_value', $_POST['desc']); 
$database->bind(':settings_desc', 'desc');
$database->execute();

$sql="UPDATE settings SET settings_value= :settings_value WHERE settings_desc= :settings_desc";
$database->query($sql);
$database->bind(':settings_value', $_POST['keywords']); 
$database->bind(':settings_desc', 'keywords');
$database->execute();

$sql="UPDATE settings SET settings_value= :settings_value WHERE settings_desc= :settings_desc";
$database->query($sql);
$database->bind(':settings_value', $_POST['cms_title']); 
$database->bind(':settings_desc', 'cms_title');
$database->execute();

$sql="UPDATE settings SET settings_value= :settings_value WHERE settings_desc= :settings_desc";
$database->query($sql);
$database->bind(':settings_value', $_POST['cms_subtitle']); 
$database->bind(':settings_desc', 'cms_subtitle');
$database->execute();

$redirect="info.php?e=2";
header('Location: '.$redirect);
exit();
?>