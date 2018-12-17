<?php 
 
 ob_start();
 session_start();
 //PRODUCTION
 define('ENVIRONMENT','DEVELOPMENT');
 if(ENVIRONMENT=="DEVELOPMENT"){
 	error_reporting(E_ALL);
 	define('SITE_URL','http://localhost/onlineshop/');
 //	if ($_SERVER['SERVER_NAME'] == "localhost") {
 		 	define('UPLOAD_DIR',$_SERVER['DOCUMENT_ROOT'].'/onlineshop/upload');

 //	}else{
 //		 		 	define('UPLOAD_DIR',$_SERVER['DOCUMENT_ROOT'].'/upload');

 	
 	define('DB_HOST','localhost');
 	define('DB_USER','root');
 	define('DB_PWD','');
 	define('DB_NAME', 'ecommerce_800');
 	}else{
 		error_reporting(0);
 		define('SITE_URL', 'http://onlineshoping.com/');
 		define('UPLOAD_DIR',$_SERVER['DOCUMENT_ROOT'].'/upload');
 		define('DB_HOST', 'localhost');
 		define('DB_USER', 'root');
 		define('DB_PWD','');
 		define('DB_NAME', 'ecommerce_800');
 	}
 	//Admin constants
 	
 	define('FORM_CSS',SITE_URL.'form/');
 	define('CMS_URL',SITE_URL.'cms/');
 	define('CMS_ASSETS', CMS_URL.'assets/');
 	define('CMS_TINYMCE',CMS_ASSETS.'tinymce/');
 	define('CMS_JS', CMS_ASSETS.'js/');
 	define('CMS_CSS', CMS_ASSETS.'css/');
 	define('CMS_IMAGES', CMS_ASSETS.'images/');
 	define('CMS_VENDORS', CMS_ASSETS.'vendors/');
	define('ADMIN_PAGE_TITLE','Ecommerce Admin');
	define('ALLOWED_EXTENSION',array('jpg','jpeg','png','gif','bmp'));
	define('UPLOAD_URL', SITE_URL.'upload/');

//Front Constants
 	define('FRONT_ASSETS', SITE_URL.'assets/');
 	define('FRONT_JS', FRONT_ASSETS.'js/');
 	define('FRONT_CSS', FRONT_ASSETS.'css/');
 	define('FRONT_IMAGES', FRONT_ASSETS.'img/');
 	define('SITE_TITLE', 'Online Shopping Ecommerce');
 	define('KEYWORDS', 'Online Shopping, Ecommerce, Nepali Ecommerce, Online, Shopping');
 	define('DESCRIPTION', "Online ecommerce website for Nepal.");


 ?>