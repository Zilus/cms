<?php include("includes/header.php"); ?>

<body class="page-header-fixed">

<?php include("includes/head.php"); ?>

<!-- BEGIN CONTAINER -->
<div class="page-container">

	<?php include("includes/sidebar.php"); ?>
				
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?php echo CMS_TITULO; ?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a>Perfil</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
            
			<!-- BEGIN PAGE CONTENT-->
			<div class="row profile">
				<div class="col-md-12">
					<!--BEGIN TABS-->
					<div class="tabbable tabbable-custom tabbable-full-width">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_1_3" data-toggle="tab">
								Cuenta </a>
							</li>
						</ul>
						<div class="tab-content">
                        <?php
                        	$sql="SELECT * FROM users WHERE user_id=:user_id";
							$database->query($sql); 
							$database->bind(':user_id', $_SESSION['id']);
							$row = $database->single();
						?>
							
							<!--tab_1_2-->
							<div class="tab-pane active" id="tab_1_3">
								<div class="row profile-account">
									<div class="col-md-3">
                                    
                                    	
                                    
										<ul class="ver-inline-menu tabbable margin-bottom-10">
                                        	<li>
												<img src="<?php echo $_SESSION['avatar']; ?>" class="img-responsive" alt=""/>
											</li>
                                        
											<li <?php if($_GET['section']=="") { echo 'class="active"'; } ?>>
												<a data-toggle="tab" href="#tab_1-1">
												<i class="fa fa-cog"></i> información </a>
												<span class="after">
												</span>
											</li>
                                            <li <?php if($_GET['section']=="avatar") { echo 'class="active"'; } ?>>
												<a data-toggle="tab" href="#tab_2-2">
												<i class="fa fa-picture-o"></i> Cambia tu Avatar</a>
											</li>
											<li <?php if($_GET['section']=="passwd") { echo 'class="active"'; } ?>>
												<a data-toggle="tab" href="#tab_3-3">
												<i class="fa fa-lock"></i> Tu password </a>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="tab-content">
											<div id="tab_1-1" class="tab-pane <?php if($_GET['section']=="") { echo 'active'; } ?>">
                                            	<?php 
													$forma = array(
														"action"		=>	"profile_proc.php", 
														"id"			=>	"profile_form",
														"method"		=>	"post", 
														"enctype"		=>	0, 
														"edit"			=>	1, 
														"edit_values"	=> array(
																				array("name"=>"user_id","value"=>$_SESSION['id'])
																			),  
														"color"			=>	"",
														"submit"		=>	"Guardar"
													);
														
													$fields = array (
														array(
															"type"			=>	"text",
															"label"			=>	"Nombre completo", 
															"icon"			=>	"fa-user", 
															"required"		=>	true, 
															"name"			=>	"user_fullname",
															"value"			=>	$row['user_fullname'],
															"placeholder"	=>	"Nombre del usuario",
															"disabled"		=>	false,
															"data_values"	=> array(),
															"editor"		=> false
														),
														array(
															"type"			=>	"text",
															"label"			=>	"Login", 
															"icon"			=>	"", 
															"required"		=>	true, 
															"name"			=>	"user_login",
															"value"			=>	$row['user_login'],
															"placeholder"	=>	"Acceso",
															"disabled"		=>	false,
															"data_values"	=> array(),
															"editor"		=> false
														),
														array(
															"type"			=>	"email",
															"label"			=>	"Email", 
															"icon"			=>	"fa-envelope", 
															"required"		=>	true, 
															"name"			=>	"user_email",
															"value"			=>	$row['user_email'],
															"placeholder"	=>	"Email",
															"disabled"		=>	false,
															"data_values"	=> array(),
															"editor"		=> false
														)
													);
													echo create_form($forma, $fields);
												?>
											</div>
                                            
                                            <div id="tab_2-2" class="tab-pane <?php if($_GET['section']=="avatar") { echo 'active'; } ?>">
												<p>
													 Tu foto deberá ser de por lo menos 600px de ancho. Solo en formato JPG
												</p>
                                                <?php 
													$forma = array(
														"action"		=>	"avatar_upload.php", 
														"id"			=>	"profile_avatar_form",
														"method"		=>	"post", 
														"enctype"		=>	1, 
														"edit"			=>	0,   
														"color"			=>	"",
														"submit"		=>	"Subir" 
													);
														
													$fields = array (
														array(
															"type"			=>	"file",
															"label"			=>	"", 
															"icon"			=>	"fa-picture-o", 
															"required"		=>	true, 
															"name"			=>	"avatar",
															"value"			=>	"",
															"placeholder"	=>	"",
															"disabled"		=>	false,
															"data_values"	=> array(),
															"editor"		=> false
														)
													);
													echo create_form($forma, $fields);
												?>
											</div>
                                            
											<div id="tab_3-3" class="tab-pane <?php if($_GET['section']=="passwd") { echo 'active'; } ?>">
                                            	 <?php 
													$forma = array(
														"action"		=>	"passwd_proc.php", 
														"id"			=>	"profile_passwd_form",
														"method"		=>	"post", 
														"enctype"		=>	0, 
														"edit"			=>	1, 
														"edit_values"	=> array(
																				array("name"=>"user_id","value"=>$_SESSION['id'])
																			),  
														"color"			=>	"",
														"submit"		=>	"Guardar" 
													);
														
													$fields = array (
														array(
															"type"			=>	"password",
															"label"			=>	"Password actual", 
															"icon"			=>	"fa-lock", 
															"required"		=>	true, 
															"name"			=>	"current",
															"value"			=>	"",
															"placeholder"	=>	"",
															"disabled"		=>	false,
															"data_values"	=> array(),
															"editor"		=> false
														),
														array(
															"type"			=>	"password",
															"label"			=>	"Nuevo Password", 
															"icon"			=>	"fa-lock", 
															"required"		=>	true, 
															"name"			=>	"user_passwd",
															"value"			=>	"",
															"placeholder"	=>	"",
															"disabled"		=>	false,
															"data_values"	=> array(),
															"editor"		=> false
														),
														array(
															"type"			=>	"password",
															"label"			=>	"Confirma tu password", 
															"icon"			=>	"fa-lock", 
															"required"		=>	true, 
															"name"			=>	"user_passwd2",
															"value"			=>	"",
															"placeholder"	=>	"",
															"disabled"		=>	false,
															"data_values"	=> array(),
															"editor"		=> false
														)
													);
													echo create_form($forma, $fields);
												?>
											</div>
										</div>
									</div>
									<!--end col-md-9-->
								</div>
							</div>
							<!--end tab-pane-->
                            
							
						</div>
					</div>
					<!--END TABS-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<?php include("includes/footer.php"); ?>