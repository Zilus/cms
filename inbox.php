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
							<a href="inbox.php">Mensajes</a>
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
							<a href="inbox_new.php" data-title="Compose" class="btn green">
							<i class="fa fa-edit"></i> Redactar </a>
						</li>
                        <?php
							$sql="SELECT * FROM mailbox";
							$database->query($sql);
							$rows_menu=$database->resultset();
							
							foreach($rows_menu as $row_menu) {
								$file=basename(__FILE__, '.php');
								if($file==strtolower($row_menu['mailbox_name'])) {
									$active="active";
								} else {
									$active="";
								}
								
								if(strtolower($row_menu['mailbox_name'])=="inbox") {
									$sql="SELECT inbox_id FROM inbox WHERE inbox_to=:inbox_to AND inbox_read=:inbox_read";
									$database->query($sql);
									$database->bind('inbox_to', $_SESSION['id']);
									$database->bind('inbox_read', 0);
									$database->execute();
									$msgcount="(".$database->rowCount().")";
								} else {
									$msgcount="";
								}
								
								echo '<li class="'.$active.'">
									<a href="'.strtolower($row_menu['mailbox_name']).'.php" class="btn" data-title="'.$row_menu['mailbox_name'].'">
									'.$row_menu['mailbox_name'].' '.$msgcount.' </a>
									<b></b>
								</li>';
							}
						?>
					</ul>
				</div>
				<div class="col-md-10">
					<div class="inbox-header">
						<h1 class="pull-left">Bandeja de entrada</h1>
						<!-- TODO searchable inbox
                        <form class="form-inline pull-right" action="index.html">
							<div class="input-group input-medium">
								<input type="text" class="form-control" placeholder="Buscar">
								<span class="input-group-btn">
								<button type="submit" class="btn green"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</form>-->
					</div>
                    
					<div class="inbox-content">
                    	<table class="table table-striped table-advance table-hover">
                        <?php
							$sql="SELECT inbox_id FROM inbox WHERE inbox_to=:inbox_to AND inbox_mailbox=:inbox_mailbox";
							$database->query($sql);
							$database->bind('inbox_to', $_SESSION['id']);	
							$database->bind('inbox_mailbox', 1);							
							$mensajes=$database->resultset();
							$total_mensajes=$database->rowCount();
						?>
                            <thead>
                                <tr>
                                    <th colspan="3">
                                    </th>
                                    <th class="pagination-control" colspan="3">
                                        <span class="pagination-info">
                                        <?php echo $total_mensajes; ?> mensajes 
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
								foreach($mensajes as &$mensaje) {
									if($mensaje['inbox_read']==0) { $unred=='class="unread"'; } else { $unred==''; }
									if($mensaje['inbox_fav']==1) { $star='inbox-started'; } else { $star=''; }
									echo '<tr '.$unread.'>
										<td class="inbox-small-cells">
											<a href="inbox_fav.php?msg='.$mensaje['inbox_id'].'&fav='.$fav.'"><i class="fa fa-star '.$star.'"></i></a>
										</td>
										<td class="view-message hidden-xs">
											 <a href="inbox_detail.php?msg='.$mensaje['inbox_id'].'">'.$mensaje['inbox_to'].'</a>
										</td>
										<td class="view-message ">
											 <a href="inbox_detail.php?msg='.$mensaje['inbox_id'].'">'.$mensaje['inbox_title'].'</a>
										</td>
										<td class="view-message text-right">
											 <a href="inbox_detail.php?msg='.$mensaje['inbox_id'].'">'.$mensaje['inbox_date'].'</a>
										</td>
										<td class="inbox-small-cells">
											 <a href="inbox_trash.php?msg='.$mensaje['inbox_id'].'" OnClick="return Confirm();"><i class="fa fa-trash-o"></i></a>		
										</td>
									</tr>';
								}
							?>
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