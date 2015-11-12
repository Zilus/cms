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
                    <?php
						$id=intval($_GET['id']);
						$sql="SELECT * FROM galeria WHERE album_id= :album_id";
						$database->query($sql); 
						$database->bind(':album_id', $id);
						$row_a = $database->single();
					?>
						<li>
							<i class="fa fa-picture-o"></i>
							<a href="galeria.php">Galería</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="album_fotos.php?id=<?php echo $id; ?>"><?php echo $row_a['album_name']; ?></a>
                            <i class="fa fa-angle-right"></i>
						</li>
                        <li>
							<a>Nuevo</a>
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
								<i class="fa fa-cogs"></i> Nueva imágen
							</div>
						</div>
						<div class="portlet-body form">
                        	<?php
								$database = new Database();
								$id=intval($_GET['id']);
								$sql="SELECT * FROM users WHERE user_id= :id";
								$database->query($sql); 
								$database->bind(':id', $id);
								$row = $database->single();
								
								$forma = array(
									"action"		=>	"foto_new_upload.php", 
									"id"			=>	"foto_upload_form",
									"method"		=>	"post", 
									"enctype"		=>	1, 
									"edit"			=>	1, 
									"edit_values"	=> array(
															array("name"=>"album_id","value"=>$row_a['album_id'])
														),  
									"submit"		=>	"Subir"
								);
									
								$fields = array (
									array(
										"type"			=>	"file",
										"label"			=>	"Imágen", 
										"icon"			=>	"fa-camera", 
										"required"		=>	true, 
										"name"			=>	"foto",
										"value"			=>	"",
										"placeholder"	=>	"",
										"disabled"		=>	false,
										"data_values"	=> array(),
										"editor"		=> false
									)
								);								
								//echo create_form($forma, $fields);
							?>
                            <form id="fileupload" action="assets/global/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
						<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
						<div class="row fileupload-buttonbar">
							<div class="col-lg-7">
								<!-- The fileinput-button span is used to style the file input field as button -->
								<input type="file" name="files[]" multiple>
								</span>
								<button type="submit" class="btn blue start">
								<i class="fa fa-upload"></i>
								<span>
								Start upload </span>
								</button>
								<button type="reset" class="btn warning cancel">
								<i class="fa fa-ban-circle"></i>
								<span>
								Cancel upload </span>
								</button>
								<button type="button" class="btn red delete">
								<i class="fa fa-trash"></i>
								<span>
								Delete </span>
								</button>
								<input type="checkbox" class="toggle">
								<!-- The global file processing state -->
								<span class="fileupload-process">
								</span>
							</div>
							<!-- The global progress information -->
							<div class="col-lg-5 fileupload-progress fade">
								<!-- The global progress bar -->
								<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar progress-bar-success" style="width:0%;">
									</div>
								</div>
								<!-- The extended global progress information -->
								<div class="progress-extended">
									 &nbsp;
								</div>
							</div>
						</div>
						<!-- The table listing the files available for upload/download -->
						<table role="presentation" class="table table-striped clearfix">
						<tbody class="files">
						</tbody>
						</table>
					</form>
						</div>
					</div>
            <!-- end content --> 
            <script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn blue start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn red cancel">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                        {% if (file.thumbnailUrl) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                        {% } %}
                    </span>
                </td>
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                            <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                    {% if (file.deleteUrl) { %}
                        <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="fa fa-trash-o"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                        <button class="btn yellow cancel btn-sm">
                            <i class="fa fa-ban"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>          
            
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<?php include("includes/footer.php"); ?>