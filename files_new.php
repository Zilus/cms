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
							<i class="fa fa-filee"></i>
							<a href="files.php">Archivos</a>
							<i class="fa fa-angle-right"></i>
						</li>
                        <li>
							<a>Nuevo archivo</a>
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
								<i class="fa fa-cogs"></i> Nuevo archivo
							</div>
						</div>
						<div class="portlet-body form">
                        	<?php		
								echo '<div class="alert alert-warning">
									<button class="close" data-close="alert"></button>
									Solo se aceptan archivos PDF, DOC, DOCX, XLS, XLSX y JPG
								</div>';
								
								$forma = array(
									"action"		=>	"files_proc.php", 
									"id"			=>	"file_form",
									"method"		=>	"post", 
									"enctype"		=>	1, 
									"edit"			=>	1, 
									"edit_values"	=> array(
															array("name"=>"user_id","value"=>$_SESSION['id'])
														),  
									"submit"		=>	"Subir"
								);
									
								$fields = array (
									array(
										"type"			=>	"text",
										"label"			=>	"Titulo", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	true, 
										"name"			=>	"file_title",
										"value"			=>	"",
										"placeholder"	=>	"Nombre del archivo",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"text",
										"label"			=>	"Fecha", 
										"icon"			=>	"fa-calendar", 
										"required"		=>	true, 
										"name"			=>	"fecha",
										"value"			=>	date('d')." - ".date_mes(date('m'))." - ".date('Y'),
										"placeholder"	=>	"",
										"disabled"		=>	true,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"textarea",
										"label"			=>	"Comentarios", 
										"icon"			=>	"fa-calendar", 
										"required"		=>	true, 
										"name"			=>	"comentarios",
										"value"			=>	"",
										"placeholder"	=>	"comentarios sobre el archivo",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"file",
										"label"			=>	"Archivo", 
										"icon"			=>	"fa-file", 
										"required"		=>	true, 
										"name"			=>	"file",
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
            <!-- end content -->           
            
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<?php include("includes/footer.php"); ?>