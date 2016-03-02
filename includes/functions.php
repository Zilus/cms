<?php
//CurrPageURL
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
//CurrPagScriptName
function pagActual() {
	return substr($_SERVER['SCRIPT_NAME'],strrpos($_SERVER['SCRIPT_NAME'],'/')+1);
}
/** Date fixing **/
function date_mes($raw_mes) {
	if($raw_mes=='1' || $raw_mes=='01') {
		$mes="Enero";
	} else if($raw_mes=='2' || $raw_mes=='02') {
		$mes="Febrero";
	} else if($raw_mes=='3' || $raw_mes=='03') {
		$mes="Marzo";
	} else if($raw_mes=='4' || $raw_mes=='04') {
		$mes="Abril";
	} else if($raw_mes=='5' || $raw_mes=='05') {
		$mes="Mayo";
	} else if($raw_mes=='6' || $raw_mes=='06') {
		$mes="Junio";
	} else if($raw_mes=='7' || $raw_mes=='07') {
		$mes="Julio";
	} else if($raw_mes=='8' || $raw_mes=='08') {
		$mes="Agosto";
	} else if($raw_mes=='9' || $raw_mes=='09') {
		$mes="Septiembre";
	} else if($raw_mes=='10' || $raw_mes=='10') {
		$mes="Octubre";
	} else if($raw_mes=='11' || $raw_mes=='11') {
		$mes="Noviembre";
	} else if($raw_mes=='12' || $raw_mes=='12') {
		$mes="Diciembre";
	} 
	return $mes;
}

function date_mes_s($raw_mes) {
	if($raw_mes=='1' || $raw_mes=='01') {
		$mes="ene";
	} else if($raw_mes=='2' || $raw_mes=='02') {
		$mes="feb";
	} else if($raw_mes=='3' || $raw_mes=='03') {
		$mes="mar";
	} else if($raw_mes=='4' || $raw_mes=='04') {
		$mes="abr";
	} else if($raw_mes=='5' || $raw_mes=='05') {
		$mes="may";
	} else if($raw_mes=='6' || $raw_mes=='06') {
		$mes="jun";
	} else if($raw_mes=='7' || $raw_mes=='07') {
		$mes="jul";
	} else if($raw_mes=='8' || $raw_mes=='08') {
		$mes="ago";
	} else if($raw_mes=='9' || $raw_mes=='09') {
		$mes="sept";
	} else if($raw_mes=='10' || $raw_mes=='10') {
		$mes="oct";
	} else if($raw_mes=='11' || $raw_mes=='11') {
		$mes="nov";
	} else if($raw_mes=='12' || $raw_mes=='12') {
		$mes="dic";
	} 
	return $mes;
}

//Youtuve video id
function youtube_id($url) {
	parse_str( parse_url( $url, PHP_URL_QUERY ), $vid );
	$yt_id=$vid['v']; 
	
	return $yt_id;
}

//Vimeo video id
function vimeo_id($url) {
	sscanf(parse_url($url, PHP_URL_PATH), '/%d', $vi_id);
	
	return $vi_id;
}

//Vimeo info
function getVimeoInfo($id, $info = 'thumbnail_medium') {
	if (!function_exists('curl_init')) die('CURL is not installed!');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$output = unserialize(curl_exec($ch));
	$output = $output[0][$info];
	curl_close($ch);
	return $output;
}

//Check Email
function checkEmail($email){
  return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
}

//Check Email, the good one: Returns boolean
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || 
 checkdnsrr($domain,"A")))
      {
         $isValid = false;
      }
   }
   return $isValid;
}

//Mail Confirm Template function
function format_email($gt, $email, $key, $format){

	//set the root
	$root = $_SERVER['DOCUMENT_ROOT'].'/admin';

	//grab the template content
	$template = file_get_contents($root.'/includes/emails/email_confirm_html.'.$format);
			
	//replace all the tags
	$template = ereg_replace('{USERNAME}', $gt, $template);
	$template = ereg_replace('{EMAIL}', $email, $template);
	$template = ereg_replace('{KEY}', $key, $template);
	$template = ereg_replace('{SITEPATH}','http://www.vchallenge.org', $template);
		
	//return the html of the template
	return $template;

}

