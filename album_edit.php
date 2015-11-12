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
							<i class="fa fa-puzzle-piece"></i>
							<a href="galeria.php">Albums</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Edición de Album</a>
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
								<i class="fa fa-cogs"></i> Edita el album
							</div>
						</div>
						<div class="portlet-body form">
                        <?php
							$database = new Database();
							$id=intval($_GET['id']);
							$sql="SELECT * FROM galeria WHERE album_id= :id";
							$database->query($sql); 
							$database->bind(':id', $id);
							$row = $database->single();
							
							$forma = array(
								"action"		=>	"album_edit_proc.php", 
								"id"			=>	"album_edit_form",
								"method"		=>	"post", 
								"enctype"		=>	0, 
								"edit"			=>	1, 
								"edit_values"	=> array(
														array("name"=>"album_id","value"=>$row['album_id'])
													),  
								"submit"		=>	"Guardar cambios"
							);
								
							$fields = array (
								array(
									"type"			=>	"text",
									"label"			=>	"Título del Album", 
									"icon"			=>	"fa-folder", 
									"required"		=>	true, 
									"name"			=>	"album_name",
									"value"			=>	$row['album_name'],
									"placeholder"	=>	"Nombre del album",
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