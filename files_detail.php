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
							<a href="files.php">Archivos</a>
                            <i class="fa fa-angle-right"></i>
						</li>
                        <li>
							<i class="fa fa-file"></i>
							<a>Detalle de archivo</a>
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
								<i class="fa fa-th"></i>Detalle
							</div>
							
						</div>
						<div class="portlet-body flip-scroll">
                        <?php
							$id=intval($_GET['f']);
							$sql="SELECT * FROM `files` INNER JOIN users ON user_id=file_author WHERE file_id=:id";
							$database->query($sql); 
							$database->bind(':id', $id);
							$row = $database->single();
							
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
							echo '<p>
								<strong>Archivo:</strong> '.$row['file_title'].'<br>
								<strong>Creador:</strong> '.$row['user_fullname'].'<br>
								<strong>Fecha:</strong> '.$fecha.'<br>
								<strong>Descargar:</strong> <a href="download.php?mes='.$hash.'&id='.$row['file_month'].'&file='.$row['file_id'].'&day='.$hash.'&file='.$row['file_filename'].'&y='.$row['file_year'].'&year='.date('Y').$hash.date('m').'"><img title="Ver archivos" src="images/icons/'.$icon.'"></a>
								<br><br>
								<strong>Comentarios al subir:</strong> 
								<br>'.utf8_decode($row['file_comment']).'<br>
								<br><br>
							</p>';
						?>	
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
                    
                    
                     <!-- Notas PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-th"></i>Comentarios
							</div>
							
						</div>
						<div class="portlet-body flip-scroll">
                        	<?php		
								if(intval($_GET['e']==1)) {
									echo crear_alerta("error", "<strong>Error:</strong> al crear el comentario");
								} else if(intval($_GET['e']==2)) {
									echo crear_alerta("success", "<strong>Exito:</strong> comentario creado correctamente");
								}
							
								$forma = array(
									"action"		=>	"files_comments.php", 
									"id"			=>	"",
									"method"		=>	"post", 
									"enctype"		=>	0, 
									"edit"			=>	1, 
									"edit_values"	=> array(
															array("name"=>"id","value"=>$id)
														),  
									"submit"		=>	"Enviar"
								);
									
								$fields = array (
									array(
										"type"			=>	"textarea",
										"label"			=>	"Tu comentario", 
										"icon"			=>	"fa-cogs", 
										"required"		=>	true, 
										"name"			=>	"comments",
										"value"			=>	"",
										"placeholder"	=>	"comentarios sobre el archivo",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									)
								);								
								echo create_form($forma, $fields);
							?>
                            <br><br>
							<table class="table table-bordered table-striped table-condensed flip-content">
							<tbody>
                                <tr>
                                	<td colspan="2">
                                    	<strong>Mensajes</strong>
                                    </td>
                                </tr>
                                <?php									
									$sql="SELECT * FROM files_comments INNER JOIN users ON user_id=comments_author WHERE comments_file= :id ORDER BY comments_id DESC";
									$database->query($sql);
									$database->bind(':id', $id);
									$rows = $database->resultset();
									
									foreach($rows as &$row_n) {
										echo '<tr>
											<td width="35%">
												<em>'.$row_n['user_fullname'].'</em> ('.$row_n['comments_date'].')
											</td>
											<td>
												'.$row_n['comments_comment'].'
											</td>
										</tr>';
									}
								?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END notas PORTLET-->
                    
            	</div>
            </div>
            <!-- end content -->           
            
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<?php include("includes/footer.php"); ?>