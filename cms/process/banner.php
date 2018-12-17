<?php 

	require '../../config/config.php';
	require '../../config/function.php';
	require '../../class/database.php';
	require '../../class/banner.php';
	require '../inc/session.php';

	$banner = new Banner();

	if (isset($_POST) && !empty($_POST)) {
		$data=array();
		$data['title']= addSlash($_POST['title']);
		$data['summary']=addSlash($_POST['summary']);
		$data['status']=(int)($_POST['status']);
		$data['link']=addSlash($_POST['link']);
		$data['added_by']= $_SESSION['user_id'];
		

		$default_img = (isset($_POST['default_img']) && $_POST['default_img'] !="")? $_POST['default_img'] : null;
		//debugger($default_img,true);
		if($_FILES['banner_image']['error'] == 0){
		$data['image']= uploadSingleImage($_FILES['banner_image'], 'banner', $default_img);
	}
		$bann_id = (isset($_POST['banner_id']) && $_POST['banner_id'] != 0) ? $_POST['banner_id'] :null;
		if ($bann_id != null) {
			$act = "updat";
			
			$banner_id = $banner->updateBanner($data, $bann_id);
		}else{
				$act = "add";
				$banner_id = $banner->addBanner($data);
			}
			if($banner_id){
			setFlash('success', "Banner ".$act."ed successfully");
		}else{
			setFlash('error', "Sorry! There was problem while ".$act."ing banner.");
		}
		@header('location: ../banner');
		exit;
	}else if(isset($_GET['id'], $_GET['act']) && $_GET['id']!="" && $_GET['act'] !=""){
		if (isset($_GET['act']) == substr(md5($_SESSION['session_id'].'del_banner-'.$_GET['id']), 5, 15)) {
			$id=(int)$_GET['id'];
			$banner_info= $banner->getBannerById($id);
			//debugger($banner_info, true);
			if ($banner_info) {
				$del = $banner->deleteBanner($id);
				if ($del) {
					setFlash('success', "Banner deleted successfully.");
					deleteImage($banner_info[0]->image, 'banner');
					
				}else{
					setFlash('error', "Sorry! There was problem while deleting banner.");
				}
				@header('location: ../banner');
				exit();
			}else{
				setFlash('warning','Banner information not found.');
				@header('location: ../banner');
				exit();
			}
		}else{
			setFlash('error','Invalid token defined.');
				@header('location: ../banner');
				exit();
			}
		}

	
	else{
		setFlash('error','Unauthorized access.');
		@header('location: ../banner');
		exit;
	}
 ?>