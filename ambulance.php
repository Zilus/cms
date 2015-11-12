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
							<a href="ambulance.php">Mantenimiento del sitio</a>
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
								<i class="fa fa-cogs"></i> Mantenimiento del sitio
							</div>
						</div>
						<div class="portlet-body form">
						<?php
							if(intval($_GET['e']==1)) {
								echo crear_alerta("error", "<strong>Error:</strong> al poner el sitio bajo mantenimiento");
							} else if(intval($_GET['e']==2)) {
								echo crear_alerta("success", "<strong>Exito:</strong> al poner el sitio bajo mantenimiento");
							}
							
                            $database = new Database();
                            $database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
                            $database->bind(':settings_desc', 'ambulance');
                            $row = $database->single(); 
							
							$forma = array(
								"action"		=>	"ambulance_proc.php", 
								"id"			=>	"",
								"method"		=>	"post", 
								"enctype"		=>	0, 
								"edit"			=>	0, 
								"edit_values"	=> array(),  
								"submit"		=>	"Guardar cambios"
							);
								
							$fields = array (
								array(
									"type"			=>	"radio",
									"label"			=>	"Poner el sitio bajo mantenimiento", 
									"icon"			=>	"fa-ambulance", 
									"required"		=>	true, 
									"name"			=>	"settings_value",
									"value"			=>	"",
									"placeholder"	=>	"",
									"disabled"		=>	false,
									"data_values"	=> array(
															array("value"=>1,"option"=>"Si", "checked"=>0),
															array("value"=>0,"option"=>"No", "checked"=>0),
														),
									"editor"		=> false
								)
							);
							
							$clave=multidimensional_search($fields, array('name'=>"settings_value"));
							$subclave=multidimensional_search($fields[$clave]["data_values"], array('value'=>$row['settings_value']));
							$fields[$clave]["data_values"][$subclave]["checked"]=1;							
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