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
                            <i class="fa fa-angle-right"></i>
						</li>
                        <li>
							<a>Redactar</a>
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
                        
                    	<form class="inbox-compose form-horizontal" action="inbox_new_proc.php" method="POST" enctype="multipart/form-data">
                            <div class="inbox-compose-btn">
                                <button class="btn blue"><i class="fa fa-check"></i>Enviar</button>
                            </div>
                            <div class="inbox-form-group mail-to">
                                <label class="control-label">Para:</label>
                                <div class="controls controls-to">
                                    <input type="text" class="form-control" name="to">
                                </div>
                            </div>
                            <div class="inbox-form-group">
                                <label class="control-label">Título:</label>
                                <div class="controls">
                                    <input type="text" class="form-control" name="subject">
                                </div>
                            </div>
                            <div class="inbox-form-group">
                                <textarea name="textarea" id="textarea" placeholder="" class="form-control ckeditor" rows="3" style="visibility: hidden; display: none;">Mete más info</textarea>
                            </div>
                            <div class="inbox-compose-attachment">
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <span class="btn green fileinput-button">
                                <i class="fa fa-plus"></i>
                                <span>
                                Add files... </span>
                                <input type="file" name="files[]" multiple>
                                </span>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped margin-top-10">
                                <tbody class="files">
                                </tbody>
                                </table>
                            </div>
                            <script id="template-upload" type="text/x-tmpl">
                        {% for (var i=0, file; file=o.files[i]; i++) { %}
                            <tr class="template-upload fade">
                                <td class="name" width="30%"><span>{%=file.name%}</span></td>
                                <td class="size" width="40%"><span>{%=o.formatFileSize(file.size)%}</span></td>
                                {% if (file.error) { %}
                                    <td class="error" width="20%" colspan="2"><span class="label label-danger">Error</span> {%=file.error%}</td>
                                {% } else if (o.files.valid && !i) { %}
                                    <td>
                                        <p class="size">{%=o.formatFileSize(file.size)%}</p>
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                           <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                           </div>
                                    </td>
                                {% } else { %}
                                    <td colspan="2"></td>
                                {% } %}
                                <td class="cancel" width="10%" align="right">{% if (!i) { %}
                                    <button class="btn btn-sm red cancel">
                                               <i class="fa fa-ban"></i>
                                               <span>Cancel</span>
                                           </button>
                                {% } %}</td>
                            </tr>
                        {% } %}
                            </script>
                            <!-- The template to display files available for download -->
                            <script id="template-download" type="text/x-tmpl">
                        {% for (var i=0, file; file=o.files[i]; i++) { %}
                            <tr class="template-download fade">
                                {% if (file.error) { %}
                                    <td class="name" width="30%"><span>{%=file.name%}</span></td>
                                    <td class="size" width="40%"><span>{%=o.formatFileSize(file.size)%}</span></td>
                                    <td class="error" width="30%" colspan="2"><span class="label label-danger">Error</span> {%=file.error%}</td>
                                {% } else { %}
                                    <td class="name" width="30%">
                                        <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
                                    </td>
                                    <td class="size" width="40%"><span>{%=o.formatFileSize(file.size)%}</span></td>
                                    <td colspan="2"></td>
                                {% } %}
                                <td class="delete" width="10%" align="right">
                                    <button class="btn default btn-sm" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        {% } %}
                            </script>
                            <div class="inbox-compose-btn">
                                <button class="btn blue"><i class="fa fa-check"></i>Send</button>
                                <button class="btn">Discard</button>
                                <button class="btn">Draft</button>
                            </div>
                        </form>    
                        
                        
                        
                        
                        
                        
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