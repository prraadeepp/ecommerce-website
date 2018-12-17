 <?php include 'inc/top_header.php'; 
require_once 'class/banner.php';
require_once 'class/product.php';
require_once 'class/ads.php';
$product = new Product();

$latest_product = $product->getLatestProduct();

/**/
$banner = new Banner();

$banner_info = $banner->getBannerForHome(5);

$ads = new Ads();
$ads_info = $ads->getAdsForHome(3);
//debugger($ads_info, true);

 include 'inc/header.php'; ?>	
	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div id="home-slick">
					<!-- banner -->
					<?php 
						if($banner_info){
							foreach($banner_info as $banner_data){
							?>
							<!-- banner -->
								<div class="banner banner-1">
									<img width="60%" height="400px" src="<?php echo UPLOAD_URL.'banner/'.$banner_data->image;?>" alt="<?php echo $banner_data->title;?>">
									<div class="banner-caption text-center">
										<h1><?php echo $banner_data->title;?></h3>
										<h3 class="white-color font-weak"><?php echo $banner_data->summary;?></h3>
										<?php 
											if($banner_data->link != ""){
										?>
										<a href="<?php echo $banner_data->link;?>" class="primary-btn">Shop Now</a>
										<?php
											}
										?>
									</div>
								</div>
								<!-- /banner -->

							<?php
							}
						}
					?>

				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->

<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
		<?php 
		if (isset($ads_info)) {
			foreach($ads_info as $ads){
				?>
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="<?php echo $ads->link; ?>">
						<img width="300px" height="200px" src="<?php echo UPLOAD_URL.'adv/'.$ads->image;?>" alt="<?php echo $ads->title; ?>">
						<div class="banner-caption text-center">
							<h3 class="white-color"><?php echo $ads->title; ?></h3>
							<h3>Click To Visit Now</h3>
						</div>
					</a>
				</div>
				<?php 
			}
		}
		 ?>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
</div> 

	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Latest Products</h2>
					</div>
				</div>
				<!-- section title -->
				<?php 
					if($latest_product){
						$counter = 1;

						foreach($latest_product as $product_info){
						?>
				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-<?php echo $product_info->discount; ?>%</span>
							</div>
							<a href="detail?id=<?php echo $product_info->id; ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail view
										</a>
										<?php 
											if($product_info->images != "" && file_exists(UPLOAD_DIR.'/product/'.$product_info->images)){
												$thumbnail = UPLOAD_URL.'product/'.$product_info->images;
											} else {
												$thumbnail = FRONT_IMAGES.'no-image.png';
											}
										?>
										<img src="<?php echo $thumbnail;?>" alt="<?php echo stripslashes($product_info->title); ?>" style="width: 200px">
						</div>
						<div class="product-body">
										<h3 class="product-price">
											<?php 
												$price = $product_info->price;
												$discount = $product_info->discount;
												if($discount > 0){
													$price = $price-(($price*$discount)/100);
												}

												echo "NPR. ".$price;
												if($discount > 0){
													echo ' <del class="product-old-price">NPR. '.$product_info->price.'</del>';
												}
											?>
										</h3>
										<div class="product-rating">
											<?php 
											$class = "fa-star";
											for($i=0; $i<5; $i++){
											if ($product_info->rating <= $i) {
														$class = "fa-star-o empty";
											}
										echo '<i class="fa '.$class.'"></i>';
											 
											}
											?>
										</div>

							
							<h2 class="product-name">
								<a href="detail?id=<?php echo $product_info->id; ?>">
									<?php echo stripslashes($product_info->title); ?>
								</a>
							</h2>
							<div class="product-btns">
								<button class="main-btn icon-btn" onclick="addToWishlist(<?php echo $product_info->id;?>);"><i class="fa fa-heart"></i></button>
								
								<button class="primary-btn add-to-cart"  onclick="addToCart(<?php echo $product_info->id;?>);"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Single -->
				<?php
							if($counter%4 == 0){
								echo '<div class="clearfix"></div>';
							}
							$counter++;
						}

					}	
				?>

			</div>
	
			<?php if (isset($_SESSION['customer']) && isset($_SESSION['gender'])) {
						if($_SESSION['gender'] == "M"){
						$c_id = 1;
						$gender_product = $product->getProductByCatIdonly($c_id);
					}else{
						$c_id = 2;
						$gender_product = $product->getProductByCatIdonly($c_id);
					}
					//debugger($gender_product,true);
					?>

			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Picked For You</h2>
					</div>
				</div>
				
				<?php 
				foreach($gender_product as $key => $gen_pro){ ?>

				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-<?php echo $gen_pro->discount; ?>%</span>
							</div>
							<a href="detail?id=<?php echo $gen_pro->id; ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail view
										</a>
										<?php 
											if($gen_pro->images != "" && file_exists(UPLOAD_DIR.'/product/'.$gen_pro->images)){
												$thumbnail = UPLOAD_URL.'product/'.$gen_pro->images;
											} else {
												$thumbnail = FRONT_ASSETS.'img/no-image.png';
											}
										?>
										<img src="<?php echo $thumbnail;?>" alt="<?php echo stripslashes($gen_pro->title); ?>" style="width: 200px">
						</div>
						<div class="product-body">
										<h3 class="product-price">
											<?php 
												$price = $gen_pro->price;
												$discount = $gen_pro->discount;
												if($discount > 0){
													$price = $price-(($price*$discount)/100);
												}

												echo "NPR. ".$price;
												if($discount > 0){
													echo ' <del class="product-old-price">NPR. '.$gen_pro->price.'</del>';
												}
											?>
										</h3>
										<div class="product-rating">
											<?php 
											$class = "fa-star";
											for($i=0; $i<5; $i++){
											if ($gen_pro->rating <= $i) {
														$class = "fa-star-o empty";
											}
										echo '<i class="fa '.$class.'"></i>';
											 
											}
											?>
										</div>

							
							<h2 class="product-name">
								<a href="detail?id=<?php echo $gen_pro->id; ?>">
									<?php echo stripslashes($gen_pro->title); ?>
								</a>
							</h2>
							<div class="product-btns">
								<button class="main-btn icon-btn" onclick="addToWishlist(<?php echo $gen_pro->id;?>);"><i class="fa fa-heart"></i></button>
								
								<button class="primary-btn add-to-cart"  onclick="addToCart(<?php echo $gen_pro->id;?>);"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>

				
			
				<?php
				}?>
				 </div>
				 <?php
				}
				?>
	
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- FOOTER -->
<?php include 'inc/footer.php'; ?>	