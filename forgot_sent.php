<?php 
include("includes/header_login.php"); 
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
	<form action="index.php" method="post">
		<h3>Solicitud de contrase&ntilde;a</h3>
		<p>
			 Espera el correo para restablecer tu contrase&ntilde;a!
		</p>
		<div class="form-group">
			<div class="input-icon">
				
			</div>
		</div>
		<div class="form-actions">
			<button name="avanzar" type="submit" class="btn green pull-right">
			Ir al Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
            <br>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
	
</div>
<!-- END LOGIN -->

<?php include("includes/footer_login.php"); ?>