//Mail Forgot Template function
function format_email_forgot($user, $url, $email, $key, $format){

	//set the root
	$root = INIT_DIR;

	//grab the template content
	$template = file_get_contents($root.'/includes/emails/email_forgot_html.'.$format);
			
	//replace all the tags
	$template = ereg_replace('{USERNAME}', $user, $template);
	$template = ereg_replace('{URL}', $url, $template);
	$template = ereg_replace('{EMAIL}', $email, $template);
	$template = ereg_replace('{KEY}', $key, $template);
	$template = ereg_replace('{SITEPATH}',INIT_DIR, $template);
	$template = ereg_replace('{COPY}',COPY, $template);
		
	//return the html of the template
	return $template;

}


//empty avatar
function empty_avatar($avatar_row) {
	if($avatar_row=="") {
		$avatar_d=$admin_img_dir."/images/avatar_default.jpg";
	} else {
		$avatar_d=$admin_img_dir."/images/avatar/".$avatar_row;
	}
	return $avatar_d;
}

//Login attempts
function checkIP($ip, $gt) {
	$database = new Database();
	$sql="SELECT * FROM LoginAttempts WHERE ip=:ip";
	$database->query($sql); 
	$database->bind(':ip', $ip);
	$row = $database->single();
	$count=$database->rowCount();
	
	//IP has less than 3 attempts
	if($count<4) {
		return true;
	//mas de 3 intentos	
	} else {
		return false;
	}
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function getDefaultLanguage() {
   if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
      $ln=explode("-",$_SERVER["HTTP_ACCEPT_LANGUAGE"]);
	  $ln=strtolower($ln[0]);
	  $ln=split(",",$ln);
	  return $ln[0];
   } else {
      return "es";
   }
}

function setURL($var, $value) {
	$params = array_merge($_GET, array($var => $value));
	$new_query_string = http_build_query($params);
	return $new_query_string;
	//setURL("algo","test");
}

function multidimensional_search($parents, $searched) { 
  if (empty($searched) || empty($parents)) { 
	return false; 
  } 

  foreach ($parents as $key => $value) { 
	$exists = true; 
	foreach ($searched as $skey => $svalue) { 
	  $exists = ($exists && IsSet($parents[$key][$skey]) && $parents[$key][$skey] == $svalue); 
	} 
	if($exists){ return $key; } 
  } 

  return false; 
}  

