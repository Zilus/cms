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
							<i class="fa fa-calendar"></i>
							<a>Edición</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="consorcio.php">Listado</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
            
			<!-- content -->
           <div class="row">
				<div class="col-md-12 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i> Sección: Consorcio
							</div>
						</div>
						<div class="portlet-body form">
                        <?php
							$e=intval($_GET['e']);
							if($e==1) {
								echo crear_alerta("error", "<strong>Error!</strong> Algo fallo, por favor intenta de nuevo.");
							} else if($e==2) {
								echo crear_alerta("success", "<strong>Exito!</strong> Los cambios se han guardado con exito.");
							}
							
							$database = new Database();
							
							$sql="SELECT * FROM posts WHERE posts_section=:posts_section";
                            $database->query($sql); 
                            $database->bind(':posts_section', 'posts_section');
                            $row = $database->single(); 
							
							$forma = array(
								"action"		=>	"posts_edit_proc.php", 
								"id"			=>	"",
								"method"		=>	"post", 
								"enctype"		=>	0, 
								"edit"			=>	1, 
								"edit_values"	=> array(
														array("name"=>"posts_id","value"=>$row['posts_id'])
													),  
								"submit"		=>	"Guardar cambios"
							);
								
							$fields = array (
								array(
									"type"			=>	"text",
									"label"			=>	"Titulo", 
									"icon"			=>	"fa-cogs", 
									"required"		=>	true, 
									"name"			=>	"posts_title",
									"value"			=>	$row['posts_title'],
									"placeholder"	=>	"Placeholder",
									"disabled"		=>	false,
									"data_values"	=> array(),
									"editor"		=> false
								),
								array(
									"type"			=>	"textarea",
									"label"			=>	"Contenido", 
									"icon"			=>	"fa-cogs", 
									"required"		=>	true, 
									"name"			=>	"posts_content",
									"value"			=>	$row['posts_content'],
									"placeholder"	=>	"",
									"disabled"		=>	false,
									"data_values"	=> array(),
									"editor"		=> true
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