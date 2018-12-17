<?php 

require '../../config/config.php';
require '../../config/function.php';
require '../../class/database.php';
require '../../class/category.php';
require '../../class/customer_info.php';
require '../../class/customer_order.php';
//debugger($_POST,true);
$act = $_POST['act'];
if ($act == substr(md5('remove-all-order'), 3,15)) {
	$cust_info = new Customer_info();
	$deleteinfo = $cust_info->deleteCustomerInfo($_POST['customer_id']);
	if ($deleteinfo) {
		$cust_order = new Customer_order();
		$deleteorder = $cust_order->deleteCustomerOrderByCId($_POST['customer_id']);
		if ($deleteorder) {
			echo 3;
			exit;
		}
		echo 2;
		exit;
	}
	echo 1;
	exit;
}



if ($act = substr(md5('deliverd-this-order'), 3,15)) {
	$cust_order = new Customer_order();
	//$order_info = $cust_order->getOrder($_POST['order_id']);
	$data = array();
	$data['status'] = 0;
	$order_info = $cust_order->updateOrder($data,$_POST['order_id']);
	if ($order_info) {
		echo 7;
		exit;
	}
	echo 8;
	exit;

}

if ($act =  substr(md5('remove-this-order'), 3,15)) {
	$cust_order = new Customer_order();
		$deleteorder = $cust_order->deleteCustomerOrderById($_POST['order_id']);
		//debugger($deleteorder,true);
		if ($deleteorder) {
			echo 4;
			exit;
		}
		echo 5;
		exit;
}

else{
	echo 0;
	exit;
}

 ?>