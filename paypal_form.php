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
							<i class="fa fa-calendar"></i>
							<a>Paypal</a>
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
								<i class="fa fa-cogs"></i> Nuevo Pago
							</div>
						</div>
						<div class="portlet-body form">
							<form role="form" action="paypal.php" method="post" enctype="multipart/form-data">
                            <?php
								$item_id="10";
								$item_value=100;
								$item_name="nombre item";
								//fields may be hidden
							?>
                            	
								<div class="form-body">
									<div class="form-group"> 
										<label>Nombre del comprador</label>
										<div class="input-group input-icon right">
											<span class="input-group-addon">
											<i class="fa fa-user"></i>
											</span>
											<i class="fa fa-exclamation tooltips" data-original-title="Informaci&oacute;n requerida." data-container="body"></i>
											<input id="title" class="input-error form-control" type="text" name="payer_fname" placeholder="Nombre">
										</div>
									</div>   
                                    
                                    <div class="form-group"> 
										<label>Apellido</label>
										<div class="input-group input-icon right">
											<span class="input-group-addon">
											<i class="fa fa-user"></i>
											</span>
											<i class="fa fa-exclamation tooltips" data-original-title="Informaci&oacute;n requerida." data-container="body"></i>
											<input id="title" class="input-error form-control" type="text" name="payer_lname" placeholder="Apelldo">
										</div>
									</div> 
                                    
                                    <div class="form-group"> 
										<label>Email</label>
										<div class="input-group input-icon right">
											<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
											</span>
											<i class="fa fa-exclamation tooltips" data-original-title="Informaci&oacute;n requerida." data-container="body"></i>
											<input id="title" class="input-error form-control" type="email" name="payer_email" placeholder="email">
										</div>
									</div>    
                                    
                                    <div class="form-group"> 
										<label>Teléfono</label>
										<div class="input-group input-icon right">
											<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
											</span>
											<i class="fa fa-exclamation tooltips" data-original-title="Informaci&oacute;n requerida." data-container="body"></i>
											<input id="title" class="input-error form-control" type="email" name="tel" placeholder="Teléfono">
										</div>
									</div>               
                                    				
								</div>
								<div class="form-actions">
                                	<input type="hidden" name="action" value="process" />
                                    <input type="hidden" name="cmd" value="_cart" /> 
                                    <input type="hidden" name="currency_code" value="MXN" />
                                    <input type="hidden" name="invoice" value="<?php echo date("His").rand(1234, 9632); ?>" />
                                    
                                    
                                    <input type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
                                    <input type="hidden" name="product_amount" value="<?php echo $item_value; ?>" />
                                    <input type="hidden" name="product_name" value="<?php echo $item_name; ?>" />
                                   
                                    
									<button type="submit" class="btn blue">Pagar ahora</button>
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