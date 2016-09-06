<?php
require_once("includes/config.php"); 
include('includes/globals.php');

define('EMAIL_ADD', PAYPAL_NOTIFICATIONS_EMAIL); // define any notification email
define('PAYPAL_EMAIL_ADD', PAYPAL_EMAIL); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
require_once("lib/paypal_class.php");
$p 				= new paypal_class();
$p->admin_mail 	= EMAIL_ADD; // set notification email
$action 		= $_REQUEST["action"]; 

switch($action){
	case "process": // case process insert the form data in DB and process to the paypal
		$sql="INSERT INTO `pagos` (`invoice`, `costo`, `fname`, `lname`, `email`, `tel`, status, `fecha`) VALUES (`:invoice`, `:costo`, `:fname`, `:lname`, `:email`, `:tel`, :status, `:fecha`, NOW())";
		$database->query($sql);
		$database->bindArray(array(
			':invoice'	=> $_POST["invoice"],
			':costo' 	=> $_POST["product_amount"],
			':fname' 	=> $_POST["payer_fname"],
			':lname' 	=> $_POST["payer_lname"],
			':email' 	=> $_POST["payer_email"],
			':tel' 		=> $_POST["tel"],
			':status' 	=> "pendiente"
		));
		$database->execute();
		$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$p->add_field('business', PAYPAL_EMAIL_ADD); // Call the facilitator eaccount
		$p->add_field('cmd', $_POST["cmd"]); // cmd should be _cart for cart checkout
		$p->add_field('upload', '1');
		$p->add_field('return', $this_script.'?action=success'); // return URL after the transaction got over
		$p->add_field('cancel_return', $this_script.'?action=cancel'); // cancel URL if the trasaction was cancelled during half of the transaction
		$p->add_field('notify_url', $this_script.'?action=ipn'); // Notify URL which received IPN (Instant Payment Notification)
		$p->add_field('currency_code', $_POST["currency_code"]);
		$p->add_field('invoice', $_POST["invoice"]);
		$p->add_field('item_name_1', $_POST["product_name"]);
		$p->add_field('quantity_1', 1);
		$p->add_field('amount_1', $_POST["product_amount"]);
		$p->add_field('first_name', $_POST["payer_fname"]);
		$p->add_field('last_name', $_POST["payer_lname"]);
		$p->add_field('email', $_POST["payer_email"]);
		
		//custom vars
		$p->add_field('rodada', $_POST["rodada"]);
		$p->add_field('tel', $_POST["tel"]);
		$p->submit_paypal_post(); // POST it to paypal
		//$p->dump_fields(); // Show the posted values for a reference, comment this line before app goes live
	break;
	
	case "success": // success case to show the user payment got success
		$escupe='<div style="font-family:Arial, Helvetica, sans-serif; padding:50px;">
			<p style="color:#30534b; font-size:18px">Tu pago se realizo correctamente</p>
			</p>
				
			<p>
				Nos pondremos en contacto lo antes posbile<br>
				</p>
		</div>';
	break;
	
	case "cancel": // case cancel to show user the transaction was cancelled
		$escupe='<div style="font-family:Arial, Helvetica, sans-serif; padding:50px;">
			<p style="color:#30534b; font-size:18px">Estimad@ '.$name.' '.$lastname.'</p>
			</p>
				
			<p>
				Tu pago NO se realizo. Contactanos para cualquier aclaración.
		</div>';
	break;
	
	case "ipn": // IPN case to receive payment information. this case will not displayed in browser. This is server to server communication. PayPal will send the transactions each and every details to this case in secured POST menthod by server to server. 
		$trasaction_id  = $_POST["txn_id"];
		$payment_status = strtolower($_POST["payment_status"]);
		$invoice		= $_POST["invoice"];
		$log_array		= print_r($_POST, TRUE);
		$log_query		= "SELECT * FROM `paypal_log` WHERE `txn_id`=:txn_id";
		$database->query($log_query);
		$database->bind(':txn_id', $trasaction_id);
		$log_check 		= $database->single();
		if($database->rowCount() <= 0){
			$sql="INSERT INTO `paypal_log` (`txn_id`, `log`, `posted_date`) VALUES (`:txn_id`, `:log`, NOW())";
			$database->query($sql);
			$database->bind(':txn_id', $trasaction_id);
			$database->bind(':log', $log_array);
			$database->execute();
		}else{
			$sql="UPDATE `paypal_log` SET `log`=:log WHERE `txn_id`=:txn_id";
			$database->query($sql);
			$database->bind(':txn_id', $trasaction_id);
			$database->bind(':log', $log_array);
			$database->execute();
		} // Save and update the logs array
		$paypal_log_fetch 	= mysql_fetch_array(mysql_query($log_query));
		$paypal_log_id		= $paypal_log_fetch["id"];
		if ($p->validate_ipn()){ // validate the IPN, do the others stuffs here as per your app logic
			$sql="UPDATE `pagos` SET `trasaction_id`=:trasaction_id, `log_id` =:log_id,  `status`=:status WHERE `invoice`=:invoice";
			$database->query($sql);
			$database->bind(':trasaction_id', $trasaction_id);
			$database->bind(':log_id', $paypal_log_id);
			$database->bind(':status', "Pagado");
			$database->bind(':invoice', $invoice);
			$database->execute();
			//$subject = 'Instant Payment Notification - Recieved Payment';
			//$p->send_report($subject); // Send the notification about the transaction
			
			require_once('lib/swift_required.php');
			$sql="SELECT * FROM posts WHERE posts_section=:posts_section";
			$database->query($sql);
			$database->bind(':posts_section', "contacto");
			@$row_m=$database->single();
			
			$to=$row_m['posts_extra'];
			$name=$row['fname'];
			$lastname=$row['lname'];
			$email=$row['email'];
			$tel=$row['tel'];
			$metodo="Paypal";
					
			//mail stuff
			$subject="Solicitud de rodada";  
			$msg = '<div style="font-family:Arial, Helvetica, sans-serif; padding:50px;">
				<p style="color:#30534b; font-size:18px">
					'.$subject.'
				</p>
					
				<p>
					Nombre: <strong>'.$name.'</strong><br>
					Apellido paterno: <strong>'.$lastname.'</strong><br>
					Email: <strong>'.$email.'</strong><br>
					Tel&eacute;fono: <strong>'.$tel.'</strong><br>
					Rodada: <strong>'.$rodada.'</strong><br>
					Costo: <strong>$ '.$costo.' MXN</strong><br>
					Fecha: <strong>'.$fecha.'</strong><br>
					Nivel: <strong>'.$nivel.'</strong><br>
					Tipo: <strong>'.$tipo.'</strong><br>
					Forma de pago: <strong>'.$metodo.'</strong><br>
					Status: <strong>Pagado</strong><br>
					Comprobante No.: <strong>'.$row['invoice'].'</strong><br>
			</div>';
			
			$to=$email;
			$transport = Swift_SmtpTransport::newInstance(SMTP_SERVER, SMTP_PORT)
			  ->setUsername(SMTP_USER)
			  ->setPassword(SMTP_PASSWD)
			  ;
			$mailer = Swift_Mailer::newInstance($transport);
			$message = Swift_Message::newInstance($subject)
			  ->setFrom(array(SMTP_USER => 'Webmaster'))
			  ->setTo(array($to => $to))
			  ->setBody($msg, 'text/html')
				;
		  
			$result = $mailer->send($message);			
		}else{
			$subject = 'Instant Payment Notification - Payment Fail';
			$p->send_report($subject); // failed notification
		}
	break;
}
?>
<?php include("common/header.php"); ?>
		
        Enviado (HTML Stuff)
        
<?php include("common/footer.php"); ?>