function create_form($forma, $fields) {
	//forma: action, method, enctype, edit, array(edit_name, edit_id), submit
	//fields: type, label, icon, required, name, value, placeholder, disabled, data_values(drop, check, radio), editor
	  
	//start
	if($forma['enctype']==1) {
		$enctype='enctype="multipart/form-data"';
	}
	if($forma['edit']==1) {
		foreach($forma['edit_values'] as $key => $hidden) {
			$edit.='<input type="hidden" name="'.$hidden['name'].'" id="'.$hidden['name'].'" value="'.$hidden['value'].'">';
		}
	}
	if($forma['color']=="") {
		$boton_color="green";
	} else {
		$boton_color=$forma['color'];
	}
	
	$forma_html='<form role="form" id="'.$forma['id'].'" action="'.$forma['action'].'" method="'.$forma['method'].'" '.$enctype.'>
		<div class="form-body">';
	
	//loop :)
	foreach($fields as &$field) {
		//set defaults
		if ($field['type']=="") { $field['type']="text"; }
		if ($field['icon']=="") { $field['icon']="fa-cogs"; }
		if($field['required']==1) { $required='<i class="fa fa-exclamation tooltips" data-original-title="Informaci&oacute;n requerida." data-container="body"></i>'; } else { $required =""; }
		if($field['disabled']==1) { $disabled='disabled'; } else { $disabled =""; }
		if($field['editor']==1) { $editor='ckeditor'; } else { $editor =""; }	
		
		/*Type*/
		//text
		if($field['type']=="text") {
			$forma_html.='<div class="form-group"> 
				<label>'.$field['label'].'</label>
				<div class="input-group input-icon right">
					<span class="input-group-addon">
					<i class="fa '.$field['icon'].'"></i>
					</span>
					'.$required.'
					<input id="'.$field['name'].'" class="input-error form-control" type="'.$field['type'].'" placeholder="'.$field['placeholder'].'" name="'.$field['name'].'" value="'.$field['value'].'" '.$disabled.'>
				</div>
			</div>';
		//email
		} else if($field['type']=="email") {
			$forma_html.='<div class="form-group"> 
				<label>'.$field['label'].'</label>
				<div class="input-group input-icon right">
					<span class="input-group-addon">
					<i class="fa '.$field['icon'].'"></i>
					</span>
					'.$required.'
					<input id="'.$field['name'].'" class="input-error form-control" type="'.$field['type'].'" placeholder="'.$field['placeholder'].'" name="'.$field['name'].'" value="'.$field['value'].'" '.$disabled.'>
				</div>
			</div>';
		//passwd
		} else if($field['type']=="password") {
			$forma_html.='<div class="form-group"> 
				<label>'.$field['label'].'</label>
				<div class="input-group input-icon right">
					<span class="input-group-addon">
					<i class="fa '.$field['icon'].'"></i>
					</span>
					'.$required.'
					<input id="'.$field['name'].'" class="input-error form-control" type="'.$field['type'].'" placeholder="'.$field['placeholder'].'" name="'.$field['name'].'" value="'.$field['value'].'" '.$disabled.'>
				</div>
			</div>';
		//textarea
		} else if($field['type']=="textarea") {
			$forma_html.='<div class="form-group">
				<label>'.$field['label'].'</label>
				<textarea name="'.$field['name'].'" id="'.$field['name'].'" placeholder="'.$field['placeholder'].'" class="form-control '.$editor.'" rows="3" '.$disabled.'>'.$field['value'].'</textarea>
			</div>';
		//dropdown
		} else if($field['type']=="dropdown") {
			$forma_html.='<div class="form-group">
				<label>'.$field['label'].'</label>
				<select name="'.$field['name'].'" id="'.$field['name'].'" class="form-control" '.$disabled.'>';
				foreach($field['data_values'] as $key => $index) {
					//static method
					if($field['value']!="") {
						if($index['value']==$field['value']) { $checked='selected="selected"'; } else { $checked=""; }
					} else {
						if($index['checked']==1) { $checked='selected="selected"'; } else { $checked=""; }
					}
					$forma_html.= '<option '.$checked.' value="'.$index['value'].'">'.$index['option'].'</option>';
				}
			$forma_html.='	</select>
			</div>';
		//checkboxes
		} else if($field['type']=="checkbox") {
			$forma_html.= '<div class="form-group">
				<label>'.$field['label'].'</label>
				<div class="checkbox-list">'; 
				foreach($field['data_values'] as $key => $index) {
					if($index['checked']==1) { $checked="checked"; } else { $checked=""; }
					$forma_html.= '<label>
						<input type="checkbox" name="'.$field['name'].'" id="'.$field['name'].'_'.$index['value'].'" value="'.$index['value'].'" '.$disabled.' '.$checked.'> '.$index['option'].' 
					</label>';
				}
			$forma_html.=	'</div>
			</div>';
		//radios
		} else if($field['type']=="radio") {
			$forma_html.= '<div class="form-group">
				<label>'.$field['label'].'</label>
				<div class="radio-list">';
				foreach($field['data_values'] as $key => $index) {
					if($index['checked']==1) { $checked="checked"; } else { $checked=""; }
					$forma_html.= '<label>
						<input type="radio" name="'.$field['name'].'" id="'.$field['name'].'_'.$index['value'].'" value="'.$index['value'].'" '.$disabled.' '.$checked.'> '.$index['option'].' 
					</label>';
				}
			$forma_html.='</div>
			</div>';
		//file
		} else if($field['type']=="file") {
			$forma_html.= '<div class="form-group">
				<label>'.$field['label'].'</label>
				<div class="input-group input-icon right">
					<span class="input-group-addon">
					<i class="fa '.$field['icon'].'"></i>
					</span>
					'.$required.'
					<input id="'.$field['name'].'" name="'.$field['name'].'" class="input-error form-control" type="'.$field['type'].'" '.$disabled.'>
				</div>
			</div>';
		//hidden
		} else if($field['type']=="hidden") {
			$forma_html.= '<div class="form-group">
				<input id="'.$field['name'].'" name="'.$field['name'].'" class="input-error form-control" type="'.$field['type'].'">
			</div>';
		}
	}
	
	//end
	$forma_html.='</div>
		<div class="form-actions">
			'.$edit.'
			<button type="submit" class="btn '.$boton_color.'">'.$forma['submit'].'</button>
		</div>
	</form>';	
	return $forma_html;
	
	/***
	//change checked status manually
	$clave=multidimensional_search($fields, array('name'=>$field['name']));
	$subclave=multidimensional_search($fields[$clave]["data_values"], array('value'=>$row['user_level']));
	$fields[$clave]["data_values"][$subclave]["checked"]=1;	
	***/
}

