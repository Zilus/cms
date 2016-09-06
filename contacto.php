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
							<i class="fa fa-envelope"></i>
							<a>Sistema</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="contacto.php">Contacto</a>
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
								<i class="fa fa-cogs"></i> Contacto
							</div>
						</div>
						<div class="portlet-body form">
                        <?php				
							if(intval($_GET['e']==1)) {
								echo crear_alerta("error", "<strong>Error:</strong> al modificar la información");
							} else if(intval($_GET['e']==2)) {
								echo crear_alerta("success", "<strong>Exito:</strong> al modificar la información");
							}
											
							$database = new Database();
							$sql="SELECT * FROM posts WHERE posts_section=:section";
							$database->query($sql); 
							$database->bind(':section', 'contacto');
							$row = $database->single();
							
							$forma = array(
								"action"		=>	"contacto_proc.php",
								"id"			=>	"contacto_form",
								"method"		=>	"post", 
								"enctype"		=>	0, 
								"edit"			=>	0, 
								"edit_values"	=> array(),   
								"submit"		=>	"Guardar"
							);
								
							$fields = array (
								array(
									"type"			=>	"email",
									"label"			=>	"Email", 
									"icon"			=>	"fa-envelope", 
									"required"		=>	true, 
									"name"			=>	"posts_extra",
									"value"			=>	utf8_decode($row['posts_extra']),
									"placeholder"	=>	"Email de contacto",
									"disabled"		=>	false,
									"data_values"	=> array(),
									"editor"		=> false
								)
							);
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