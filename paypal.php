<?php
require_once("includes/config.php"); 

define('EMAIL_ADD', PAYPAL_NOTIFICATIONS_EMAIL); // define any notification email
define('PAYPAL_EMAIL_ADD', PAYPAL_EMAIL); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
require_once("lib/paypal_class.php");
$p 				= new paypal_class(); // paypal class
$p->admin_mail 	= EMAIL_ADD; // set notification email
$action 		= $_REQUEST["action"]; 

switch($action){
	case "process": // case process insert the form data in DB and process to the paypal
		mysql_query("INSERT INTO `pagos` (`invoice`, `rodada`,  `costo`, `fname`, `lname`, `email`, `tel`, status, `fecha`) VALUES ('".$_POST["invoice"]."','".$_POST["rodada"]."', '".$_POST["product_amount"]."', '".$_POST["payer_fname"]."', '".$_POST["payer_lname"]."', '".$_POST["payer_email"]."', '".$_POST["tel"]."', 'pendiente', NOW())") or die(mysql_error());
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
		$log_query		= "SELECT * FROM `paypal_log` WHERE `txn_id` = '$trasaction_id'";
		$log_check 		= mysql_query($log_query);
		if(mysql_num_rows($log_check) <= 0){
			mysql_query("INSERT INTO `paypal_log` (`txn_id`, `log`, `posted_date`) VALUES ('$trasaction_id', '$log_array', NOW())");
		}else{
			mysql_query("UPDATE `paypal_log` SET `log` = '$log_array' WHERE `txn_id` = '$trasaction_id'");
		} // Save and update the logs array
		$paypal_log_fetch 	= mysql_fetch_array(mysql_query($log_query));
		$paypal_log_id		= $paypal_log_fetch["id"];
		if ($p->validate_ipn()){ // validate the IPN, do the others stuffs here as per your app logic
			mysql_query("UPDATE `pagos` SET `trasaction_id` = '$trasaction_id ', `log_id` = '$paypal_log_id', `status` = 'Pagado' WHERE `invoice` = '$invoice'") or die(mysql_error());
			//$subject = 'Instant Payment Notification - Recieved Payment';
			//$p->send_report($subject); // Send the notification about the transaction
			
			$sql="SELECT * FROM pagos INNER JOIN rodadas ON rodadas_id=rodada INNER JOIN levels ON levels_id=rodadas_level WHERE `invoice` = '$invoice'";
			$query=mysql_query($sql);
			$row=mysql_fetch_assoc($query);
			
			require_once('lib/swift_required.php');
			$sql="SELECT * FROM posts WHERE posts_section='contacto'";
			$query_m=mysql_query($sql);
			@$row_m=mysql_fetch_assoc($query_m);
			
			$to=mysql_real_escape_string($row_m['posts_extra']);
			$to="maudeavila@bym.mx";
			$name=$row['fname'];
			$lastname=$row['lname'];
			$email=$row['email'];
			$tel=$row['tel'];
			$metodo="Paypal";
			
			$rodada=$row['rodadas_name'];	
			$costo=$row['rodadas_costo'];	
			$fecha=$row['rodadas_day']." / ".$row['rodadas_month']." / ".$row['rodadas_year'];		
			$nivel=$row['levels_name'];
				
			
			if($row['rodadas_type']==1) {
				$tipo="Rodada";
			} else {
				$tipo="Viaje";
			}				
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
			$transport = Swift_SmtpTransport::newInstance($smtp_server,$smtp_port)
			  ->setUsername($smtp_user)
			  ->setPassword($smtp_passwd)
			  ;
			$mailer = Swift_Mailer::newInstance($transport);
			$message = Swift_Message::newInstance($subject)
			  ->setFrom(array($smtp_user => 'Webmaster Bici y Montaña'))
			  ->setTo(array($to => $to))
			  ->setBody($msg, 'text/html')
				;
		  
			$result = $mailer->send($message);
			  
			$msg2 = '<div style="font-family:Arial, Helvetica, sans-serif; padding:50px;">
				<p style="color:#30534b; font-size:18px">Estimad@ '.$name.' '.$lastname.'</p>
					Tu pago se realizo correctamente.<br>
					Si tienes alguna duda por favor envianos un correo. REcuerda llevar tu No. de comprobante.
				</p>
					
				<p>
					Rodada: <strong>'.$rodada.'</strong><br>
					Costo: <strong>$ '.$costo.' MXN</strong><br>
					Fecha: <strong>'.$fecha.'</strong><br>
					Nivel: <strong>'.$nivel.'</strong><br>
					Tipo: <strong>'.$tipo.'</strong><br>
					Forma de pago: <strong>'.$metodo.'</strong><br>
					Estatus: <strong>Pagado</strong><br>
					Comprobante No.: <strong>'.$row['invoice'].'</strong><br>
			</div>';
			
			$transport = Swift_SmtpTransport::newInstance($smtp_server,$smtp_port)
			  ->setUsername($smtp_user)
			  ->setPassword($smtp_passwd)
			  ;
			$mailer = Swift_Mailer::newInstance($transport);
			$message2 = Swift_Message::newInstance($subject)
			  ->setFrom(array($smtp_user => 'Webmaster Bici y Montaña'))
			  ->setTo(array($email => $email))
			  ->setBody($msg2, 'text/html')
				;
			$result = $mailer->send($message2);
			
		}else{
			$subject = 'Instant Payment Notification - Payment Fail';
			$p->send_report($subject); // failed notification
		}
	break;
}
?>
<?php include("common/header.php"); ?>
		
        <?php include("common/sub.php"); ?>
                
        <div class="spacer"></div> 
        
        <div id="slider_small">
        <?php
			$sql="SELECT * FROM slider ORDER BY RAND() LIMIT 1";
			$query=mysql_query($sql)                           
; 
			while($row_i=mysql_fetch_assoc($query)) {	
				echo '<img src="images/slider/'.$row_i['slider_img'].'">';	
			}
		?> 
        </div> 
        
        <div class="spacer"></div>
        
        <div id="contenido1">
        	<div id="solicita1"> 
            </div>
        	<div id="solicita_content">
            	<?php
					echo $escupe;			
				?>
            	
            	
            </div>
            <div id="solicita2">
            </div>
        </div>
        
        <div class="spacer"></div>
        
<?php include("common/footer.php"); ?>