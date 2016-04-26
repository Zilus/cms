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
									<a href="blog_new.php">Nueva entrada</a>
								</li>
							</ul>
						</li>
                    
						<li>
							<i class="fa fa-edit"></i>
							<a>Blog</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="blog.php">Entradas</a>
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
								<i class="fa fa-th"></i>Listado de entradas
							</div>
							
						</div>
						<div class="portlet-body flip-scroll">
                        <?php
							if(intval($_GET['e']==1)) {
								echo crear_alerta("error", "<strong>Error:</strong> en la entrada");
							} else if(intval($_GET['e']==2)) {
								echo crear_alerta("success", "<strong>Exito:</strong> al crear entrada");
							} else if(intval($_GET['e']==3)) {
								echo crear_alerta("success", "<strong>Exito:</strong> al eliminar entrada");
							} else if(intval($_GET['e']==4)) {
								echo crear_alerta("success", "<strong>Exito:</strong> al editar entrada");
							}
						?>		
                        
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
                               	<th>Titulo</th>
                                <th>Fecha</th>
                                <th style="text-align:center">Acciones</th>
							</tr>
							</thead>
                            
							<tbody>
							<?php
								$sql="SELECT * FROM posts WHERE posts_section=:posts_section ORDER BY posts_date DESC";
								$database->query($sql);
								$database->bind(':posts_section', 'blog');
								$rows = $database->resultset();
								foreach($rows as &$row) {	
									$date=explode("/",mysql_date_to_php("d/m/Y", $row['posts_date']));
									echo '<tr>
											<td>'.$row['posts_title'].'</a></td>	
											<td>
												<a>'.$date[0].' de '.date_mes($date[1]).' de '.$date[2].'</a>
											</td>								
											<td style="text-align:center">
												<a href="blog_edit.php?id='.$row['posts_id'].'"><i class="fa fa-pencil pencil" title="Editar entrada"></i></a>
												<a href="blog_delete.php?id='.$row['posts_id'].'"  OnClick="return Confirm();"><i class="fa fa-trash-o trash" title="Eliminar entrada"></i></a>	
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