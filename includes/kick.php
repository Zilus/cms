<?php
   	//Check session
	if($_SESSION['logged'] != "1"){
		$_SESSION['ref']=curPageURL();
		header("Location: ".INIT_DIR);
		exit();
	}
?>