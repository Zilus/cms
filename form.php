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
								$forma = array(
									"action"	=>	"action.php", 
									"method"	=>	"post", 
									"enctype"	=>	0, 
									"edit"	=>	0, 
									"edit_name"	=>	"",
									"id"	=>	"",  
									"submit"	=>	"Enviar"
								);
								
								//Dropdown from DB
								$sql="SELECT * FROM settings";
								$database->query($sql); 
								$rows = $database->resultset();
								$dw=0;
								foreach($rows as &$row_dw) {
									$operador[$dw]=array("value"=>$row_dw['settings_desc'],"option"=>$row_dw['settings_desc'], "checked"=>0);
									$dw++;
								}	
								
								$fields = array (
									array(
										"type"			=>	"text",
										"label"			=>	"Texto",  
										"icon"			=>	"fa-envelope", 
										"required"		=>	true, 
										"validate"		=>	false,
										"name"			=>	"text1",
										"value"			=>	"Texto",
										"placeholder"	=>	"",
										"disabled"		=>	false,
										"data_values"	=> 	array(),
										"editor"		=> 	false
									),
									array(
										"type"			=>	"email",
										"label"			=>	"Email", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	false, 
										"validate"		=>	false,
										"name"			=>	"email1",
										"value"			=>	"",
										"placeholder"	=>	"tu email",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"password",
										"label"			=>	"Password", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	false, 
										"name"			=>	"passwd1",
										"value"			=>	"",
										"placeholder"	=>	"tu pass",
										"disabled"		=>	false,
										"data_values"	=> 	array(),
										"editor"		=> 	false
									),
									array(
										"type"			=>	"datepicker",
										"label"			=>	"Fecha", 
										"icon"			=>	"fa-calendar", 
										"required"		=>	true, 
										"name"			=>	"date",
										"value"			=>	"",
										"placeholder"	=>	"Fecha",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									),
									array(
										"type"			=>	"textarea",
										"label"			=>	"Textarea", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	false, 
										"name"			=>	"textarea",
										"value"			=>	"",
										"placeholder"	=>	"Mete info",
										"disabled"		=>	false,
										"data_values"	=> 	array(),
										"editor"		=> 	false
									),
									array(
										"type"			=>	"textarea",
										"label"			=>	"Textarea editor", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	false, 
										"name"			=>	"textarea",
										"value"			=>	"Mete más info",
										"placeholder"	=>	"",
										"disabled"		=>	false,
										"data_values"	=> 	array(),
										"editor"		=> 	true
									),
									array(
										"type"			=>	"dropdown",
										"label"			=>	"Drop", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	false, 
										"name"			=>	"drop1",
										"value"			=>	"",
										"placeholder"	=>	"",
										"disabled"		=>	false,
										"data_values"	=> 	array(
																array("value"=>1,"option"=>"Val 1", "checked"=>0),
																array("value"=>2,"option"=>"Val 2", "checked"=>0),
															),
										"editor"		=> false					
									),
									array(
										"type"			=>	"dropdown",
										"label"			=>	"Drop From DB", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	false, 
										"name"			=>	"drop1",
										"value"			=>	"",
										"placeholder"	=>	"",
										"disabled"		=>	false,
										"data_values"	=> 	array(
																array("value"=>1,"option"=>"Val 1", "checked"=>0),
																array("value"=>2,"option"=>"Val 2", "checked"=>0),
															),
										"editor"		=> false					
									),
									array(
										"type"			=>	"checkbox",
										"label"			=>	"Check", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	false, 
										"name"			=>	"check1",
										"value"			=>	"",
										"placeholder"	=>	"",
										"disabled"		=>	false,
										"data_values"	=> 	array(
																array("value"=>3,"option"=>"Val 3", "checked"=>0),
																array("value"=>4,"option"=>"Val 4", "checked"=>1),
															),
										"editor"		=> false					
									),
									array(
										"type"			=>	"radio",
										"label"			=>	"Radios", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	false, 
										"name"			=>	"radio1",
										"value"			=>	"",
										"placeholder"	=>	"",
										"disabled"		=>	false,
										"data_values"	=> 	array(
																array("value"=>5,"option"=>"Val 5", "checked"=>1),
																array("value"=>6,"option"=>"Val 6", "checked"=>0),
															),
										"editor"		=> false					
									),
									array(
										"type"			=>	"file",
										"label"			=>	"Archivo", 
										"icon"			=>	"fa-file", 
										"required"		=>	false, 
										"name"			=>	"file1",
										"value"			=>	"",
										"placeholder"	=>	"",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> 	false					
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