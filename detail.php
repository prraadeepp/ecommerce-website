<?php 
require 'inc/top_header.php';
require_once 'class/review_rating.php';
require_once 'class/product.php';

$p_id = (int)$_GET['id'];
//debugger($p_id);
$product = new Product();
$product_detail = $product->getProductByIdForDetail($p_id);
$category_id = $product_detail[0]->cat_id;
//debugger($product_detail[0]->cat_id,true);
$picked_product = $product->getProductByCatId($category_id, $p_id);
//debugger($product_detail);
$all_images =explode(',', $product_detail[0]->image);
//debugger($all_images[0]);
//debugger($all_images,true); 

require 'inc/header.php';

 ?>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li><a href="#">Products</a></li>
				<li><a href="#">Category</a></li>
				<li class="active"><?php echo $product_detail[0]->title; ?></li>
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
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view">
							<?php foreach ($all_images as $key => $img) {  ?>
							<div class="product-view">
								<img  height="600px" src="<?php echo UPLOAD_URL.'product/'.$img;?>" alt="$product_detail[0]->title;">
							</div>
							<?php } ?>
						</div>
						<div id="product-view">
							<?php foreach ($all_images as $key => $img) {
								
							 ?>
							<div class="product-view">
								<img onclick="<?php $image = $img; ?>" src="<?php echo UPLOAD_URL.'product/'.$img;?>" alt="$product_detail[0]->title;">
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-<?php echo $product_detail[0]->discount; ?>%</span>
							</div>
							<h2 class="product-name"><?php echo $product_detail[0]->title; ?></h2>
							<h3 class="product-price">
											<?php 
												$price = $product_detail[0]->price;
												$discount = $product_detail[0]->discount;
												if($discount > 0){
													$price = $price-(($price*$discount)/100);
												}

												echo "NPR. ".$price;
												if($discount > 0){
													echo ' <del class="product-old-price">NPR. '.$product_detail[0]->price.'</del>';
												}
											?>
										</h3>
							<div>
								<div class="product-rating">
									<?php
											$class = "fa-star"; 
											for($i=0; $i<5; $i++){
												if($product_detail[0]->rating <= $i){
													$class = "fa-star-o empty";
												}
												echo '<i class="fa '.$class.'"></i>';
											}
											 ?>
								</div>
								
							</div>
							<p><strong>Availability:</strong> <?php if($product_detail[0]->availability == 1){
								echo "Available";
							}elseif($product_detail[0]->availability == 2){
								echo "Stock not found";
							}else{
								echo "Unavailable";
							}
							?></p>
							<?php if (isset($product_detail[0]->brand)) {?>
								<p><strong>Brand:</strong> <?php echo stripcslashes($product_detail[0]->brand); ?></p>
						<?php	} ?>
							
							<p>
								<?php echo $product_detail[0]->summary;?>
							</p>
							<div class="product-options">
								<?php if (!empty($product_detail[0]->size)) { ?>
									
								<ul class="size-option">
									<li><span class="text-uppercase">Size:</span></li>
									<li class="active"><?php echo $product_detail[0]->size; ?></li>
									
								</ul>

								<?php } 
								 if (!empty($product_detail[0]->color)) {
								?>
								
								<ul class="color-option">
									<li><span class="text-uppercase">Color:</span></li>
									
									<li><?php echo $product_detail[0]->color; ?></li>
								</ul>
								<?php } ?>
							</div>

							<div class="product-btns">
								<div class="qty-input">
									<span class="text-uppercase">QTY: </span>
									<input class="input" id="qty" type="number">
									
								</div>
								<button class="primary-btn add-to-cart" onclick="addToCartWithImage(<?php echo "'".$p_id."', '".$image."'";?>);"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
								<div class="pull-right">
									<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
									
									<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab1">Details</a></li>
								<li><a data-toggle="tab" href="#tab2">Reviews</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<p><?php echo html_entity_decode($product_detail[0]->description); ?></p>
								</div>
								<div id="tab2" class="tab-pane fade in">

									<div class="row">
										<div class="col-md-6">
											<div class="product-reviews">
												
														<?php 
														$review = new ReviewRating();
														$data = $review->getReviewByProductId($p_id);
														if ($data) {
															foreach($data as $key => $reviews){ ?>

																<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> <?php echo $reviews->name; ?></a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> <?php echo $reviews->added_date; ?></a></div>
														<div class="review-rating pull-right">
															<?php 
															$class = "fa-star";
															for($i=0; $i<5; $i++){
																if($reviews->rating <= $i){
																	$class = "fa-star-o empty";
																}
																echo '<i class="fa '.$class.'"></i>';
															}
															
															 ?>
															
															
															
														</div>
													</div>
													<div class="review-body">
														<p><?php echo $reviews->review; ?></p>
													</div>
												</div>
														<?php
															} ?>

													<ul class="reviews-pages">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
												</ul>		
													<?php	}else{?>

														<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>

														<?php
													}
														 ?>
														

											<!--	

												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>
												-->
												
											</div>
										</div>
										<div class="col-md-6">
											
											<?php 
											if (isset($_SESSION['review']) && $_SESSION[
												'review'] == $p_id) {
													?>
												<h4><?php getFlash(); ?></h4>
												<?php
											}else{ ?>

												<h4><?php getFlash(); ?></h4>
											<h4 class="text-uppercase">Write Your Review</h4>
											<p>Your email address will not be published.</p>
											<form method="post" action="review_rating.php?p_id=<?php echo $p_id; ?>" class="review-form">
												<div class="form-group">
													<input class="input" name="name" type="text" placeholder="Your Name" />
												</div>
												<div class="form-group">
													<input class="input" name="email" type="email" placeholder="Email Address" />
												</div>
												<div class="form-group">
													<textarea class="input" name="review" placeholder="Your review"></textarea>
												</div>
												<div class="form-group">
													<div class="input-rating">
														<strong class="text-uppercase">Your Rating: </strong>
														<div class="stars">
															<input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
															<input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
															<input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
															<input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
															<input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
														</div>
													</div>
												</div>
												<button id="submit" class="primary-btn">Submit</button>
											</form>

												<?php
											}?>
											
										</div>
									</div>



								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Picked For You</h2>
					</div>
				</div>
				<!-- section title -->
				<?php 
				foreach($picked_product as $key => $p_product){

					?>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-<?php echo $p_product->discount; ?>%</span>
							</div>
							<a href="detail?id=<?php echo $p_product->id; ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail view
										</a>
										<?php 
											if($p_product->images != "" && file_exists(UPLOAD_DIR.'/product/'.$p_product->images)){
												$thumbnail = UPLOAD_URL.'product/'.$p_product->images;
											} else {
												$thumbnail = FRONT_IMAGES.'no-image.png';
											}
										?>
										<img src="<?php echo $thumbnail;?>" alt="<?php echo stripslashes($p_product->title); ?>" style="width: 200px">
						</div>
						<div class="product-body">
										<h3 class="product-price">
											<?php 
												$price = $p_product->price;
												$discount = $p_product->discount;
												if($discount > 0){
													$price = $price-(($price*$discount)/100);
												}

												echo "NPR. ".$price;
												if($discount > 0){
													echo ' <del class="product-old-price">NPR. '.$p_product->price.'</del>';
												}
											?>
										</h3>
										<div class="product-rating">
											<?php 
											$class = "fa-star";
											for($i=0; $i<5; $i++){
											if ($p_product->rating <= $i) {
														$class = "fa-star-o empty";
											}
										echo '<i class="fa '.$class.'"></i>';
											 
											}
											?>
										</div>

							
							<h2 class="product-name">
								<a href="detail?id=<?php echo $p_product->id; ?>">
									<?php echo stripslashes($p_product->title); ?>
								</a>
							</h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								
								<button class="primary-btn add-to-cart"  onclick="addToCart(<?php echo $p_product->id;?>);"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>

<?php
				}
				 ?>
				
				<!-- Product Single -->
				
				<!-- /Product Single -->

				<!-- Product Single -->
				
				<!-- /Product Single -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->


	<!-- FOOTER -->
<script type="text/javascript">
	
	
 /*$('#submit').click(function(e){
        e.preventDefault();

       var name = $('#name').val();
       var email = $('#email').val();
       var review = $('#review').val();
       var one = $('#star1').val();
       var two = $('#star2').val();
       var three = $('#star3').val();
       var four = $('#star4').val();
       var five = $('#star5').val();
      // console.log(five);
       console.log(four);
});
	*/

	function addToCartWithImage(pro_id, pro_image){
		
		var qty = $('#qty').val();	
	
		$.post('inc/api.php',{product_id:pro_id, quantity:qty, product_image:pro_image, act:"<?php echo substr(md5('add-to-cart'), 3,15); ?>"},function(res){

			if (res == 1) {
				alert('Cart Updated');
				document.location.href = document.location.href;
			}
		});
	}

</script>

<?php 
require 'inc/footer.php';
 ?>