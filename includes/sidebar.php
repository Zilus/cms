<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<br>
                <li 
                <?php
					if(pagActual()=="dashboard.php" 
						|| pagActual()=="dashboard_new.php"					
					) {
						echo ' class="active"';
					}
				?>
                >
					<a href="dashboard.php">
					<i class="fa fa-dashboard"></i>
					<span class="title">Dashboard</span>
					</a>
				</li>
                
                <li 
                <?php
					if(pagActual()=="files.php" 
						|| pagActual()=="files_new.php"		
						|| pagActual()=="files_detail.php"					
					) {
						echo ' class="active"';
					}
				?>
                >
					<a href="files.php">
					<i class="fa fa-file"></i>
					<span class="title">Archivos</span>
					</a>
				</li>
                
                 
                <li
				 <?php
					if(pagActual()=="galeria.php" 
						|| pagActual()=="album_fotos.php"
						|| pagActual()=="album_new.php"
						|| pagActual()=="album_edit.php"
						|| pagActual()=="foto_new.php"
						|| pagActual()=="foto_new_upload.php"
					) {
						echo ' class="active"';
					}
				?>
                >
					<a href="#">
					<i class="fa fa-picture-o"></i>
					<span class="title">Galería</span>
					<span class="arrow "></span> 
					</a>
                    <ul class="sub-menu">
                        <li <?php if(pagActual()=="galeria.php") { echo ' class="active"'; } ?>>
                            <a href="galeria.php">
                            <i class="fa fa-list"></i>
                            Listado</a>
                        </li>
                        <?php
							$database = new Database();
							$sql="SELECT * FROM galeria ORDER BY album_id ASC";
							$database->query($sql);
							if($database->rowCount()!=0) {
								$rows = $database->resultset();
								foreach($rows as &$row) {
									echo '<li '; if(pagActual()=="album_fotos.php" && intval($_GET['id'])==$row['album_id']) { echo ' class="active"'; }  else if(pagActual()=="foto_new.php" && intval($_GET['id'])==$row['album_id'] ) { echo ' class="active"'; } else if(pagActual()=="foto_new_upload.php" && intval($_POST['id'])==$row['album_id'] ) { echo ' class="active"'; } 
									echo '>
										<a href="album_fotos.php?id='.$row['album_id'].'">
										<i class="fa fa-picture-o"></i>
										'.$row['album_name'].'</a>
									</li>';
								}
							}
                        ?>
                    </ul>
				</li>
                
                <?php
					if($_SESSION['level']==1) { 
				?>
					
					<li 
                    <?php 
						if(pagActual()=="info.php"  
							|| pagActual()=="ambulance.php"
							|| pagActual()=="contacto.php"
							|| pagActual()=="admins.php"
							|| pagActual()=="admin_new.php"
							|| pagActual()=="admin_edit.php"
							|| pagActual()=="profile.php"
						) {
							echo ' class="active"';
						}
                		?>
						class="last">
						<a href="javascript:;">
						<i class="fa fa-cogs"></i>
						<span class="title">Sistema</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li <?php if(pagActual()=="admins.php" || pagActual()=="admin_new.php" || pagActual()=="admin_edit.php" || pagActual()=="admin_avatar.php") { echo ' class="active"'; } ?>>
								<a href="admins.php">
								<i class="fa fa-users"></i>
								Usuarios</a>
							</li>
							<li <?php if(pagActual()=="info.php") { echo ' class="active"'; } ?>>
								<a href="info.php">
								<i class="fa fa-bookmark"></i>
								Informaci&oacute;n del Sitio</a>
							</li>
							<li <?php if(pagActual()=="contacto.php") { echo ' class="active"'; } ?>>
								<a href="contacto.php">
								<i class="fa fa-envelope"></i>
								Contacto</a>
							</li>	
							<li <?php if(pagActual()=="ambulance.php") { echo ' class="active"'; } ?>>
								<a href="ambulance.php">
								<i class="fa fa-ambulance"></i>
								Mantenimiento de sitio</a>
							</li>
						</ul>
					</li>';
				<?php	
                    }
				?>
                <!-- custom end -->
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->