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
                    	<li class="btn-group">
							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
							<span>Nuevo</span><i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a href="incidencias_new.php">Nueva incidencia</a>
								</li>
							</ul>
						</li>
                        
						<li>
							<i class="fa fa-envelope"></i>
							<a>Incidencias</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="dashboard.php">Listado</a>
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
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-th"></i>Incidencias recibidas
							</div>
						</div>
						<div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content" id="datatable_ajax">
							<thead class="flip-content">
							<tr>
								<th>Fecha</th>
                               	<th>Nombre</th>
                                <th>Categoría</th>
                                <th>Tipo</th>
                                <th style="text-align:center">Acciones</th>
							</tr>
							</thead>
                            
                            <?php
								$sql="SELECT * FROM quejas INNER JOIN categorias ON categorias_id=quejas_cat ORDER BY quejas_type ASC, quejas_id DESC";
								$query=mysql_query($sql);
								$count=mysql_num_rows($query);
								
								$pages = new Paginator;
								$pages->items_total = $count;
								$pages->items_per_page= $itemspp;  
								$pages->mid_range = 2;
								$pages->paginate();
								
								if($count>=$itemspp) {
									echo '<tfoot>
										<tr>
											<td colspan="6">                                    
												<div class="pagination">
												
														'.$pages->display_pages().'
												</div> 
											</td>
										</tr>
									</tfoot>';
                            	}
							?>	
                            
							<tbody>
							<?php
								$sql=$sql.$pages->limit;
								$query=mysql_query($sql);
								while($row=mysql_fetch_assoc($query)) {
									$phpdate = strtotime($row['quejas_date']);
									$mysqldate = date( 'd/m/Y', $phpdate );
									
									if($row['quejas_type']==2) {
										$viewer='<a href="'.$admin_init_dir.'/incidencias_view_int.php?id='.$row['quejas_id'].'" title="Editar"><img src="images/icons/view.png" title="Ver incidencia" /></a>';
										$type="Interno";
									} else {
										$viewer='<a href="'.$admin_init_dir.'/incidencias_view_ext.php?id='.$row['quejas_id'].'" title="Editar"><img src="images/icons/view.png" title="Ver incidencia" /></a>';
										$type="Externo";
									}
									
									echo '<tr>
											<td>
												'.$mysqldate.'
											</td>
											<td>
												'.utf8_decode($row['quejas_nombre']).'</a>
											</td>
											<td>
												'.utf8_decode($row['categorias_nombre']).'</a>
											</td>
											<td>
												<a>'.$type.'</a>
											</td>									
											<td style="text-align:center">
												'.$viewer.'
												<a href="'.$admin_init_dir.'/incidencias_delete.php?id='.$row['quejas_id'].'" OnClick="return Confirm();" title="title"><img src="images/icons/cross.png" title="Eliminar" /></a>	
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