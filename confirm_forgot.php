<?php 
include("includes/header_login.php"); 
$database = new Database();
//setup some variables
$action = array();
$action['result'] = null;

//quick/simple validation
if(empty($_GET['email']) || empty($_GET['key'])){
	$action['result'] = 'error';
	$action['text'] = 'Error con las variables, regresa a tu email y da click de nuevo.';			
}
		
if($action['result'] != 'error'){

	//cleanup the variables
	$email = $_GET['email'];
	$key = $_GET['key'];
	
	//check if the key is in the database
	$sql = "SELECT * FROM `forgot` WHERE `email` = :email AND `key2` = :key LIMIT 1";
	$database->query($sql); 
	$database->bind(':email', $email);
	$database->bind(':key', $key);
	$database->execute();
	$check_key=$database->rowCount();
	
	if($check_key != 0){
				
		//get the confirm info
		$confirm_info = $database->single();
		
		//confirm the email and update the users database
		$seed = '0123456789abcdefghijklmnopqrstuvwxyz';
		$hash = sha1(uniqid($seed . mt_rand(), true));
		$hash = substr($hash, 0, 10);
		$pass=md5($hash);
				
		$sql="UPDATE `users` SET `user_passwd` = :user_passwd WHERE `user_id` = :user_id LIMIT 1";
		$database->query($sql);
		$database->bindArray(array(
		':user_id' => $confirm_info['userid'],
		':user_passwd' => $pass
		));
		$database->execute();		
		
		//delete the confirm row
		$sql="DELETE FROM `forgot` WHERE `id` = :f_id LIMIT 1";
		$database->query($sql);
		$database->bindArray(array(
		':f_id' => $confirm_info['id']
		));
		$database->execute();	
		
		$sql="OPTIMIZE TABLE  `forgot`";
		$database->query($sql);
		$database->execute();	
		
		if($update_users){
						
			$action['result'] = 'success';
			$action['text'] = 'Restablecimiento correcto!';
		
		}else{

			$action['result'] = 'error';
			$action['text'] = 'No se puede restablecer la contrase&ntilde;a debido a: '.mysql_error();;
		
		}
	
	}else{
	
		$action['result'] = 'error';
		$action['text'] = 'Tu clave de activaci&oacute;n es incorrecta!.';
	
	}

}

?>

<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<img src="images/logo-big.png" alt=""/>
	</a>
</div> 
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN FORGOT PASSWORD FORM -->
		<h3>Restablecer contrase&ntilde;a</h3>
		<p>
			 El estado de tu cuenta es:<strong> <?php echo $action['text']; ?></strong> 
             
             <?php
				//if($action['result'] == 'success') {
					echo '<br />
						<br />
						Tu contrase&ntilde;a temporal es: <strong>'.$hash.'</strong>
						<br /><br>
						Entra al sistema, edita tu perfil y cambia tu contrase&ntilde;a de inmediato!';
				//}
			?>
		</p>
		<div class="form-group">
			<div class="input-icon">
				
			</div>
		</div>
		<div class="form-actions">
			<a href="index.php" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Regresar </a>
            <br>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
	
</div>
<!-- END LOGIN -->

<?php include("includes/footer_login.php"); ?>