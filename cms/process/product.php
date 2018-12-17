<?php 
require '../../config/config.php';
	require '../../config/function.php';
	require '../../class/database.php';
	require '../inc/session.php';
	require '../../class/product.php';
	require '../../class/productImages.php';
	//debugger($_SESSION,true);
	//debugger($_GET,true);
	//debugger($_POST);
	//debugger($_FILES, true);
	$product = new Product();
	$product_image = new ProductImages();
	
	if (isset($_POST) && !empty($_POST)) {
		$data = array();
		$data['title']=addSlash($_POST['title']);
		$data['summary']=addSlash($_POST['summary']);
		$data['description']=addSlash($_POST['description']);
		$data['cat_id']=(int)$_POST['cat_id'];
		$data['child_cat_id']= isset($_POST['child_cat_id']) ? (int)$_POST['child_cat_id'] : 0;
		$data['price']=addSlash($_POST['price']);
		$data['discount']=addSlash($_POST['discount']);
		$data['brand']=addSlash($_POST['brand']);
		$data['availability']=addSlash($_POST['status']);
		$data['size']=addSlash($_POST['size']);
		$data['color']=addSlash($_POST['color']);
		$data['status']=addSlash($_POST['status']);
		$data['added_by']=$_SESSION['user_id'];
		$pro_id=(int)$_POST['pro_id'];
		$data['images'] = "";
		
		$default_file =(isset($_POST['default_img']) && $_POST['default_img'] !="") ? addSlash($_POST['default_img']) : "";
 
		//debugger($product_id,true);
		
			if(isset($_FILES['product_image']) && $_FILES['product_image']['error'][0] == 0){
				$images = uploadMultipleFiles($_FILES['product_image'], 'product',$default_file);
				//echo count($images);
				//debugger($images,true);
				$data['images'] = $images[0];//
				
				//debugger($data, true);
				
				//debugger($data,true);
				//for ($i=0; $i < ; $i++) { 
					# code...
				
				//$product_id = $product->addProduct($data);
				//debugger($data,true);
				//debugger($images[0],true);
				
		}else{
			$data['images'] = $default_file;
		}
		//debugger($data,true);
		if ($pro_id !=0 ){
         $act="updat";
         
         $product_id=$product->updateProduct($data,$pro_id);
         //
      }else{
         $act="add";
			$product_id = $product->addProduct($data);

		}
		if (!empty($images)) {
									$img = implode(',', $images);
									$temp_data = array();
									if($pro_id!=0){
									$product_image->deleteProductImages($pro_id);
								     
									$temp_data['product_id'] = $pro_id;
									}else{
										$temp_data['product_id'] = $product_id;
									}
										$temp_data['image'] = $img;
										$product_image -> addProductImages($temp_data);
									
												
			}
		if ($product_id) {
			setFlash("success", "Product ".$act."ed successfully.");
			@header('location: ../product');
			exit;
		}else{
			setFlash("error", "Sorry! There was problem while ".$act."ing product.");
			@header('location: ../product');
			exit;
		
}
	}elseif (isset($_GET['id'],$_GET['act']) && $_GET['id'] == !"" && $_GET['act'] == !"") {
	
		if ($_GET['act'] == substr(md5($_SESSION['session_id']."del-product".$_GET['id']), 5,15)) {
			$id = (int)$_GET['id'];
			$product_info = $product->getProductById($id);
			//debugger($product_info,true);
			if ($product_info) {
				$del = $product->deleteProduct($id);
				//debugger($del,true);
				if ($del) {
					if ($product_info[0]->images == !"") {
						$ddell=$product_image-> deleteProductImages($id);
					//debugger($ddell,true);
					

					$dI=deleteImage($product_info[0]->images,'product');
					//debugger($dI,true);
					}
					
					setFlash('success', "Product deleted successfully");
					@header('location:../product');
					exit;
				}else{
					setFlash('error', "Sorry! There was problem while deleting the product.");
					@header('location:../product');
					exit;
				}
			}else{
				setFlash('warning','Product information not found.');
				@header('location: ../product');
				exit();
			}
		}else{
			setFlash('error','Invalid token defined.');
			@header('location: ../product');
			exit;
		}
	
	}else{
		setFlash("error","Unauthorized access");
		@header('location: ../product');
		exit;
	}

 ?>