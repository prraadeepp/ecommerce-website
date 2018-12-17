<?php 

include 'inc/top_header.php';
require_once 'class/customer_info.php';
require_once 'class/customer_order.php';
require_once 'class/login_register.php';
//$cusinfo = new Customer_info();
//$cus_info = $cusinfo->getCustomerInfo($_SESSION['login_id']);
$customer = new Customer_order();
$cus_order = $customer->getCustomerOrder($_SESSION['login_id']);
//debugger($cus_order,true);
include 'inc/header.php';
 ?>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">My Orders</li>
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
<?php if (!empty($cus_order)) {?>
				<table class="table table-hover">
					<thead>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Amount With VAT</th>
						<th>Ordered Date</th>
						<th>Status</th>
					</thead>
					<tbody>
						<?php 
							foreach($cus_order as $key => $order){ ?>

							<tr>
								<td><img style="width: 100px;" src="<?php echo UPLOAD_URL."product/".$order->product_image;?>" alt="<?php echo $order->product_name; ?>"><br><span><?php echo $order->product_name; ?></span></td>
								<td><?php echo $order->product_price;?></td>
								<td><?php echo $order->quantity;?></td>
								<td><?php echo $order->amount_with_vat;?></td>
								<td><?php echo $order->added_date;?></td>
								<td><?php  if($order->status == 1){echo "Left to be delivered";}else{ echo "Delivered";}?></td>
							</tr>
							
							
							<?php
						}
						}else{
							echo 'You do not have any order.';
						} ?>
						
					</tbody>
					
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