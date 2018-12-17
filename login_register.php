<?php 
include 'config/config.php';
 include 'config/function.php';
 require 'class/database.php';
 include 'class/login_register.php';
//debugger($_GET);
//debugger($_POST, true);

 $customer = new LoginRegister();
 
 if (isset($_POST) && !empty($_POST)) {
 	if ($_GET['act'] == "register") {
 	$data = array();
  $email = addSlash($_POST['email_address']);
  //debugger($email, true);
  $c_info = $customer->getCustomerInfo($email);
  if(count($c_info) >= 1){
    setFlash('error','Email alreay exists.');
  }else{
 	$data['first_name'] = addSlash($_POST['first_name']);
 	$data['last_name'] = addSlash($_POST['last_name']);
 	$data['gender'] = addSlash($_POST['gender']);
 	$data['email'] = addSlash($_POST['email_address']);
 	$data['password'] = sha1($_POST['password']);

 	$c_id = $customer->addCustomer($data);
 	//debugger($c_id, true);
 	if ($c_id) {
 		setFlash('success','Your account has been registered. Now you can Login.');
 		

 		
 	}
 	else{
 		setFlash('error','Your account cannot be created.');
 	}
 	}
  @header('location:form/login-register.php');
 	exit;
 	}
 
 if ($_GET['act'] == "login") {
 	$email = addSlash($_POST['e_address']);
 	//debugger($email, true);
  $c_info = $customer->getCustomerInfo($email);

 //debugger($c_info, true);
  if ($c_info) {
    
  	if($c_info[0]->password == sha1($_POST['p_word'])){
  		$_SESSION['customer'] = $email;
      $_SESSION['gender'] = $c_info[0]->gender;
      $_SESSION['login_id'] = $c_info[0]->id;
  		@header('location:././');
  	}else{
  		setFlash('error','Passord does not match.');
  		@header('location:form/login-register.php');
  	
  	}
  }else{
  	setFlash('error','Email Address does not exist.');
 	@header('location:form/login-register.php');
  }

 
}
 	}
 	
 

 ?>