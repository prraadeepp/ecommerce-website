<?php 

require '../../config/config.php';
require '../../config/function.php';
require '../../class/database.php';
require '../../class/category.php';
require '../../class/customer_order.php';

$cat_obj = new Category();
$act = (isset($_REQUEST['act'])) ? addSlash($_REQUEST['act']) : null;

 if (isset($act) && $act == substr(md5('get-child-cat-'.$_SESSION['session_id']), 5,15)) {
	$cat_id = (int)$_POST['category_id'];
	$child_category = $cat_obj-> getChildByParentId($cat_id);
	if ($child_category != null) {
		echo json_encode($child_category);
		exit;
	}else{
		echo "0";
		exit;
	}

}

else if ($act =  substr(md5('remove-this-order'), 3,15)) {
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
	echo "0";
	exit;
}


 ?>