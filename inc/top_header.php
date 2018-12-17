<?php 

	require_once 'config/config.php';
	require_once 'config/function.php';
	require_once 'class/database.php';
	require_once 'class/category.php';
	require_once 'class/login_register.php';
	//session_start();
	$login_in = new LoginRegister();
	if (isset($_SESSION['customer'])) {
		$login_in_fo = $login_in->getCustomerInfo($_SESSION['customer']);
	}
	
	//debugger($login_in_fo,true);
	$current_page = getCurrentPage();
//debugger($current_page);
//exit;
	$category = new Category();
	$parent_cats = $category->getAllParentCats();

 ?>