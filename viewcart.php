<?php 

include 'inc/top_header.php';
include 'inc/header.php';
 ?>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">Viewcart</li>
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
									
												<input  id="quantity<?php echo $key; ?>" onchange='adjust_amount(<?php echo $key.",".json_encode($cart_product); ?>);' class="input" type="number" value="<?php echo $cart_product['quantity'] ?>" >
											</td>
											<td class="total text-center"><strong  class="primary-color">NPR.<span  id="amount<?php echo $key; ?>"   > <?php echo $cart_product['amount']; ?></span></strong></td>
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
				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- FOOTER -->
	<?php 
	include 'inc/footer.php';
	 ?>

	 <script type="text/javascript">
		
			

function adjust_amount(key,cart_pro) {
	//var qty = $.('#quantity'+key);

	
	 in_qty = cart_pro.quantity;
	var chg_qty = $('#quantity'+key).val();
	$('#quantity'+key).val(chg_qty);
	//alert(chg_qty);
	//exit;
	var amt = $('#amount'+key).html();
	if (chg_qty>in_qty) {
		$('#amount'+key).html(amt+++cart_pro.price);
	}
	if (chg_qty<in_qty) {
		$('#amount'+key).html(amt-cart_pro.price);
		}	
}

function save_change(cart_product){

	console.log(cart_product);

}





		/*	function adjust_amount(cart_product){
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
			}*/
		</script>