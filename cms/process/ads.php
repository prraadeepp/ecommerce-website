<?php 

    require '../../config/config.php';
	require '../../config/function.php';
	require '../../class/database.php';
	require '../../class/ads.php';
	require '../inc/session.php';
	//debugger($_GET,true);
	//debugger($_POST);
	//debugger($_FILES,true);
	$ads = new Ads();
	//$ads_obj= $ads->addAds()
	if (isset($_POST) && !empty($_POST)) {
		$data=array();
		$data['title'] = $_POST['title'];
		$data['link'] = $_POST['link'];
		$data['status'] = $_POST['status'];
		
		

		if (isset($_POST['pre_date_from'])) {
			if (isset($_POST['date_from']) && !empty($_POST['date_from'])) {
				$data['date_from'] = $_POST['date_from'];
			}else{
				$data['date_from'] = $_POST['pre_date_from'];
			}
		}else{
			$data['date_from'] = $_POST['date_from'];	
		}

		if (isset($_POST['pre_date_to'])) {
			if (isset($_POST['date_to']) && !empty($_POST['date_to'])) {
				$data['date_to'] = $_POST['date_to'];
			}else{
				$data['date_to'] = $_POST['pre_date_to'];
			}
		}else{
			$data['date_to'] = $_POST['date_to'];	
		}


			
			$default_img = (isset($_POST['default_img']) && $_POST['default_img'] !="")? $_POST['default_img'] : null;
		//debugger($default_img,true);
		if($_FILES['ads_image']['error'] == 0){
		$data['image']= uploadSingleImage($_FILES['ads_image'], 'adv', $default_img);
	}
		$ads_id = (isset($_POST['ads_id']) && $_POST['ads_id'] != 0) ? $_POST['ads_id'] :null;
		if ($ads_id != null) {
			$act = "updat";
			
			$n_ads_id = $ads->updateAds($data, $ads_id);
		}else{
				$act = "add";
				$n_ads_id = $ads->addAds($data);
			}
			if($n_ads_id){
			setFlash('success', "Ads ".$act."ed successfully");
		}else{
			setFlash('error', "Sorry! There was problem while ".$act."ing Ads.");
		}
		@header('location: ../ads');
		exit;
	}
	elseif (isset($_GET['id'],$_GET['act']) && $_GET['id'] !="" &&$_GET['act'] !="") {
		if ($_GET['act'] == substr(md5($_SESSION['session_id'].'del_ads-'.$_GET['id']), 5,15)) {
		$id = (int)$_GET['id'];
		$ads_info = $ads-> getAdsById($id);
		if($ads_info){
			$del = $ads->deleteAds($id);
			if ($del) {
			setFlash('success',"Ads deleted successfully.");
			deleteImage($ads_info[0]->image,'ads');
		}else{
			setFlash('error',"Ads could not be deleted.");
		}
		@header('location:../ads');
		exit;

		}else{
			setFlash('warning',"Ads information not found.");
			@header('location:../ads');
			exit;
		}
		
		
		}else{
			setFlash('error','Invalid token defined.');
				@header('location: ../ads');
				exit();
			}
	}else{
		setFlash('error',"Unauthorized Access.");
		@header('location:../ads');
		exit;
	}

 ?>