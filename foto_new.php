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
                    <?php
						$id=intval($_GET['id']);
						$sql="SELECT * FROM galeria WHERE album_id=:album_id";
						$database->query($sql); 
						$database->bind(':album_id', $id);
						$row_a = $database->single();
					?>
						<li>
							<i class="fa fa-picture-o"></i>
							<a href="galeria.php">Galería</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="album_fotos.php?id=<?php echo $id; ?>"><?php echo $row_a['album_name']; ?></a>
                            <i class="fa fa-angle-right"></i>
						</li>
                        <li>
							<a>Nuevo</a>
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
								<i class="fa fa-cogs"></i> Nueva imágen
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
									"action"		=>	"foto_new_upload.php", 
									"id"			=>	"foto_upload_form",
									"method"		=>	"post", 
									"enctype"		=>	1, 
									"edit"			=>	1, 
									"edit_values"	=> array(
															array("name"=>"album_id","value"=>$row_a['album_id'])
														),  
									"submit"		=>	"Subir"
								);
									
								$fields = array (
									array(
										"type"			=>	"file",
										"label"			=>	"Imágen", 
										"icon"			=>	"fa-camera", 
										"required"		=>	true, 
										"name"			=>	"foto",
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