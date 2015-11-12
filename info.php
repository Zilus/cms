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
							<i class="fa fa-bookmark"></i>
							<a>Sistema</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="info.php">Informaci&oacute;n del sistema</a>
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
								<i class="fa fa-cogs"></i> Informaci&oacute;n del sistema
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
								$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
								$database->bind(':settings_desc', 'title');
								$row_t = $database->single();
								
								$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
								$database->bind(':settings_desc', 'desc');
								$row_d = $database->single();
								
								$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
								$database->bind(':settings_desc', 'keywords');
								$row_k = $database->single();
								
								$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
								$database->bind(':settings_desc', 'cms_title');
								$row_cmst = $database->single();
								
								$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
								$database->bind(':settings_desc', 'cms_subtitle');
								$row_cmsst = $database->single();
								
								$forma = array(
									"action"		=>	"info_proc.php", 
									"id"			=>	"info_proc",
									"method"		=>	"post", 
									"enctype"		=>	0, 
									"edit"			=>	0, 
									"edit_values"	=> array(),  
									"submit"		=>	"Guardar"
								);
									
								$fields = array (
									array(
										"type"			=>	"text",
										"label"			=>	"Título del Sitio", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	true, 
										"name"			=>	"title",
										"value"			=>	$row_t['settings_value'],
										"placeholder"	=>	"Título del Sitio",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"text",
										"label"			=>	"Descripción del Sitio", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	true, 
										"name"			=>	"desc",
										"value"			=>	$row_d['settings_value'],
										"placeholder"	=>	"Descripción del Sitio",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"text",
										"label"			=>	"Keywords", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	true, 
										"name"			=>	"keywords",
										"value"			=>	$row_k['settings_value'],
										"placeholder"	=>	"keywords",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"text",
										"label"			=>	"Título del CMS", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	true, 
										"name"			=>	"cms_title",
										"value"			=>	$row_cmst['settings_value'],
										"placeholder"	=>	"Título del CMS",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"text",
										"label"			=>	"Subtitulo del CMS", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	true, 
										"name"			=>	"cms_subtitle",
										"value"			=>	$row_cmsst['settings_value'],
										"placeholder"	=>	"Subtitulo del CMS",
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