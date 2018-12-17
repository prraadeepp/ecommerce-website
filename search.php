<?php include 'inc/top_header.php'; 
include_once 'class/product.php';
include_once 'class/category.php';
$product = new Product();

$_page_title = "Search Result";

$keyword = (isset($_GET['keyword'])) ? addSlash($_GET['keyword']) : null;
$cat_id = (isset($_GET['cat_id'])) ? (int)($_GET['cat_id']) : null;
$min_price =  (isset($_GET['min_price'])) ? (int)($_GET['min_price']) : null;
$max_price =  (isset($_GET['max_price'])) ? (int)($_GET['max_price']) : null;
$args = array(
				'keyword' 	=> $keyword,
				'cat_id'	=> $cat_id,
				'min_price' => $min_price,
				'max_price' => $max_price
			);
//$search_result = $product->getSearchedData($keyword, $cat_id);
$search_result = $product->getSearchedDataByArray($args);

//debugger($search_result);

?>
<?php include 'inc/header.php'; ?>
	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li class="active">Shop Now</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<?php 
								if($search_result){
									$counter = 1;
									foreach($search_result as $cat_product){
									?>
							<!-- Product Single -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb">
										<div class="product-label">
											<span>New</span>
											<span class="sale">-<?php echo $cat_product->discount; ?>%</span>
										</div>
										<a href="detail?id=<?php echo $cat_product->id; ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail view</a>
										<img style="width: 200px;" src="<?php echo UPLOAD_URL."product/".$cat_product->images;?>" alt="<?php echo $cat_product->title; ?>">
									</div>
									<div class="product-body">
										<h3 class="product-price">
											<?php 
												$price = $cat_product->price;
												$discount = $cat_product->discount;
												if($discount > 0){
													$price = $price-(($price*$discount)/100);
												}

												echo "NPR. ".$price;
												if($discount > 0){
													echo ' <del class="product-old-price">NPR. '.$cat_product->price.'</del>';
												}
											?>
										</h3>
										<div class="product-rating">
											<?php
											$class = "fa-star"; 
											for($i=0; $i<5; $i++){
												if($cat_product->rating <= $i){
													$class = "fa-star-o empty";
												}
												echo '<i class="fa '.$class.'"></i>';
											}
											 ?>
											

											
											
										</div>
										<h2 class="product-name"><a href="detail?id=<?php echo $cat_product->id; ?>"><?php echo $cat_product->title; ?></a></h2>
										<div class="product-btns">
											<button class="main-btn icon-btn" onclick="addToWishlist(<?php echo $cat_product->id;?>);"><i class="fa fa-heart"></i></button>
											
											<button class="primary-btn add-to-cart" onclick="addToCart(<?php echo $cat_product->id;?>);"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
								</div>
							</div>
							<!-- /Product Single -->

							<!-- Product Single -->
							
							<?php

							if($counter%4 == 0){
								echo '<div class="clearfix"></div>';
							}
							$counter++;
							 }
							 }else{
							 	echo "No product found.";
							 }
							 ?>

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
<?php include 'inc/footer.php';?>