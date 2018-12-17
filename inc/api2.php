<?php 
require '../config/config.php';
require '../config/function.php';
require '../class/database.php';
require '../class/wishlist.php';
require '../class/product.php';
//debugger($_POST,true);
$wishlist = new Wishlist();

$act = (isset($_REQUEST['act'])) ? addSlash($_REQUEST['act']) : null;

if ($act == substr(md5('delete-from-wishlist'), 3,15)) {
	$list = $wishlist->getWishlist($_SESSION['login_id']);
			$p_id =$list[0]->product_id;
		    $pro_id = explode(',', $p_id);
		   // debugger($pro_id,true);
		    foreach ($pro_id as $key => $id) {
				if($id == $_POST['product_id']){
					$key_id = $key;
					break;
				}				
			    }

			   array_splice($pro_id,$key_id,1);
			  // $new_array = unset($pro_id[$key_id]);
			  // debugger($pro_id,true);
			   $data = array();
			   $data['product_id'] = implode(',', $pro_id);
			   if (!empty($data)) {
			   	$wishlist->updateWishlist($data,$_SESSION['login_id']);
			   if($wishlist){
						echo "Removed form the  wishlist.";
					 	exit;
					}
			   }else{
			   	exit;
			   }
        	
		

}

else{
	echo "0";
	exit;
}


 ?>