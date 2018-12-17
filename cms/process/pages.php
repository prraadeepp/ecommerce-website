<?php 
require '../../config/config.php';
	require '../../config/function.php';
	require '../../class/database.php';
	require '../../class/pages.php';
	require '../inc/session.php';
//debugger($_POST);
//debugger($_GET, true);
$pages = new Pages();
  if (isset($_POST) && !empty($_POST)) {
  	 $data=array();
  	 $data['title'] = addSlash($_POST['title']);
  	 $data['summary'] =addSlash( $_POST['summary']);
  	 $data['description'] =htmlentities(addSlash($_POST['description']));
  	 $data['status'] = (int)$_POST['status'];
  	 //$data['added_by'] = $_SESSION['user_id'];
  	 $default_img = (isset($_POST['default_img']) && $_POST['default_img'] !="") ? $_POST['default_img'] : null;
     if($_FILES['image']['error'] == 0){
  	 $data['image'] = uploadSingleImage($_FILES['image'], 'pages', $default_img);}
  	 $data_id = (isset($_POST['pages_id']) && $_POST['pages_id'] !="") ? $_POST['pages_id'] : null;
  	 if ($data_id !="") {
  	 	$act = 'updat';
  	 	$page_id = $pages-> updatePages($data, $data_id);
      //debugger($pages_id,true);
  	 }else{
  	 	$act = 'add';
      //debugger($data,true);
  	 	$page_id = $pages->addPages($data);
      //debugger($page_id, true);
  	 }
  	 if($page_id){
  	 	setFlash('success',"Page info ".$act."ed successfully.");
  	 	@header('location: ../pages');
  	 	exit;
  	 }else{
  	 	setFlash('error',"Page Info cannot be ".$act."ed.");
  	 	@header('location: ../pages');
  	 	exit;
  	 }







  }else if(isset($_GET['id'], $_GET['act']) && $_GET['id']!="" && $_GET['act'] !=""){
    if (isset($_GET['act']) == substr(md5($_SESSION['session_id'].'del_page-'.$_GET['id']), 5, 15)) {
      $id=(int)$_GET['id'];
      $page_info= $pages->getPageById($id);
      //debugger($banner_info, true);
      if ($page_info) {
        $del = $pages->deletePages($id);
        if ($del) {
          setFlash('success', "Page deleted successfully.");
          deleteImage($page_info[0]->image, 'pages');
          
        }else{
          setFlash('error', "Sorry! There was problem while deleting the page.");
        }
        @header('location: ../pages');
        exit();
      }else{
        setFlash('warning','Banner information not found.');
        @header('location: ../pages');
        exit();
      }
    }else{
      setFlash('error','Invalid token defined.');
        @header('location: ../pages');
        exit();
      }
  
  }else{
  	setFlash('error', 'Unauthorized Access.');
  	@header('location: ../pages');
  	exit();
  }






 ?>