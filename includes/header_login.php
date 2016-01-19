<?php 
session_start(); 
if(isset($_COOKIE['oauth'])) {
	include('globals.php');
	include('functions.php');
	
	$cookie=explode(":",$_COOKIE['oauth']);
	
	$sql="SELECT * FROM auth_tokens WHERE token=:token";
	$database->query($sql); 
	$database->bind(':token', $cookie[1]);
	$row_cookie = $database->single();
	
	if($database->rowCount()>=1) {
		if($row_cookie['identifier']==$cookie[0]) {
			if($row_cookie['token']==$cookie[1]) {
				//al ok
				$sql="SELECT * FROM users WHERE user_id=:user_id";
				$database->query($sql); 
				$database->bind(':user_id', $row_cookie['userid']);
				$row_user = $database->single();
				
				$_SESSION['id'] = $row_user['user_id'];
				$_SESSION['login'] = $row_user['user_login'];
				$_SESSION['fullname'] = $row_user['user_fullname'];
				//Avatar Fix
				if($row_user['user_avatar']=="") {
					$_SESSION['avatar']=AVATAR_DIR."/avatar_default.jpg";
				} else {
					$_SESSION['avatar'] = AVATAR_DIR."/".$row_user['user_avatar'];
				}
				//end avatar
				$_SESSION['level'] = $row_user['user_level'];
				$_SESSION['logged'] = 1;
				header("Location: dashboard.php");
				exit();
			}
		}
	}
	
} else {
	if($_SESSION['logged'] == "1"){
		header("Location: dashboard.php");
		exit();
	}
	include('globals.php');
	include('functions.php');
	if($row_ambulance['settings_value']==1) {
		if($_SESSION['level']!=1) {
			if(pagActual()!="off.php") { 
				header("Location: off.php");
				exit();
			}
		}
	}
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo TITLE; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="<?php echo DESCRIPTION; ?>" name="description"/>
<meta content="<?php echo AUTHOR; ?>" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/select2/select2-metronic.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>