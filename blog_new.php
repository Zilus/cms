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
							<i class="fa fa-edit"></i>
							<a>Blog</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="blog.php">Entradas</a>
                            <i class="fa fa-angle-right"></i>
						</li>
                        <li>
							<a href="blog_new.php">Nueva entrada</a>
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
								<i class="fa fa-cogs"></i> Nueva entrada
							</div>
						</div>
						<div class="portlet-body form">
                        <?php			
							echo ROOT_DIR.'images/uploads/';
							$forma = array(
								"action"		=>	"blog_new_proc.php", 
								"id"			=>	"",
								"method"		=>	"post", 
								"enctype"		=>	0, 
								"edit"			=>	0, 
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
									"placeholder"	=>	"Título de la entrada",
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