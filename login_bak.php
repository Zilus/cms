<?php
session_start();
include('includes/globals.php');
include('includes/functions.php');

$username = mysql_real_escape_string(trim($_POST['login']));
$passwd = md5(mysql_real_escape_string($_POST['passwd']));
$ipaddress = $_SERVER["REMOTE_ADDR"];
$captcha_test=intval($_POST['captcha_challenge']);
$sql="INSERT INTO LoginAttempts VALUES (NULL, '$ipaddress', 1, '$username', NOW())";
mysql_query($sql) or die(mysql_error());
//Check IP
$ipcheck=checkIP($ipaddress, $username);
if($ipcheck==true) {
	$query = "SELECT * FROM users WHERE user_login='".$username."' AND user_passwd='".$passwd."'";
	$user = mysql_query($query, $conn) or die(mysql_error());
	$row_user = mysql_fetch_assoc($user);

	if ($row_user['user_login'] == $username && $row_user['user_passwd'] == $passwd) {
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
		
		//Clear IP log
		$sql="DELETE FROM LoginAttempts WHERE ip='$ipaddress'";
		mysql_query($sql) or die(mysql_error());
		mysql_query("OPTIMIZE TABLE  `LoginAttempts`");
		//redirect
		header("Location: dashboard.php");
		exit();		
	} else { 
		$_SESSION['logged'] = 0;
		header("Location: index.php");
		exit();
	}
} else {
	//Viene con captcha 
	if($captcha_test==1) {
		include_once 'securimage/securimage.php'; 
		$securimage = new Securimage();
		if ($securimage->check($_POST['captcha_code']) == false) {
			//captcha mal
			$_SESSION['logged'] = 0;
			$_SESSION['captcha'] = 1;
			header("Location: login.php");
			exit();
		} else {
			//captcha bien
			$query = "SELECT * FROM users WHERE user_login='".$username."' AND user_passwd='".$passwd."'";
			$user = mysql_query($query, $conn) or die(mysql_error());
			$row_user = mysql_fetch_assoc($user);
			//Acceso
			if ($row_user['user_login'] == $username && $row_user['user_passwd'] == $passwd) {
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
				$_SESSION['captcha'] = 0;
				
				//Clear IP log
				$sql="DELETE FROM LoginAttempts WHERE ip='$ipaddress'";
				mysql_query($sql) or die(mysql_error());
				mysql_query("OPTIMIZE TABLE  `LoginAttempts`");
				//redirect
				header("Location: dashboard.php");
				exit();
			//Mal acceso			
			} else { 
				$_SESSION['logged'] = 0;
				$_SESSION['captcha'] = 1;
				header("Location: login.php");
				exit();
			}
		}
	} else {
		$_SESSION['logged'] = 0;
		$_SESSION['captcha'] = 1;
		header("Location: login.php");
		exit();
	}
}
?>