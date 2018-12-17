

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="keywords" content="<?php echo KEYWORDS;?>">
	<meta name="description" content="<?php echo DESCRIPTION;?>">
	<meta name="author" content="<?php echo DESCRIPTION;?>">

	<title><?php echo (isset($current_page)) ? ucfirst($current_page) : SITE_TITLE; ?></title>
	
	<meta name="og:title" content="<?php echo (isset($current_page)) ? ucfirst($current_page) : SITE_TITLE;?>">
	<meta name="og:url" content="<?php echo getCurrentPageUrl();?>">
	<meta name="og:image" content="<?php echo (isset($_og_image)) ? $_og_image : FRONT_ASSETS.'img/logo.png';?>">
	<meta name="og:description" content="<?php echo (isset($_og_description)) ? $_og_description : DESCRIPTION; ?>">

	

	<!-- Google font -->
	<link href="<?php echo FORM_CSS; ?>css/fonts_googleapis.css" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS;?>bootstrap.min.css" />
	

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS;?>slick.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS;?>slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS;?>nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="<?php echo FRONT_CSS;?>font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS;?>style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <scrisrc="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="<?php echo FRONT_JS;?>jquery.min.js"></script>
</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<span>Welcome to OnlineShop.com  </span>
				</div>
				<div class="pull-right">
					<?php echo date('dS \of F, Y'); ?>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="#">
							<img src="<?php echo FRONT_IMAGES;?>logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form method="get" action="search">
							<input class="input search-input" name="keyword" type="text" placeholder="Enter your keyword">
							<select class="input search-categories" name="cat_id">
								<option value="0">All Categories</option>
								<?php 
									if(isset($parent_cats) && !empty($parent_cats)){
										foreach($parent_cats as $parents){
									?>
									<option value="<?php echo $parents->id;?>"><?php echo $parents->title; ?></option>
									<?php
										}
									}
								?>
							</select>
							<input type="number" name="min_price" placeholder="Min Price Here(NPR.)">
							<input type="number" name="max-price" placeholder="Max Price Here(NPR.)">
							<button class="search-btn"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
							</div>
							<?php 
								if(isset($_SESSION['customer'])){
							?>
							<a href="logout" class="text-uppercase">Logout</a>
							<?php } else { ?>
							<a href="form/login-register.php" class="text-uppercase">Login</a> 
							/ 
							<a href="form/login-register.php" class="text-uppercase">Join</a>

							<?php } ?>
							<ul class="custom-menu">
								<?php 
									if(isset($_SESSION['customer'])){
								?>
								<li><?php echo $_SESSION['customer']; ?></li>
								<li><a  href="order"><i class="fa fa-user-o"></i> My Orders</a></li>
								<li><a href="wishlist"><i class="fa fa-heart-o"></i> My Wishlist</a></li><li><a href="" data-toggle="modal" data-target="#banner_add_modal"><i class="fa fa-cog"></i> Edit Account</a></li>
								<li><a href="checkout"><i class="fa fa-check"></i> Checkout</a></li>
								<li><a href="logout"><i class="fa fa-power-off"></i> Logout</a></li>
								<?php } else { ?>
								<li><a href="form/login-register.php"><i class="fa fa-unlock-alt"></i> Login</a></li>
								<li><a href="form/login-register.php"><i class="fa fa-user-plus"></i> Create Account</a></li>
								<?php } ?>
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">

							<?php 
								$total_quantity = 0;
								$total_amount = 0;
								if(isset($_SESSION['__cart']) && !empty($_SESSION['__cart'])){
									foreach($_SESSION['__cart'] as $cart_item){
										$total_quantity += $cart_item['quantity'];
										$total_amount += $cart_item['amount'];
									}
								}
							?>
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty" id="total_qty"><?php echo $total_quantity; ?></span>
								</div>
								<strong class="text-uppercase">My Cart:</strong>
								<br>
								<span id="total_amount"><?php echo $total_amount; ?></span>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<?php if(isset($_SESSION['__cart']) && !empty($_SESSION['__cart'])){
									?>
									<div class="shopping-cart-list">
										<?php foreach($_SESSION['__cart'] as $key => $cart_product){ ?>
										
										
										<div class="product product-widget">
											<div class="product-thumb">
												<?php 
													if($cart_product['image'] != "" && file_exists(UPLOAD_DIR.'/product/'.$cart_product['image'])){
														$thumbnail = UPLOAD_URL.'product/'.$cart_product['image'];
													} else {
														$thumbnail = FRONT_IMAGES.'no-image.png';
													}
												?>
												<img src="<?php echo $thumbnail;?>" alt="<?php echo $cart_product['title']; ?>">
											</div>
											<div class="product-body">
												<h3 class="product-price">NPR.<?php echo $cart_product['amount']; ?> <span class="qty">x<?php echo $cart_product['quantity'];?></span></h3>
												<h2 class="product-name"><a href="detail?id=<?php echo $cart_product['id']; ?>"><?php echo $cart_product['title']; ?></a></h2>
											</div>
											<button class="cancel-btn" onclick="deleteCartItem(<?php echo $key;?>);"><i class="fa fa-trash"></i></button>
										</div>
										<?php } ?>
									</div>
									
									<div class="shopping-cart-btns">
										<a href="viewcart" class="main-btn">View Cart</a>
										<a href="checkout" class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									</div>
									<?php
									} else {
										echo "No items added.";
									} ?>
								</div>
							</div>
						</li>
						<!-- /Cart -->

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav <?php echo ($current_page != 'index') ? 'show-on-click' : '' ?>">
					<span class="category-header">Categories <i class="fa fa-list"></i></span>
					<ul class="category-list">
						
						<?php 
						if(isset($parent_cats) && !empty($parent_cats)){
							foreach ($parent_cats as $parents ) {
								$child_cats = $category->getChildByParentId($parents->id);
								if ($child_cats) {
									?>
									<li class="dropdown side-dropdown">
											<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
												<?php echo stripslashes($parents->title); ?><i class="fa fa-angle-right"></i>
											</a>
											<div class="custom-menu">
												<div class="row">
													<div class="col-md-12">
														<ul class="list-links">
															<?php 
															foreach ($child_cats as $children) {
																?>
																<li>
																	<a href="category?child_id=<?php echo $children->id; ?>">
																		<?php echo stripcslashes($children->title); ?>
																	</a>
																</li>

																<?php 
															}
															 ?>
														</ul>
													</div>
												</div>
												<?php 
												if (isset($parents->featured_image) && $parents->featured_image != "" && file_exists(UPLOAD_DIR.'/category/'.$parents->featured_image))  {
													?>
													<div class="row hidden-sm hidden-xs">
														<div class="col-md-12">
															<hr>
															<a class="banner banner-1" href="category?cid=<?php echo $parents->id; ?>">
																<img src="<?php echo UPLOAD_URL.'category/'.$parents->featured_image; ?>" alt="">
															</a>
														</div>
													</div>


													<?php  
												}
												 ?>
											</div>


									</li>

									<?php
								}else{
									?>
									<li><a href="category?cid=<?php echo $parents->id; ?>"> <?php echo stripcslashes($parents->title); ?></a></li>
									<?php 
								}
							}
						}
						 ?>
						

						
					</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						<li><a href="./">Home</a></li>
						<li><a href="about">About Us</a></li>
						<li><a href="contact-us">Contact Us</a></li>
						<li><a href="search">Shop</a></li>
					</ul>
				</div> 
			</div>
		</div>
		<!-- /container -->
	</div>