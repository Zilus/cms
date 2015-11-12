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
	<form action="forgot_proc.php" method="post">
		<h3>&iquest;Olvidaste tu contraseña?</h3>
		<p>
			 Introduce tu cuenta de correo.
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" id="back-btn" class="btn" formaction="index.php">
			<i class="m-icon-swapleft"></i> Regresar </button>
			<button name="avanzar" type="submit" class="btn green pull-right">
			Enviar <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
	
</div>
<!-- END LOGIN -->

<?php include("includes/footer_login.php"); ?>