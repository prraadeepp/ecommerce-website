<?php

function debugger($data, $is_die=false){
	echo "<pre style='color: #FF0000;'>";
	print_r($data);
	echo "</pre>";
	if($is_die){
		exit;
	}
}

function getCurrentPage(){
	$current_uri = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
	return $current_uri;
}

function getCurrentPageUrl(){
	$query_string = $_SERVER['QUERY_STRING'];

	$url = SITE_URL.getCurrentPage();
	if($query_string != ""){
		$url .= "?".$query_string;
	}
	return $url;
}

function setFlash($status, $message){
	  if (!isset($_SESSION)) {
	  	session_start();
	  }
	  $_SESSION[$status] = $message;
}
 
 function getFlash(){
 	if (isset($_SESSION['success']) && $_SESSION['success']!="") {
 		 echo '<p class="alert alert-success">' .$_SESSION['success'].'</p>';
 		 unset($_SESSION['success']);
 	}
 	if(isset($_SESSION['error']) && $_SESSION['error']!=""){
 		echo '<p class="alert alert-danger">'.$_SESSION['error'].'</p>';
 		unset ($_SESSION['error']);
 	}
 	if(isset($_SESSION['warning']) && $_SESSION['warning']!=""){
 		echo '<p class="alert alert-warning">'.$_SESSION['warning'].'</p>';
 		unset ($_SESSION['warning']);

 }

 		if(isset($_SESSION['info']) && $_SESSION['info']!=""){
 		echo '<p class="alert alert-info">'.$_SESSION['info'].'</p>';
 		unset ($_SESSION['info']);
 	}
 }

 function generateRandomString($length = 15){
 		$chars="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
 		$len=strlen($chars);
 		$rand="";
 		for($i=0; $i<$length; $i++){
 			$rand.=$chars[rand(0, $len-1)];
 		}
 		return $rand;


 }
 function addSlash($str){
 	$str = stripslashes($str);
 	$str = addslashes($str);
 	$str = htmlentities($str);
 	return $str;
 }
function sanitize($string){
 global $conn;
 return mysqli_real_escape_string($conn, $string);
}
 function uploadSingleImage($file, $path, $default_file = null){
 	if ($file['error'] == 0) {
 		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
 		if (in_array(strtolower($ext), ALLOWED_EXTENSION)) {
 			$destination = UPLOAD_DIR.'/'.$path;
 			if (!is_dir($destination)) {
 				mkdir($destination, '0777', true);
 			}
 			$filename=ucfirst($path).'-'.time().rand(0,999).'.'.$ext;
 			$success =move_uploaded_file($file['tmp_name'], $destination.'/'.$filename);
 			if($success){
 				if($default_file != null && file_exists($destination.'/'.$default_file)){
 					unlink($destination.'/'.$default_file);
 				}
 					return $filename;
 				}else{
 					return null;
 				}
 			}else{
 				return null;
 			}
 		}else{
 			return $default_file;
 		}
 	}
 function deleteImage($file_name, $location){
 	$f_name = explode(",", $file_name);
 	$success= false;
 	$i = 0;

 	while ($i < count($f_name)) {
 		$path = UPLOAD_DIR."/".$location."/".$f_name[$i];
 		
 	if (file_exists($path) && $path != "") {
 		$success = unlink($path);
 	}
 	
 		$i++;
 	}
 	return $success;
 	}

 function uploadMultipleFiles($files, $path,$default_file=null){
 	if (isset($files) && $files['error'][0] == 0) {
 		$upload_dir = UPLOAD_DIR."/".$path;
 		if (!is_dir($upload_dir)) {
 			mkdir($upload_dir, '0777', true);
 		}
 		$temp = array();
 		for ($i=0; $i <count($files['name']) ; $i++) { 
 			$ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
 			if (in_array(strtolower($ext), ALLOWED_EXTENSION)) {
 				$file_name = ucfirst($path)."-".time().rand(0, 999).".".$ext;
 				$success = move_uploaded_file($files['tmp_name'][$i], $upload_dir."/".$file_name);
 				if($success){
 					$temp[] = $file_name;
 				}
 			}
 		}
 		if ($default_file !="") {
 			$pre_files=explode(",", $default_file);
 		
 		if(file_exists($upload_dir.'/'.$pre_files[0])){
 		$i=0;
 		while($i<count($pre_files)){
 			$temp[]=$pre_files[$i];
 			$i++;
 		}
 		}}
 		return $temp;
 	}else{
 		return false;
 	}
 }
 
 function searchArray($array, $key, $value){
	$array_iteration = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));

	$output = array();

	foreach($array_iteration as $sub_array){
		$sub = $array_iteration->getSubIterator();
		if($sub[$key] == $value){
			$output[] = iterator_to_array($sub);
		}
	}

	return $output;
}



?>