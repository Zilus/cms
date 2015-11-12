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
					<?php echo $subtitle; ?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-cloud"></i>
							<a>Archivos</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a>Subir archivo</a>
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
							<form role="form" id="file_upload" action="file_proc1.php" method="post" enctype="multipart/form-data">
								<div class="form-body">
                                	<div class="alert alert-danger display-hide">
										<button class="close" data-close="alert"></button>
										Por favor revisa los campos
									</div>
                                
									<div class="form-group"> 
										<label class="control-label">Título</label>
										<div class="input-group input-icon right">
											<span class="input-group-addon">
											<i class="fa fa-file"></i>
											</span>
											<i class="fa fa-exclamation tooltips" data-original-title="Informaci&oacute;n requerida." data-container="body"></i>
											<input id="title" placeholder="titulo del archivo" class="form-control input-error" type="text" name="file_title"  data-required="1">
										</div>
									</div>   
                                    
                                    <div class="form-group">
										<label for="exampleInputFile1">Archivo</label>
										<input type="file" name="file" id="file_check">
										<p class="help-block">
											 Solo se aceptan archivos PDF, DOC, DOCX, XLS y XLSX 
										</p>
									</div>                    
                                    				
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue">Guardar</button>
								</div>
							</form>
						</div>
					</div>
            <!-- end content -->           
            
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<?php include("includes/footer.php"); ?>