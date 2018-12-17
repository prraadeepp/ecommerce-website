<?php 
require 'inc/top_header.php';
require 'class/wishlist.php';
require 'class/product.php';
$wishlist = new Wishlist();
$product = new Product();


require 'inc/header.php'; ?>

	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li class="active">My Wishlist</li>
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
				if (isset($_SESSION['login_id'])) {
					$list = $wishlist->getWishlist($_SESSION['login_id']);
				}
				
				if (!empty($list[0]->product_id)) {
					$p_id =$list[0]->product_id;
					$pro_id = explode(',', $p_id); 
					$counter = 1;
					foreach($pro_id as $key => $id){
					$product_info = $product -> getProductById($id);
					//debugger($product_info,true);
					if ($product_info) {
						?>

							<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-<?php echo $product_info[0]->discount; ?>%</span>
							</div>
							<a href="detail?id=<?php echo $product_info[0]->id; ?>"  class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail view</a>
							<img style="width: 200px;" src="<?php echo UPLOAD_URL."product/".$product_info[0]->images;?>" alt="<?php echo $product_info[0]->title; ?>">
						</div>
						<div class="product-body">
							<h3 class="product-price">
											<?php 
												$price = $product_info[0]->price;
												$discount = $product_info[0]->discount;
												if($discount > 0){
													$price = $price-(($price*$discount)/100);
												}

												echo "NPR. ".$price;
												if($discount > 0){
													echo ' <del class="product-old-price">NPR. '.$product_info[0]->price.'</del>';
												}
											?>
										</h3>
							<div class="product-rating">
											<?php
											$class = "fa-star"; 
											for($i=0; $i<5; $i++){
												if($product_info[0]->rating <= $i){
													$class = "fa-star-o empty";
												}
												echo '<i class="fa '.$class.'"></i>';
											}
											 ?>
											</div>
							<h2 class="product-name"><a href="detail?id=<?php echo $product_info[0]->id; ?>"><?php echo $product_info[0]->title; ?></a></h2>
							<div class="product-btns">

											
											<button class="primary-btn add-to-cart" onclick="addToCart(<?php echo $product_info[0]->id;?>);"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
									<button onclick="deleteFromWishlist(<?php echo $product_info[0]->id;?>);" class="primary-btn"><i  class="fa fa-remove"></i></button>
							</div>
						</div>
					</div>
				</div>

						<?php

					}else{
						echo 'No items added to your wishlist.';
					}
					if($counter%4 == 0){
								echo '<div class="clearfix"></div>';
							}
							$counter++;
					}

				}else{
					echo 'No items added to your wishlist.';
				}
				?>

				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>

<?php 
require 'inc/footer.php';
?>