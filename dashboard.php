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
							<i class="fa fa-dashboard"></i>
							<a>Dashboard</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="dashboard.php">Inicio</a>
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
								<i class="fa fa-th"></i>Tabla ejemplo
							</div>
							
						</div>
						<div class="portlet-body flip-scroll">
                        <?php
							if(intval($_GET['e']==1)) {
								echo crear_alerta("error", "<strong>Error:</strong> de dashboard");
							} else if(intval($_GET['e']==2)) {
								echo crear_alerta("success", "<strong>Exito:</strong> de dashboard");
							}
						?>		
                        
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th>Nombre</th>
                               	<th>Edad</th>
                                <th style="text-align:center">Acciones</th>
							</tr>
							</thead>
                            
							<tbody>
							<?php
								$sql="SELECT * FROM mytable";
								$database->query($sql);
								if($database->rowCount()!=0) {
									$rows = $database->resultset();
									foreach($rows as &$row) {	
										echo '<tr>
												<td>
													<a>'.utf8_decode($row['FName']." ".$row['LName']).'</a>
												</td>
												<td>'.$row['Age'].'</a></td>									
												<td style="text-align:center">
													<a href="posts_edit.php?id='.$row['ID'].'"><img src="images/icons/view.png" title="Mira tus predicciones" /></a>
												</td>                        
											</tr>';	
									}
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