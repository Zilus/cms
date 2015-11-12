				<div id="left_info">
                	<!--<h1>¡  !</h1>-->
                    <p>
                    	<img src="<?php echo $_SESSION['avatar']; ?>" width="50" height="50" align="left" alt="avatar"> 
                        <span>Bienvenido</span><br /> <? echo utf8_encode($_SESSION['fullname']); ?><br />
                        <?php 
                         if($_SESSION['level']==1) { 
                        	echo 'Edita: <a href="admin_edit.php?id=<'.$_SESSION['id'].'">info</a> &oacute; <a href="admin_avatar.php?id='.$_SESSION['id'].'">avatar.</a>';
						 }
						?>
                    </p>
                </div>                    