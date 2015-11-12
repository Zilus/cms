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
							<span>Exportar</span><i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
                                <li>
									<a target="_blank" href="estadisticas_pdf.php">Exportar a PDF</a>
								</li>
                                <li>
									<a target="_blank" href="incidencias_xls.php">Exportar a XLS</a>
								</li>
							</ul>
						</li>
                        	
						<li>
							<i class="fa fa-envelope"></i>
							<a>Incidencias</a>
							<i class="fa fa-angle-right"></i>
						</li> 
						<li>
							<a href="#">Estadisticas</a>
                            <i class="fa fa-angle-right"></i>
						</li>
                        <li>
							<a href="estadisticas.php">Totales</a>
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
								<i class="fa fa-th"></i>Estadisticas totales
							</div>
						</div>
						<div class="portlet-body flip-scroll">
                            
                            <!-- BEGIN PIE CHARTS 1-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="portlet box red">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-pie-chart"></i>Marcas con más quejas
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                        	<div id="pie_chart" class="chart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="portlet box yellow">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-pie-chart"></i>Status con la marca
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="pie_chart1" class="chart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PIE CHARTS-->
                            
                            
                            <!-- BEGIN PIE CHARTS 2-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet box purple">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-pie-chart"></i>Concesionario implicado
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="pie_chart4" class="chart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PIE CHARTS-->
                            
                            
                            <!-- BEGIN Stats-->
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat blue-madison">
                                        <div class="visual">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                            <?php
                                                echo "30";
                                            ?>
											</div>
                                            <div class="desc"> 
                                                 Incidencias
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat red-intense">
                                        <div class="visual">
                                            <i class="fa fa-dashboard"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                            <?php
												echo "3 dias";
											?>
                                            </div>
                                            <div class="desc">
                                                 Respuesta promedio
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat green-haze">
                                        <div class="visual">
                                            <i class="fa fa-inbox"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                            <?php
                                                echo "20";
                                            ?>
                                            </div>
                                            <div class="desc">
                                                 Abiertas
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat purple-plum">
                                        <div class="visual">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                            <?php
                                                echo "120";
                                            ?>
                                            </div>
                                            <div class="desc">
                                                 Cerradas
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <!-- END Stats-->
                            
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


<!-- Charts data -->
<script type="text/javascript">
	$( document ).ready(function() {
	
	//marcas con mas quejas
	<?php
		$colores = array("#4572A7","#80699B","#3D96AE", "#AA4643", "#89A54E","#3D96AE","#FF8C00", "#5F9EA0", "#808000", "#D2691E". "#C0C0C0", "#EEE8AA", "#8B0000", "#87CEEB", "#48D1CC", "#8FBC8F", "#8B008B", "#BDB76B");
		$total=100;
		
		//quejas por marca
		$c=0;
		echo 'var data = [';
		for ($i = 1; $i <= 10; $i++) {
			//math
			$num=20/$total;
			
    		
			echo '
				{ label: "'.$i.'",  data: '.$num.', color: "'.$colores[$c].'"},
			';
			$c++;
		}
		echo '];';
	?>
	$.plot($("#pie_chart"), data, {
		 series: {
			pie: {
				show: true
			}
		 },
		 legend: {
			show: false
		 }
	});
	
	//status con la marca
	<?php	
		echo 'var data1 = [';
		//math
		$num=10/$total;
		 
		echo '
			{ label: "Cliente",  data: '.$num.', color: "'.$colores[0].'"},
		';
		$num=30/$total;
		
		echo '
			{ label: "Prospecto",  data: '.$num.', color: "'.$colores[1].'"},
		';
		$num=15/$total;
		 
		echo '
			{ label: "Ninguno",  data: '.$num.', color: "'.$colores[2].'"},
		';
		echo '];';
	?>
	
	$.plot($("#pie_chart1"), data1, {
		series: {
			pie: {
				innerRadius: 0.5,
				show: true
			}
		},
		legend: {
			show: false
		}
	});

	
	//concecionario
	<?php
		echo 'var data4 = [';;
		$c=0;
		for ($i = 1; $i <= 10; $i++) {
			//math
			$num=$i;
			
				echo '
					[ '.$i.',  '.$num.'],
				';
			$c++;
		}
		echo '];';
	?>
	
	$.plot("#pie_chart4", [ data4 ], {
		series: {
			color: "#4572A7",
			bars: {
				show: true,
				barWidth: 0.3,
				align: "center"
			}
		},
		xaxis: {
			mode: "categories",
			tickLength: 0,
			//rotateTicks: 45
		}
	});
	
	
	
});
</script>
<?php include("includes/footer.php"); ?>