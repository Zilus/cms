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
                    	<li class="btn-group">
							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
							<span>Nuevo</span><i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a href="album_new.php">Nuevo Album</a>
								</li>
							</ul>
						</li>
                        
						<li>
							<i class="fa fa-picture-o"></i>
							<a>Galería</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
            
			<!-- content -->
            <div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-th"></i>Albums
							</div>
							
						</div>
						<div class="portlet-body flip-scroll">
                        	<?php
								if(intval($_GET['e']==1)) {
									echo crear_alerta("error", "<strong>Error:</strong> al crear el album");
								} else if(intval($_GET['e']==2)) {
									echo crear_alerta("success", "<strong>Exito:</strong> album creado correctamente");
								}
							?>
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th>Nombre</th>
                                <th class="text-center">Acciones</th>
							</tr>
							</thead>
                            
							<tbody>
							<?php
								$database = new Database();
								$sql="SELECT * FROM galeria ORDER BY album_id ASC";
								$database->query($sql);
								$rows = $database->resultset();
								foreach($rows as &$row) {
									
									if($row['album_status']==1) {
										$img='<i class="fa fa-check activei" title="Desactivar"></i>';
										$action="album_noactive.php";
									} else {
										$img='<i class="fa fa-minus-circle noactivei" title="Activar"></i>';
										$action="album_active.php";
									}
									
									echo '<tr>
											<td>
												<a href="album_fotos.php?id='.$row['album_id'].'">'.$row['album_name'].'</a>
											</td>									
											<td class="text-center"> 
												<a href="album_fotos.php?id='.$row['album_id'].'"><i class="fa  fa-picture-o pic" title="Ver fotos"></i></a>
												<a href="album_edit.php?id='.$row['album_id'].'"><i class="fa fa-pencil pencil" title="Editar"></i></a>
												<a href="'.$action.'?id='.$row['album_id'].'">'.$img.'</a>
												<a href="album_delete.php?id='.$row['album_id'].'"  OnClick="return Confirm();"><i class="fa fa-trash-o trash" title="Eliminar"></i></a>		
											</td>                        
										</tr>';	
								}	
                            ?>   
							</tbody>
							</table>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
            	</div>
            </div>
            <!-- end content -->           
            
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<?php include("includes/footer.php"); ?>