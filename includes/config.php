<?php
//PDO
define("DB_HOST", "localhost");
define("DB_USER", "loopmx_sqlmaster");
define("DB_PASS", 'JB@u4Mu$)zL3');
define("DB_NAME", "loopmx_cmsdev");

//Connection
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Error connecting to mysql');
mysql_select_db(DB_NAME, $conn);
	
//email auth
define("SMTP_USER","cmsdev@loop.mx");
define("SMTP_PASSWD",'JB@u4Mu$)zL3');
define("SMTP_SERVER","mail.loop.mx");
define("SMTP_PORT",26);

//paypal
define("PAYPAL_EMAIL", "neozilus@gmail.com");
define("PAYPAL_NOTIFICATIONS_EMAIL", "neozilus@gmail.com");

//System Type
define("SYSTEM_TYPE", 2);
?>