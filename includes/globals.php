<?php
if (substr($_SERVER['HTTP_HOST'], 0, 4) != 'www.') {
    header('Location: http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 's':'').'://' . "www.".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit;
} 
include('config.php');
if (!class_exists('Database')) {
    include('lib/database.class.php');
}


//Config Vars
$database = new Database();

$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
$database->bind(':settings_desc', 'ambulance');
$row_ambulance = $database->single();

$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
$database->bind(':settings_desc', 'apiKey');
$row = $database->single();
define("KEY", htmlentities($row['settings_value']));

$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
$database->bind(':settings_desc', 'title');
$row = $database->single();
define("TITLE", htmlentities($row['settings_value']));

$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
$database->bind(':settings_desc', 'url');
$row = $database->single();
define("INIT_DIR", $row['settings_value']);

$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
$database->bind(':settings_desc', 'desc');
$row = $database->single();
define("DESCRIPTION", strip_tags(utf8_encode(html_entity_decode($row['settings_value']))));

$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
$database->bind(':settings_desc', 'keywords');
$row = $database->single();
define("KEYWORDS", strip_tags(utf8_encode(html_entity_decode($row['settings_value']))));

$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
$database->bind(':settings_desc', 'cms_title');
$row = $database->single();
define("CMS_TITLE", $row['settings_value']);

$database->query('SELECT * FROM settings WHERE settings_desc= :settings_desc'); 
$database->bind(':settings_desc', 'cms_subtitle');
$row = $database->single();
define("CMS_SUBTITLE", $row['settings_value']);

define("COPY",'Desarrollo de: <a target="_blank" href="http://www.loop.mx">Loop Media</a> &copy; '.date("Y"));
define("AUTHOR",'Oscar Azpeitia');


//frontend constants
define("CSS_DIR", INIT_DIR."/css");
define("JS_DIR", INIT_DIR."/js");
define("IMG_DIR", INIT_DIR."/images");

// Admin globals
if(SYSTEM_TYPE==1) {
	define("ADMIN_DIR", INIT_DIR."/admin");
	define("GALERIA_DIR", "../images/galeria");
	define("UPLOAD_DIR", "../images/uploads");	
} else {
	define("ADMIN_DIR", INIT_DIR);
	define("GALERIA_DIR", "images/galeria");
	define("UPLOAD_DIR", "images/uploads");
}
define("ADMIN_CSS", ADMIN_DIR."/css");
define("ADMIN_JS", ADMIN_DIR."/js");
define("ADMIN_IMG", ADMIN_DIR."/images");

//Extras
define("AVATAR_DIR", "images/avatar");
define("UPLOADS_REL", INIT_DIR."/images/uploads/");
define("UPLOADS_ABS", $_SERVER['DOCUMENT_ROOT'].'/images/uploads/');
define("ITEMSPP", 10);
define("CMS_TITULO", CMS_TITLE.' <small>'.CMS_SUBTITLE.'</small>');
?>