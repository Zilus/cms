<?php
/*$passwd = $_GET['p'];
if($passwd!="") {
	$hash = password_hash($passwd, PASSWORD_DEFAULT);
	echo $hash."<br>";
	 
	$iguales = password_verify($passwd, '$2y$10$SDesC5t8Gpg8TMQKgmSwheBRLyNV6q.IneEv3AF7I1IGk989TaCAG');
	 
	if ($iguales) {
		echo 'Puedes pasar a la zona privada';
	} else {
		echo 'La contraseña indicada no es correcta';
	} 
} else { 
	echo "Passwd vacio";
}


$salt = '9tucuSMu0J';
$username="juan";

$identifier = hash('sha256', $username.$salt);
$token = md5(uniqid(rand(), TRUE));
$timeout = time() + 60 * 60 * 24 * 7;	

setcookie('auth', "$identifier:$token", $timeout);

$token=$identifier.":".$token;

echo $token;*/

$timeout = time() + 60 * 60 * 24 * 365;	
$date = date("Y-m-d H:i:s", $timeout);

$rebote=strtotime($date);

echo $timeout. "despues de rebote: ".$rebote;		
?> 