<?php
    require '../../config/config.php';
	require '../../config/function.php';
	require '../../class/database.php';
	require '../../class/category.php';
	require '../inc/session.php';
	

	//debugger($_POST);
	//debugger($_FILES, true);
	$category = new Category();
	if (isset($_POST) && !empty($_POST)) {

		$data = array();
		$data['title'] = addSlash($_POST['title']);
		$data['summary'] = addSlash($_POST['summary']);
		$data['status'] = (int)($_POST['status']);
		$data['is_parent'] = (isset($_POST['is_parent']) && $_POST['is_parent'] == 1) ? 1 : 0 ;
		$data['parent_id'] = (isset($_POST['parent_id']) && $_POST['parent_id'] != 0) ? (int)$_POST['parent_id'] :0;
		$data['show_in_menu'] = (isset($_POST['show_in_menu']) && $_POST['show_in_menu'] == 1) ? 1: 0 ;
		$data['show_in_home_tab'] = (isset($_POST['show_in_home_tab']) && $_POST['show_in_home_tab'] == 1)? 1 : 0;
		$data['added_by'] = $_SESSION['user_id'];
		$default_file =(isset($_POST['default_img']) && $_POST['default_img'] !="") ? addSlash($_POST['default_img']) : null;
		$cat_id =(isset($_POST['category_id']) && $_POST['category_id'] !="") ? (int)$_POST['category_id'] : null;
		if($_FILES['featured_image']['error'] == 0){
		$data['featured_image'] = uploadSingleImage($_FILES['featured_image'], 'category', $default_file);		//debugger($data, true);
	}
   //debugger($data, true);
		if ($cat_id != null) {
			$act = "updat";
			$category_id = $category->updateCategory($data, $cat_id);
		}else{
			$act = "add";
			$category_id = $category->addCategory($data);
			//debugger($category_id);
		}
		if ($category_id) {
			setFlash('success','Category '.$act.'ed successfully.');
		}else{
			setFlash('error','Sorry! There was problem while '.$act.'ing category.');
		}
		@header('location: ../category');
		exit;
		}else if (isset($_GET['id'] , $_GET['act'])) {
			$id = (int)$_GET['id'];
			if ($_GET['act'] == substr(md5($_SESSION['session_id'].'del-cat-'.$id), 3, 15)) {
				$cate_info = $category->getCategoryById($id);
				if ($cate_info) {
					$del = $category->deleteCategory($id);
					if ($del) {
						if ($cate_info[0]->featured_image != "") {
							deleteImage($cate_info[0]->featured_image, 'category');
						}
					}setFlash('success','Category deleted successfully.');
					@header('location: ../category');
					exit;

				}else{
					setFlash('warning','Category not found.');
				@header('location: ../category');
					exit;
				}
			}else{
				setFlash('warning', 'Invalid Token.');
			@header('location: ../category');
					exit;
			}
		

	}else{
		setFlash('error', 'Unauthorized Access.');
		@header('location: ../category');
		exit();
	}










	?>