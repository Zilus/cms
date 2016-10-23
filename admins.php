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
									<a href="admin_new.php">Nuevo Usuario</a>
								</li>
							</ul>
						</li>
                        
						<li>
							<i class="fa fa-cogs"></i>
							<a>Sistema</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
                        	<i class="fa fa-users"></i>
							<a href="admins.php">Usuarios</a>
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
								<i class="fa fa-users"></i>Usuarios del sistema
							</div>
							
						</div>
						<div class="portlet-body flip-scroll">
                        	<?php
								if(intval($_GET['e']==1)) {
									echo crear_alerta("error", "<strong>Error:</strong> al crear el usuario");
								} else if(intval($_GET['e']==2)) {
									echo crear_alerta("success", "<strong>Exito:</strong> usuario creado correctamente");
								}
							?>
							<table class="table table-bordered table-striped">
							<thead>
                                <tr>
                                   <th>Nombre</th>
                                   <th>Nivel</th>
                                   <th>Email</th>
                                   <th class="text-center">Acciones</th>
                                </tr>  
							</thead>
                            
							<tbody>
							<?php
								$database = new Database();
								$database->query('SELECT * FROM users WHERE user_id!=1 ORDER BY user_level ASC, user_fullname ASC'); 
								$rows = $database->resultset();
;
								foreach ($rows as &$row) {
									if($row['user_level']==1) {
										$level="Administrador";
									} else {
										$level="Usuario";
									}
									
									echo '<tr>
											<td><a href="admin_edit.php?id='.$row['user_id'].'">'.$row['user_fullname'].'</a></td>
											<td>'.$level.'</a></td>
											<td>'.$row['user_email'].'</a></td>
											<td class="text-center">						
												<a href="admin_edit.php?id='.$row['user_id'].'"><i class="fa fa-pencil pencil" title="Editar"></i></a>
												<a href="admin_delete.php?id='.$row['user_id'].'" OnClick="return Confirm();"><i class="fa fa-trash-o trash" title="Eliminar entrada"></i></a>												
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