<?php
include_once('../includes/config.php');
include_once('../lib/database.class.php');
require '../lib/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$database = new Database();

$app->get('/users','getUsers');
$app->get('/user/:user_id','getUsersId');
$app->put('/update/:user_id','updateUser');
$app->post('/insert','insertUser');
$app->delete('/delete/:user_id','deleteUser');

/* api Keys */
function validateKey($apiKey) {
	/* function hash_password($password, $salt) {
		$hash = hash_hmac("md5", $salt, $password);
		for ($i = 0; $i < 1000; $i++) {
			$hash = hash_hmac("md5", $hash, $password);
		}
		return $hash;
	}
	$database = new Database();
	$sql="SELECT * FROM settings WHERE settings_desc=:settings_desc";
	$database->query($sql);
	$database->bind(':settings_desc', "apiKey");
	$row = $database->single();
	$hash=hash_password($row['settings_value'], $row['settings_extra']);
	/*if($hash!=$row['settings_extra2']) {
		echo "get out";  
		exit();
	}*/
	echo $apiKey;
}
/*end api keys */
 
// GET https://www.loop.mx/cms/api/users
function getUsers() {
	$database = new Database();
	$sql="SELECT * FROM mytable";
	$database->query($sql);
	if($rows = $database->resultset()) {
	echo '{"success":true, "result":';
		/*foreach($rows as &$row) {
			echo json_encode($row).",";
		}*/
		echo json_encode($rows);
	echo '}';	
	} else {
		echo '{"success":false, "error": "No se pueden listar los usuarios"}';
	}
}

// GET https://www.loop.mx/cms/api/users/:user_id
function getUsersId($user_id) {
	$database = new Database();
	$sql="SELECT * FROM mytable WHERE ID=:user_id";
	$database->query($sql);
	$database->bind(':user_id', $user_id);
	if($rows = $database->resultset()) {
		foreach($rows as &$row) {
			echo '{"users": ' . json_encode($row) . '}';
		}
	} else {
		echo json_encode(array(
            "status" => false,
            "message" => "El usuario con ID $user_id no existe"
        ));	
	}
}

//PUT https://www.loop.mx/cms/api/update/:id
function updateUser($user_id) {
	$app = \Slim\Slim::getInstance();
	$params = $app->request->post();
	$database = new Database();
	$sql="UPDATE mytable SET FName=:FName,LName=:LName,Age=:Age,Gender=:Gender WHERE ID = :user_id";
	$database->query($sql);
	$database->bind(':FName', $params['FName']);
	$database->bind(':LName', $params['LName']);
	$database->bind(':Age', $params['Age']);
	$database->bind(':Gender', $params['Gender']);
	$database->bind(':user_id', $user_id);
	if($database->execute()) {
		echo json_encode(array(
            "status" => true,
            "message" => "El usuario con ID $user_id se edito correctamente"
        ));	
	} else {
		echo json_encode(array(
            "status" => false,
            "message" => "El usuario con ID $user_id NO se edito correctamente"
        ));	
	}
}


//POST https://www.loop.mx/cms/api/insert
function insertUser() {
	$app = \Slim\Slim::getInstance();
	$params = $app->request->post();
	$database = new Database();
	$sql="INSERT INTO mytable (FName,LName,Age,Gender) VALUES (:FName,:LName,:Age,:Gender)";
	$database->query($sql);
	$database->bind(':FName', $params['FName']);
	$database->bind(':LName', $params['LName']);
	$database->bind(':Age', $params['Age']);
	$database->bind(':Gender', $params['Gender']);
	if($database->execute()) {
		echo json_encode(array(
            "status" => true,
            "message" => "Nuevo usuario creado correctamente"
        ));	
	} else {
		echo json_encode(array(
            "status" => false,
            "message" => "Error al crear nuevo usuario"
        ));	
	} 
}

//DELETE https://www.loop.mx/cms/api/delete/:user_id
function deleteUser($user_id) {
	$database = new Database();
	$sql="DELETE FROM mytable WHERE ID=:user_id";
	$database->query($sql);
	$database->bind(':user_id', $user_id);
	if($database->execute()) {
		echo json_encode(array(
            "status" => true,
            "message" => "El usuario con ID $user_id se elimino"
        ));	
	} else {
		echo json_encode(array(
            "status" => false,
            "message" => "El usuario con ID $user_id no existe"
        ));	
	}
}

$app->run();
?> 