<?php
session_start();
include('includes/globals.php');
include('includes/functions.php');
$database = new Database();
if(isset($_POST['avanzar'])){
	$email = mysql_real_escape_string(trim($_POST['email'], ' '));
	
	if($email=="") {
		//redirect
		$redirect="forgot.php?e=1";
		header("Location: $redirect");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE user_email=:email";
		$database->query($sql); 
		$database->bind(':email', $email);
		$database->execute();
		$count=$database->rowCount();
		if($count>0) {
			$row = $database->single();
			$userid=$row['user_id'];
			
			$key = $email . date('mY');
			$key = md5($key);
			$sql="INSERT INTO forgot (userid, key2, email) VALUES (:userid, :key2, :email)";
			$database->query($sql);
			$database->bind(':userid', $userid); 
			$database->bind(':key2', $key);
			$database->bind(':email', $email); 
			
			if($database->execute()) {
				require_once('lib/swift_required.php');
				$user=$row['user_fullname'];
				//html
				$msg = format_email_forgot($user, INIT_DIR, $email, $key, 'php');
				$transport = Swift_SmtpTransport::newInstance(SMTP_SERVER, SMTP_PORT)
				  ->setUsername(SMTP_USER)
				  ->setPassword(SMTP_PASSWD)
				  ;
				$mailer = Swift_Mailer::newInstance($transport);
				$message = Swift_Message::newInstance("Restablecer password: ".$user)
				  ->setFrom(array(SMTP_USER => 'Webmaster'))
				  ->setTo(array($email => $email))
				  ->setBody($msg, 'text/html')
				  ;
				
				$result = $mailer->send($message);
				///END email	
				
				$redirect="forgot_sent.php";
				header('Location: '.$redirect);
				exit();	
			} else {
				$redirect="forgot_sent.php";
				header('Location: '.$redirect);
				exit();
			}
		} else {
			$redirect="forgot_sent.php";
			header('Location: '.$redirect);
			exit();
		}
	}
}
?>