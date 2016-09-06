<?php 
session_start();
include('includes/globals.php');
include('includes/kick.php');

$id=intval($_POST['album_id']);

$wi=300;
$he=300;

$seed = '0123456789abcdefghijklmnopqrstuvwxyz';
$hash = sha1(uniqid($seed . mt_rand(), true));
$hash = substr($hash, 0, 10).".jpg";

$sql="SELECT * FROM galeria WHERE album_id=:album_id";
$database->query($sql); 
$database->bind(':album_id', $id);
$row_a = $database->single();

$image=UPLOAD_DIR."/".$hash;
if($_FILES['foto']['size'] != 0) {
	move_uploaded_file ( $_FILES [ 'foto' ][ 'tmp_name' ], $image); 
	
	//html out
	include("includes/header.php");

       echo ' <body class="page-header-fixed">';
        
        include("includes/head.php");
        
        echo '<!-- BEGIN CONTAINER -->
        <div class="page-container">';
            
            include("includes/sidebar.php");
            
            echo '<!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    
                    <!-- BEGIN PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                            <h3 class="page-title">';
                            echo CMS_TITULO;
                            echo '</h3>
                            <ul class="page-breadcrumb breadcrumb">
                                <li>
									<i class="fa fa-picture-o"></i>
									<a href="galeria.php">Galería</a>
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
									<a href="album_fotos.php?id='.$id.'">'.$row_a['album_name'].'</a>
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
									<a>Nueva imágen</a>
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
										<i class="fa fa-th"></i>Recorte de imagen
									</div>
									
								</div>
								<div class="portlet-body flip-scroll">
								<script type="text/javascript">
									$(function(){
						
										$(\'#cropbox\').Jcrop({
											aspectRatio: '.$wi.'/'.$he.',
											onSelect: updateCoords,
											boxWidth: 638
										});
						
									});
						
									function updateCoords(c)
									{
										$(\'#x\').val(c.x);
										$(\'#y\').val(c.y);
										$(\'#w\').val(c.w);
										$(\'#h\').val(c.h);
									};
						
									function checkCoords()
									{
										if (parseInt($(\'#w\').val())) return true;
										alert(\'Por favor Selecciona un ∑rea de recorte antes de continuar.\');
										return false;
									};
						
								</script>
								
								<img src="'.$image.'" id="cropbox" class="center" />
								<br><br>	 
								
								<div class="form-actions">
									<form action="foto_new_save.php" method="post" onsubmit="return checkCoords();">
										<input type="hidden" id="x" name="x" />
										<input type="hidden" id="y" name="y" />
										<input type="hidden" id="w" name="w" />
										<input type="hidden" id="h" name="h" />
										<input type="hidden" id="h" name="id" value="'.$id.'" />
										<input type="hidden" id="h" name="hash" value="'.$hash.'" />
										<input type="hidden" id="h" name="wi" value="'.$wi.'" />
										<input type="hidden" id="h" name="he" value="'.$he.'" />
										<button type="submit" class="btn blue">Guardar</button>
									</form>
									
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
        <!-- END CONTAINER -->';
        
        include("includes/footer.php");
	    
	//end html out
} else {
	header("cache-Control: no-cache, must-revalidate");
	header("Location: $redirect" );
	exit();
}
?>