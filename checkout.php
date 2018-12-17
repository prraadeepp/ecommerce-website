<?php 

require "inc/top_header.php";
require 'inc/header.php';
//debugger($_SESSION,true);
 ?>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li class="active">Checkout</li>
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
 <?php getFlash(); ?>
				<?php 
				if(isset($_SESSION['__cart']) && !empty($_SESSION['__cart'])){
				?>

				<form method="post" action="checkout_process.php" id="checkout-form" class="clearfix">
					<div class="col-md-6">
						<div class="billing-details">
							<?php if (empty($_SESSION['customer'])) { ?>
								<p>Already a customer ? <a href="form/login-register.php">Login</a></p>
						<?php	} ?>
							
							<div class="section-title">
								<h3 class="title">Billing Details</h3>
							</div>
							
							<div class="form-group">
								<input class="input" required type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" required type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" required type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" required type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" required type="text" name="zip-code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" required type="tel" name="tel" placeholder="Telephone">
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="register">
									<label class="font-weak" for="register">Create Account?</label>
									<div class="caption">
										<p>If you don't have account,fill the bellow fields to create a new account.
											</p>
											<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name">
							</div>
							<div class="form-group">
											<input  type="radio" name="gender" value="M">Male
												<input type="radio" name="gender" value="F">Female
									</div><div class="form-group">
												<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div></div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="shiping-methods">
							<div class="section-title">
								<h4 class="title">Shiping Methods</h4>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="shipping" id="shipping-1" value="150" checked>
								<label for="shipping-1">Shiping Cost - NPR. 150</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										<p>
								</div>
							</div>
							
						</div>

						<div class="payments-methods">
							<div class="section-title">
								<h4 class="title">Payments Methods</h4>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payment" id="payments-1" value="Cash On delivery" checked>
								<label for="payments-1">Cash On Delivery</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										<p>
								</div>
							
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Order Review</h3>
							</div>
							<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Product</th>
										<th></th>
										<th class="text-center">Price</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Total</th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$total = 0;
										foreach($_SESSION['__cart'] as $key=>$cart_product){
										?>
										<tr>
											<td class="thumb">
												<?php if($cart_product['image'] != ""){
													$thumb = UPLOAD_URL."product/".$cart_product['image'];
												} else {
													$thumb = FRONT_IMAGES.'no-image.png';
												} ?>
												<img src="<?php echo $thumb;?>" alt="">
											</td>
											<td class="details">
												<a href="detail?id=<?php echo $cart_product['id'];?>">
												<?php echo $cart_product['title'];?>
												</a>
											</td>
											<td class="price text-center"><strong>NPR. <?php echo $cart_product['price']; ?></strong></td>
											<td class="qty text-center">
												<input onchange='adjust_amount(<?php echo json_encode($cart_product); ?>)'  class="input" type="number" value="<?php echo $cart_product['quantity'] ?>" >
											</td>
											<td class="total text-center"><strong  class="primary-color">NPR.<span > <?php echo $cart_product['amount']; ?></span></strong></td>
											<td class="text-right">
												<button class="main-btn icon-btn" onclick="deleteCartItem(<?php echo $key;?>)"><i class="fa fa-close"></i></button>
											</td>
										</tr>
										<?php
										$total += $cart_product['amount'];
										}
									?>
								</tbody>
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SUBTOTAL</th>
										<th colspan="2" class="sub-total">NPR. <?php echo $total; ?></th>
									</tr>

									<tr>
										<th class="empty" colspan="3"></th>
										<th>VAT</th>
										<th colspan="2" class="sub-total">NPR. <?php 
															$vat_amount = $total*0.13;
															echo $vat_amount; ?></th>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SHIPING</th>
										<td colspan="2">NPR. 150</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>TOTAL</th>
										<th colspan="2" class="total">NPR. <?php 
													echo ($total+$vat_amount+150);
										 ?></th>
									</tr>
								</tfoot>
							</table>
							<div class="pull-right">
								<button class="primary-btn" >Place Order</button>
							</div>
						</div>

					</div>
				</form>

				<?php } else {
					echo "No item found in the cart.";
				} ?>
				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- FOOTER -->
	<script type="text/javascript">
		
		function adjust_amount(cart_product){
			//console.log(cart_product);
			var qty = cart_product.quantity;
			//var amt = $('#amount').html();
			//console.log(amt);
			//var h_qty = $('#quantity').val();
			//amt = cart_product.amount;
			var amt = cart_product.amount;
			var price = cart_product.price;
			
			
			//console.log(new_amt);
				
		
		//$('#amount').html(new_amt);
		//cart_product.quantity = h_qty;
		var id = cart_product.id;
		$.post('inc/api.php',{id:id, price:price, new_amt:amt, quantity:qty, act:"change_quantity"},function(res){
			//console.log(res);
			
	if(res){
				alert('Your Cart is Updated.');
				document.location.href = document.location.href;
			}
			
			
		});  
		}
	</script>
<?php 
require 'inc/footer.php';
 ?>