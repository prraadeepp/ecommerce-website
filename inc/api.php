<?php 

require '../config/config.php';
require '../config/function.php';
require '../class/database.php';
require '../class/wishlist.php';
require '../class/product.php';
//debugger($_POST,true);
$wishlist = new Wishlist();
//$list = $wishlist->getWishlist($_POST['customer_id']);
//debugger($pro_id);

//echo $present;
//exit;
$product = new Product();
$act = (isset($_REQUEST['act'])) ? addSlash($_REQUEST['act']) : null;



if($act == substr(md5('add-to-cart'),3,15)){
	/*Cart add */
	$product_id = (int)$_POST['product_id'];
	$product_info = $product->getProductById($product_id);

	$cart = array();

	if(isset($_SESSION['__cart'])){
		$cart  = $_SESSION['__cart'];
	}

	$current_item = array();
	$current_item['title'] = $product_info[0]->title;
	$current_item['id'] = $product_info[0]->id;
	$current_item['image'] = $product_info[0]->images;
	$amount = ($product_info[0]->price)-(($product_info[0]->price*$product_info[0]->discount)/100);

	$current_item['price'] = $amount;
	$qty = 1;
	if (isset($_POST['quantity'])) {
		$qty = $_POST['quantity'];
	}
	
	

	if(!empty($cart)){
		$search_result = searchArray($cart, 'id', $product_id);
		$index = 0;
		if($search_result){
			foreach($cart as $key=>$value){
				if($value['id'] == $product_id){
					$index = $key;
					break;
				}
			}

			$cart[$index]['quantity'] += $qty;
			$cart[$index]['amount'] += $amount*$qty;
		} else {
			$current_item['amount'] = $amount*$qty;
			$current_item['quantity'] = $qty;
			$cart[] = $current_item;
		}
	} else {
		$current_item['amount'] = $amount*$qty;
		$current_item['quantity'] = $qty;
		$cart[] = $current_item;
	}
	
	$_SESSION['__cart'] = $cart;
	echo "1";
	exit;
} 

if ($act == substr(md5('delete-from-cart'), 3,15)) {
	$cart_index = (int)$_POST['cart_index'];
	if ($_SESSION['__cart'] !="") {
		$cart = $_SESSION['__cart'];
		if (isset($cart[$cart_index])) {
			unset($cart[$cart_index]);
			$_SESSION['__cart'] = $cart;

			echo "1";
			exit;
		}else{
			echo "0";
			exit();
		}
	}else{
			echo "0";
			exit;
		}
	
}
if($act == "change_quantity"){
	$index = 0;
	$price = $_POST['price'];
	$id = $_POST['id'];
	$quantity = $_POST['quantity'];
	$amount = $_POST['new_amt'];
$cart = $_SESSION['__cart'];
	foreach($cart as $key=>$value){
				if($value['id'] == $id){
					$index = $key;
					break;
				}
			}
			$cart[$index]['quantity'] = $quantity+1;
			$cart[$index]['amount'] = $amount+$price;
			$_SESSION['__cart'] = $cart;
	echo "1";
	exit;
}



if ($act = substr(md5('add-to-wishlist'), 3,15)) {
	if (isset($_SESSION['customer'])) {
		$list = $wishlist->getWishlist($_SESSION['login_id']);
		$present = false;
		if (!empty($list)) {
			$p_id =$list[0]->product_id;
		    $pro_id = explode(',', $p_id);
		    foreach ($pro_id as $key => $id) {
				if($id == $_POST['product_id']){
					$present = $id;
					break;
				}				
			    }
        	}
		
		if ($present) {
			echo "Already added to your wishlist.";
			exit;
		}else{
			$data = array();
			$data['customer_id'] = $_SESSION['login_id'];
			if (!empty($list[0]->product_id)) {
				$data['product_id'] = $list[0]->product_id.",".$_POST['product_id'];
				$wish = $wishlist->updateWishlist($data,$_SESSION['login_id']);
			}else if(!empty($list)){
				$data['product_id'] = $_POST['product_id'];
				$wish = $wishlist->updateWishlist($data,$_SESSION['login_id']);
			}else{
				$data['product_id'] = $_POST['product_id'];
				$wish = $wishlist->addWishlist($data);
			}
		
		
		
		
		if ($wish) {
			echo "Added to your wishlist.";
		}else{
			echo "Unable to add to your wishlist.";
		}
		exit;
		}
		
	}else{
		echo "You need to login!";
		exit;
	}
}

else{
	echo "0";
	exit;
}







 ?>