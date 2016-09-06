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
                            <?php
								$id=intval($_GET['id']);
								$sql="SELECT * FROM galeria WHERE album_id=:album_id";
								$database->query($sql); 
								$database->bind(':album_id', $id);
								$row_a = $database->single();
							?>
								<li> 
									<a href="foto_new.php?id=<?php echo $id; ?>">Nueva foto</a>
								</li>
							</ul>
						</li>
                        
						<li>
							<i class="fa fa-picture-o"></i>
							<a href="galeria.php">Galería</a>
						<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="album_fotos.php?id=<?php echo $id; ?>"><?php echo $row_a['album_name']; ?></a>
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
								<i class="fa fa-th"></i>Fotos del album: <?php echo $row_a['album_name']; ?>
							</div>
							
						</div>
						<div class="portlet-body flip-scroll">
                        	<?php
								if(intval($_GET['e']==1)) {
									echo crear_alerta("error", "<strong>Error:</strong> al guardar la foto");
								} else if(intval($_GET['e']==2)) {
									echo crear_alerta("success", "<strong>Exito:</strong> foto guardada correctamente");
								}
							?>
							<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>Foto</th>
                                <th style="text-align:center">Acciones</th>
							</tr>
							</thead>
                            
							<tbody>
							<?php
								$sql="SELECT * FROM fotos WHERE foto_album= :album_id ORDER BY foto_id ASC";
								$database->query($sql);
								$database->bind(':album_id', $id);
								$rows = $database->resultset();
								foreach($rows as &$row) {
									
									if($row['foto_status']==1) {
										$img='<i class="fa fa-check activei" title="Desactivar"></i>';
										$action="foto_noactive.php";
									} else {
										$img='<i class="fa fa-minus-circle noactivei" title="Activar"></i>';
										$action="foto_active.php";
									}
									
									echo '<tr>
											<td>
												<a target="_blank" href="'.GALERIA_DIR.'/'.$row_a['album_dir'].'/'.$row['foto_filename'].'"><img width="150" src="'.GALERIA_DIR.'/'.$row_a['album_dir'].'/thumb-'.$row['foto_filename'].'" /></a>
											</td>
											<td style="text-align:center">	
												<a href="'.$action.'?id='.$row['foto_id'].'&album='.$row_a['album_id'].'">'.$img.'</a>					
												
												<a href="foto_delete.php?id='.$row['foto_id'].'&album='.$row_a['album_id'].'" OnClick="return Confirm();"><i class="fa fa-trash-o trash" title="Eliminar"></i></a>										
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