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
							<i class="fa fa-cogs"></i>
							<a>Sistema</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
                        	<i class="fa fa-users"></i>
							<a href="admins.php">Usuarios</a>
                            <i class="fa fa-angle-right"></i>
						</li>
                        <li>
							<a href="#">Edici&oacute;n de Usuario</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
            
			<!-- content -->
           <div class="row">
				<div class="col-md-6 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i> Edición de Usuario
							</div>
						</div>
						<div class="portlet-body form">
                        	<?php
								$database = new Database();
								$id=intval($_GET['id']);
								$sql="SELECT * FROM users WHERE user_id=:id";
								$database->query($sql); 
								$database->bind(':id', $id);
								$row = $database->single();
								
								$forma = array(
									"action"		=>	"admin_edit_proc.php", 
									"id"			=>	"admin_edit_form",
									"method"		=>	"post", 
									"enctype"		=>	0, 
									"edit"			=>	1, 
									"edit_values"	=> array(
															array("name"=>"user_id","value"=>$row['user_id']),
															array("name"=>"void","value"=>0),
														),  
									"submit"		=>	"Guardar cambios"
								);
									
								$fields = array (
									array(
										"type"			=>	"text",
										"label"			=>	"Nombre del usuario", 
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
									),
									array(
										"type"			=>	"password",
										"label"			=>	"Contraseña", 
										"icon"			=>	"fa-lock", 
										"required"		=>	true, 
										"name"			=>	"user_passwd",
										"value"			=>	"",
										"placeholder"	=>	"Contraseña",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"password",
										"label"			=>	"Confirma contraseña", 
										"icon"			=>	"fa-lock", 
										"required"		=>	true, 
										"name"			=>	"user_passwd2",
										"value"			=>	"",
										"placeholder"	=>	"Confirma contraseña",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									), 
									array(
										"type"			=>	"dropdown",
										"label"			=>	"Nivel de acceso", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	true, 
										"name"			=>	"user_level",
										"value"			=>	$row['user_level'],
										"placeholder"	=>	"",
										"disabled"		=>	false,
										"data_values"	=> array(
																array("value"=>2,"option"=>"Usuario", "checked"=>0),
																array("value"=>1,"option"=>"Administrador", "checked"=>0),
															),
										"editor"		=> false
									)
								);
								
								/*$clave=multidimensional_search($fields, array('name'=>"user_level"));
								$subclave=multidimensional_search($fields[$clave]["data_values"], array('value'=>$row['user_level']));
								$fields[$clave]["data_values"][$subclave]["checked"]=1;		*/
								
								echo create_form($forma, $fields);
							?>	
						</div>
					</div>
            <!-- end content -->           
            
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<?php include("includes/footer.php"); ?>