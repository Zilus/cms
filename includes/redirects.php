<?php
	$serverName = $_SERVER["SCRIPT_NAME"];
	$remove = explode('/', $serverName);
	if(SYSTEM_TYPE==1){
		$fileName = $remove[1];
	} else {
		$fileName = $remove[2];
	}
	
	//////////////////
	//// Redirects////
	//////////////////
	
	$redirect="404.php";
	//User edit
	if($fileName=="user_edit.php") {
		$id_check=intval($_GET['id']);
		if($id_check!=$_SESSION['id']) {
			header('Location: '.$redirect);
			exit();	
		}
	}
	//Admin edit
	if($_SESSION['level']==2) {
		if($fileName=="admin_edit.php") {
			$id_check=intval($_GET['id']);
			if($id_check!=$_SESSION['id']) {
				header('Location: '.$redirect);
				exit();	
			}
		}
	}
	//User avatar
	if($fileName=="user_avatar.php") {
		$id_check=intval($_GET['id']);
		if($id_check!=$_SESSION['id']) {
			header('Location: '.$redirect);
			exit();	
		}
	}
	//Report edit
	if($_SESSION['level']==2) {
		if($fileName=="report_edit.php") {
			$id_check=intval($_GET['id']);
			$sql="SELECT reporte_user FROM reportes WHERE reporte_id=".$id_check." LIMIT 1";
			$query=mysql_query($sql);
			$row_check=mysql_fetch_assoc($query);
			if($row_check['reporte_user']!=$_SESSION['id']) {
				header('Location: '.$redirect);
				exit();	
			}
		}
	}
	//Report view
	if($_SESSION['level']==2) {
		if($fileName=="report_view.php") {
			$id_check=intval($_GET['id']);
			$sql="SELECT reporte_user FROM reportes WHERE reporte_id=".$id_check." LIMIT 1";
			$query=mysql_query($sql);
			$row_check=mysql_fetch_assoc($query);
			if($row_check['reporte_user']!=$_SESSION['id']) {
				header('Location: '.$redirect);
				exit();	
			}
		}
	}
?>