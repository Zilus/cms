<?php
session_start();
include('includes/globals.php');
include('includes/functions.php');

$database = new Database();

$username = trim($_POST['username']);
$passwd = trim($_POST['password']);
$ipaddress = $_SERVER["REMOTE_ADDR"];
$captcha_test=intval($_POST['captcha_challenge']);


$sql="INSERT INTO LoginAttempts (ip,attempts,login,Last) VALUES ( :ipaddress, :attempts, :username, NOW())";
$database->query($sql);
$database->bind(':ipaddress', $ipaddress);
$database->bind(':attempts', 1);
$database->bind(':username', $username);
$database->execute();

//Check IP
$ipcheck=checkIP($ipaddress, $username);
if($ipcheck==true) {
	$sql="SELECT * FROM users WHERE user_login=:user_login";
	$database->query($sql); 
	$database->bind(':user_login', $username);
	$row_user = $database->single();
	$check_passwd = password_verify($passwd, $row_user['user_passwd']);

	if ($check_passwd) {
		//Cookie
		if ($_POST["remember"]=="1") {
			$identifier = hash('sha256', $row_user['user_id'].KEY);
			$token = md5(uniqid(rand(), TRUE));
			$timeout = time() + 60 * 60 * 24 * 365;	
			$date = date("Y-m-d H:i:s", $timeout);
		  	setcookie("oauth", "$identifier:$token", $timeout);
			
			$sql="INSERT INTO auth_tokens (identifier,token,userid,expires) VALUES (:identifier,:token, :userid, :expires)";
			$database->query($sql);
			$database->bind(':identifier', $identifier);
			$database->bind(':token', $token);
			$database->bind(':userid', $row_user['user_id']);
			$database->bind(':expires', $date);
			$database->execute();
		}
		
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
		$sql="DELETE FROM LoginAttempts WHERE ip=:ipaddress";
		$database->query($sql); 
		$database->bind(':ipaddress', $ipaddress);
		$database->execute();
		$sql="OPTIMIZE TABLE  `LoginAttempts`";
		$database->query($sql); 
		$database->execute();
		
		header("Location: dashboard.php");
		exit();		
	} else { 
		$_SESSION['logged'] = 0;
		header("Location: index.php?e=1");
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
			$sql="SELECT * FROM users WHERE user_login=:user_login";
			$database->query($sql); 
			$database->bind(':user_login', $username);
			$row_user = $database->single();
			$check_passwd = password_verify($passwd, $row_user['user_passwd']);
			//Acceso
			if ($check_passwd) {
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
				$sql="DELETE FROM LoginAttempts WHERE ip=:ipaddress";
				$database->query($sql); 
				$database->bind(':ipaddress', $ipaddress);
				$database->execute();
				$sql="OPTIMIZE TABLE  `LoginAttempts`";
				$database->query($sql); 
				$database->execute();
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