//alertas
function crear_alerta($tipo, $mensaje) {
	if($tipo=="error") {
		$alerta ='<div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
			'.$mensaje.'
		</div>';
	} else if($tipo=="warning") {
		$alerta ='<div class="alert alert-warning">
			<button class="close" data-close="alert"></button>
			'.$mensaje.'
		</div>';
	} else if($tipo=="success") {
		$alerta ='<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
			'.$mensaje.'
		</div>';
	}
	//echo crear_alerta("error", "Error al procesar el archivo");
	return $alerta;
}

//MYSQL date fix $format = 'Y-m-d H:i:s';
function mysql_date_to_php($format, $mysql_date) {
	if($format=="") { $format='Y-m-d H:i:s'; }
	$phpdate = strtotime( $mysql_date );
	$fixeddate = date( $format, $phpdate );
	
	return $fixeddate;
}

//Thumb No crop
/*
$image_name - Name of the image which is uploaded
$new_width - Width of the resized photo (maximum)
$new_height - Height of the resized photo (maximum)
$uploadDir - Directory of the original image
$moveToDir - Directory to save the resized image
*/

function createThumbnail($image_name,$new_width,$new_height,$uploadDir,$moveToDir) {
    $path = $uploadDir . '/' . $image_name;

    $mime = getimagesize($path);

    if($mime['mime']=='image/png'){ $src_img = imagecreatefrompng($path); $ext=".png";}
    if($mime['mime']=='image/jpg'){ $src_img = imagecreatefromjpeg($path); $ext=".jpg";}
    if($mime['mime']=='image/jpeg'){ $src_img = imagecreatefromjpeg($path); $ext=".jpg";}
    if($mime['mime']=='image/pjpeg'){ $src_img = imagecreatefromjpeg($path); $ext=".jpg";}

    $old_x          =   imageSX($src_img);
    $old_y          =   imageSY($src_img);

    if($old_x > $old_y) 
    {
        $thumb_w    =   $new_width;
        $thumb_h    =   $old_y*($new_height/$old_x);
    }

    if($old_x < $old_y) 
    {
        $thumb_w    =   $old_x*($new_width/$old_y);
        $thumb_h    =   $new_height;
    }

    if($old_x == $old_y) 
    {
        $thumb_w    =   $new_width;
        $thumb_h    =   $new_height;
    }

    $dst_img        =   ImageCreateTrueColor($thumb_w,$thumb_h);

    imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 


    // New save location
    $new_thumb_loc = $moveToDir . $image_name.$ext;

    if($mime['mime']=='image/png'){ $result = imagepng($dst_img,$new_thumb_loc,8); }
    if($mime['mime']=='image/jpg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
    if($mime['mime']=='image/jpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
    if($mime['mime']=='image/pjpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }

    imagedestroy($dst_img); 
    imagedestroy($src_img);
	unlink($path);

    return $result;
}
?>
