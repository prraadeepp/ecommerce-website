<?php 

require 'config/config.php';
require 'config/function.php';
require 'class/database.php';
require 'class/login_register.php';

$pass = sha1($_POST['current_password']);
$l_info = new LoginRegister();
$log_info = $l_info->getLoginInfoByPass($pass); 
//debugger($log_info,true);
if (!empty($log_info)) {
	if($_SESSION['customer']==$log_info[0]->email){
		$data = array();

	if (!empty($_POST['first-name'])) {
		$data['first_name'] = addSlash($_POST['first-name']);
		}
	if (!empty($_POST['last-name'])) {
		$data['last_name'] = addSlash($_POST['last-name']);
	}
	if (!empty($_POST['email'])) {
		$data['email'] = addSlash($_POST['email']);
	}
	if (!empty($_POST['new-password'])) {
		$data['password'] = sha1($_POST['new-password']);
	}
     //debugger($data,true);
	$edit_account = $l_info->updateAccount($data,$log_info[0]->id);
	//debugger($edit_account,true);
	if ($edit_account) {
		$account_by_id = $l_info->getLoginInfoById($log_info[0]->id);
		unset($_SESSION['customer']);
		$_SESSION['customer'] = $account_by_id[0]->email;
		setFlash('success','Your account is changed.');
		@header('location:./');
		exit;
	}
	}else{
		setFlash('warning','Current password do not match with current email.');
		@header('location:./');
		exit;
	}
	
}else{
	setFlash('error','Password do not exits.');
	@header('location:./');
	exit;
}
 ?>
