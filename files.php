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
									<a href="files_new.php">Nuevo archivo</a>
								</li>
							</ul>
						</li>
                        
						<li>
							<i class="fa fa-file"></i>
							<a>Archivos</a>
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
								<i class="fa fa-th"></i>Archivos
							</div>
							
						</div>
						<div class="portlet-body flip-scroll">
                        <?php
							if(intval($_GET['e']==1)) {
								echo crear_alerta("error", "<strong>Error:</strong> al procesar el archivo");
							} else if(intval($_GET['e']==2)) {
								echo crear_alerta("success", "<strong>Exito:</strong> archivo cargado correctamente");
							}
						?>
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th>Titulo</th>
                               	<th>Fecha</th>
                                <th>Autor</th>
                                <th style="text-align:center">Ver detalles</th>
                                <th style="text-align:center">Descargar</th>
                                <th style="text-align:center">Eliminar</th>
							</tr>
							</thead>
                            
							<tbody>
							<?php
								$database = new Database();
								$sql="SELECT * FROM files INNER JOIN users ON user_id=file_author ORDER BY file_id ASC";
								$database->query($sql);
								$rows = $database->resultset();
								foreach($rows as &$row) {
									
									$seed = '0123456789abcdefghijklmnopqrstuvwxyz';
									$hash = sha1(uniqid($seed . mt_rand(), true));
									
									$ext = explode(".", $row['file_filename']);
									if($ext[1]=="pdf") {
										$icon="pdf.png";
									} else if($ext[1]=="xls" || $ext[1]=="xlsx") {
										$icon="xls.png";
									} else if($ext[1]=="doc" || $ext[1]=="docx") {
										$icon="doc.png";
									} else if($ext[1]=="jpg" || $ext[1]=="jpeg") {
										$icon="pic.png";	
									} else {
										$icon="view.png";
									}
									
									
									$fecha= $row['file_day']." de ".date_mes($row['file_month'])." de ".$row['file_year'];
									
									
									echo '<tr>
										
											<td>
												<a href="files_detail.php?mes='.$hash.'&id='.$row['file_month'].'&f='.$row['file_id'].'&file='.$row['file_id'].'&day='.$hash.'&d='.$row['file_id'].'&m='.$mes.'&s=1&y='.$row['file_year'].'&year='.date('Y').$hash.date('m').'">'.$row['file_title'].'</a>
											</td>
											<td>
												'.$fecha.'
											</td>
											<td>
												'.$row['user_fullname'].'
											</td>								
											<td style="text-align:center">
												<a href="files_detail.php?mes='.$hash.'&id='.$i.'&f='.$row['file_id'].'&day='.$hash.'&y='.$row['file_year'].'&year='.date('Y').$hash.date('y Y').'"><img title="Ver detalles" src="images/icons/view.png"></a>	
											</td> 
											<td style="text-align:center">
												<a href="download.php?mes='.$hash.'&id='.$row['file_month'].'&file='.$row['file_id'].'&day='.$hash.'&file='.$row['file_filename'].'&y='.$row['file_year'].'&year='.date('Y').$hash.date('m').'"><img title="Ver archivos" src="images/icons/'.$icon.'"></a>	
											</td>
											<td style="text-align:center">
											<a href="files_delete.php?mes='.$hash.'&id='.$i.'&f='.$row['file_id'].'&day='.$hash.'&d='.$row['file_id'].'&m='.$mes.'&s=1&y='.$row['file_year'].'&year='.date('Y').$hash.date('y Y').'" OnClick="return Confirm();"><img src="images/icons/cross.png" title="Eliminar" /></a>
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