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
							<i class="fa fa-envelope"></i>
							<a>Mensajes</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
            
			<!-- content -->
           <div class="row inbox">
				<div class="col-md-2">
					<ul class="inbox-nav margin-bottom-10">
						<li class="compose-btn">
							<a href="javascript:;" data-title="Compose" class="btn green">
							<i class="fa fa-edit"></i> Redactar </a>
						</li>
						<li class="inbox active">
							<a href="javascript:;" class="btn" data-title="Inbox">
							Recibidos (4) </a>
							<b></b>
						</li>
						<li class="sent">
							<a class="btn" href="javascript:;" data-title="Sent">
							Enviados </a>
							<b></b>
						</li>
                        <li class="favs">
							<a class="btn" href="javascript:;" data-title="Favs">
							Favoritos </a>
							<b></b>
						</li>
						<li class="trash">
							<a class="btn" href="javascript:;" data-title="Trash">
							Papalera </a>
							<b></b>
						</li>
					</ul>
				</div>
				<div class="col-md-10">
					<div class="inbox-header">
						<h1 class="pull-left">Bandeja de entrada</h1>
						<form class="form-inline pull-right" action="index.html">
							<div class="input-group input-medium">
								<input type="text" class="form-control" placeholder="Buscar">
								<span class="input-group-btn">
								<button type="submit" class="btn green"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</form>
					</div>
                    
					<div class="inbox-content">
                    	<table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th colspan="3">
                                </th>
                                <th class="pagination-control" colspan="3">
                                    <span class="pagination-info">
                                    70 mensajes 
                                   	</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="unread" data-messageid="1">
                                <td class="inbox-small-cells">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                </td>
                                <td class="view-message hidden-xs">
                                     <a href="algo">Petronas IT</a>
                                </td>
                                <td class="view-message ">
                                     <a href="algo">New server for datacenter needed</a>
                                </td>
                                <td class="view-message text-right">
                                     <a href="algo">16:30 PM</a>
                                </td>
                                <td class="inbox-small-cells">
                                     <a href="#" OnClick="return Confirm();"><i class="fa fa-trash-o"></i></a>		
                                </td>
                            </tr>
                            <tr class="unread" data-messageid="2">
                                <td class="inbox-small-cells">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                </td>
                                <td class="view-message hidden-xs">
                                     Daniel Wong
                                </td>
                                <td class="view-message">
                                     Please help us on customization of new secure server
                                </td>
                                <td class="view-message text-right">
                                     March 15
                                </td>
                                <td class="inbox-small-cells">
                                     <a href="#" OnClick="return Confirm();"><i class="fa fa-trash-o"></i></a>		
                                </td>
                            </tr>
                            <tr data-messageid="3">
                                <td class="inbox-small-cells">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                </td>
                                <td class="view-message hidden-xs">
                                     John Doe
                                </td>
                                <td class="view-message">
                                     Lorem ipsum dolor sit amet
                                </td>
                                <td class="view-message text-right">
                                     March 15
                                </td>
                                <td class="inbox-small-cells">
                                     <a href="#" OnClick="return Confirm();"><i class="fa fa-trash-o"></i></a>		
                                </td>
                            </tr>
                            <tr data-messageid="4">
                                <td class="inbox-small-cells">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                </td>
                                <td class="view-message hidden-xs">
                                     Facebook
                                </td>
                                <td class="view-message">
                                     Dolor sit amet, consectetuer adipiscing
                                </td>
                                <td class="view-message text-right">
                                     March 14
                                </td>
                                <td class="inbox-small-cells">
                                     <a href="#" OnClick="return Confirm();"><i class="fa fa-trash-o"></i></a>		
                                </td>
                            </tr>
                            <tr data-messageid="5">
                                <td class="inbox-small-cells">
                                    <a href="#"><i class="fa fa-star inbox-started"></i></a>
                                </td>
                                <td class="view-message hidden-xs">
                                     John Doe
                                </td>
                                <td class="view-message">
                                     Lorem ipsum dolor sit amet
                                </td>
                                <td class="view-message text-right">
                                     March 15
                                </td>
                                <td class="inbox-small-cells">
                                     <a href="#" OnClick="return Confirm();"><i class="fa fa-trash-o"></i></a>		
                                </td>
                            </tr>
                            <tr data-messageid="6">
                                <td class="inbox-small-cells">
                                    <a href="#"><i class="fa fa-star inbox-started"></i></a>
                                </td>
                                <td class="view-message hidden-xs">
                                     Facebook
                                </td>
                                <td class="view-message">
                                     Dolor sit amet, consectetuer adipiscing
                                </td>
                                <td class="view-message text-right">
                                     March 14
                                </td>
                                <td class="inbox-small-cells">
                                     <a href="#" OnClick="return Confirm();"><i class="fa fa-trash-o"></i></a>		
                                </td>
                            </tr>
                            </tbody>
                            </table>
                    
                    
					</div>
				</div>
			</div>
            <!-- end content -->           
            
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<?php include("includes/footer.php"); ?>