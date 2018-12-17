<?php 
include 'config/config.php';
 include 'config/function.php';
 include 'class/database.php';
 include 'class/login_register.php';
 include 'class/customer_info.php';
 include 'class/customer_order.php';
 //session_start();
//debugger($_SESSION['__cart']);
// debugger($_REQUEST,true);

$customer = new Customer_info();
$c_order = new Customer_order();
$c_login = new LoginRegister();
 if (isset($_POST) && !empty($_POST)) {

 	$data = array();
    $data['login_id'] = (int)$_SESSION['login_id'];
if (isset($_POST['password']) && isset($_POST['gender']) && isset($_POST['email'])) {
    $c_data = array();
    $c_data['first_name'] = addSlash($_POST['first-name']);
    $c_data['last_name'] = addSlash($_POST['last-name']);
    $c_data['email'] = addSlash($_POST['email']);
    $c_data['gender'] = addSlash($_POST['gender']);
    $c_data['password'] = sha1($_POST['password']);

    $customer_account = $c_login->addCustomer($c_data);
    if($customer_account){
     // $abc = $c_login->getCustomer($email);

      $data['login_id'] = $customer_account;
    }
}
if (!empty($data['login_id'])) {
  
  $data['email'] = addSlash($_POST['email']);
  $data['address'] = addSlash($_POST['address']);
  $data['city'] = addSlash($_POST['city']);
  $data['country'] = addSlash($_POST['country']);
  $data['zip_code'] = addSlash($_POST['zip-code']);
  $data['telephone'] = addSlash($_POST['tel']);
  //debugger($data,true);
  $c_id = $customer->addCustomerInfo($data);

}
 
 
  //debugger($c_id,true);
  //$_SESSION['info_id'] = $c_id;
  

  
  if($c_id){

  	foreach($_SESSION['__cart'] as $key =>  $order){
  	
   $o_data = array();
   $o_data['c_info_id'] = (int)$c_id;
   $o_data['product_name'] = addSlash($order['title']);
   $o_data['product_image'] = addSlash($order['image']);
   $o_data['product_price'] = addSlash($order['price']);
   $o_data['quantity'] = (int)$order['quantity'];
   $amt =  (int)$order['amount'];
   $o_data['total_amount'] = $amt;
   $o_data['payment'] = addSlash($_POST['payment']);
   $vat = 0.13;

   $amount = $amt + $vat*$amt; 

   $o_data['amount_with_VAT'] =$amount;


   //debugger($o_data,true);
   $o_id = $c_order -> addCustomerOrder($o_data);
  //debugger($o_id,true);
   }
   if ($customer_account !="" && $o_id !="") {
     setFlash('success',"Your order has been placed along with your new account.You will get your product soon.");
     unset($_SESSION['__cart']);
     @header('location:checkout.php');
     exit;
   }
   else if($o_id){
   	 setFlash('success','Your order is placed.You will get your product soon.');
   	 unset($_SESSION['__cart']);
   	 @header('location:checkout.php');
   	 exit;
   }else{
  	setFlash('error','Problem while placing order.');
  	@header('location:checkout.php');
  	exit;
  }
  }else{
  	setFlash('error','Problem while placing order.');
  	@header('location:checkout.php');
  	exit;
  }
  
   
 }else{
 setFlash('error','Unauthorized Access.');
 @header('location:checkout.php');
 exit;
 }
 
 ?>