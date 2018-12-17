</body>
<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="index.php">
		            <img src="<?php echo FRONT_IMAGES;?>logo.png" alt="">
		          </a>
						</div>
						<!-- /footer logo -->

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>

						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				
					<?php 
									if(isset($_SESSION['customer'])){
								?>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">My Account</h3>
						<ul class="list-links">
							<li><a href="order.php">My order</a></li>
							<li><a href="wishlist.php">My Wishlist</a></li>
							<li><a href="checkout.php">Checkout</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div></div>
					<?php } ?>
				
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Customer Service</h3>
						<ul class="list-links">
							<li><a href="about.php">About Us</a></li>
							<li><a href="#">Shiping Guide</a></li>
							<li><a href="#">FAQ</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<p id="notify" class="hidden alert alert-success" style="color: red;"></p>
						<h3 class="footer-header">Stay Connected</h3>
						<p>Leave your email address here so that you can get information of the new products available in our e-shop.</p>
						<form>
							<div class="form-group">
								<input class="input" id="entered_email" type="email" placeholder="Enter Email Address">
							</div>
							<button id="newslatter" class="primary-btn">Join Newslatter</button>
						</form>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a  target="_blank">Pradeep</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>

	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="banner_add_modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form action="edit_account.php" method="post" enctype="multipart/form-data" class="form form-horizontal">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

		             <div class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								
								<h4 class="text-uppercase">My Account <i class="fa fa-caret-down"></i></h4>
							</div>
							<ul class="custom-menu">
								
								<li><?php echo ucfirst($login_in_fo[0]->first_name)." ".ucfirst($login_in_fo[0]->last_name); ?></li>
								
								<li><?php echo $login_in_fo[0]->email; ?></li>
								<li><?php if($login_in_fo[0]->gender == "M"){echo "Male";}else{echo "Female";} ?></li>
							</ul>
					</div>		

        <span> <?php getFlash(); ?></span>
	</div>
	<div class="modal-body">
	
	<div class="form-group">
		<label class="control-label col-sm-3">Current Password:</label>
		<div class="col-sm-8"> 
			<input type="password" name="current_password" required placeholder="Enter your current password here" class="form-control"></div>
	</div>	

        

                            <div class="form-group">
								<div class="input-checkbox">
									
									<input type="checkbox" id="register">
									<label  class="control-label col-sm-3 font-weak" for="register">Change Username?</label>
									
									<div class="caption">
										<div class="form-group">
									      <div class="col-sm-8">
								            <input type="text" id="first-name" name="first-name"  placeholder="Enter First Name Here " class="form-control"></div>
								          </div>
								          <div class="form-group">
									        <div class="col-sm-8">
									            <input type="text" id="last-name" name="last-name"  placeholder="Enter Last Name Here " class="form-control"></div>
									        </div>
									</div>
								</div>
							</div>
                            <div class="form-group">
								<div class="input-checkbox">
									
									<input type="checkbox" id="registe">
									<label  class="control-label col-sm-3 font-weak" for="registe">Change Email?</label>
									
									<div class="caption">
										
								          <div class="form-group">
									         <div class="col-sm-8">
									            <input type="text" id="email" name="email"  placeholder="Enter New Email Here " class="form-control">
									          </div>
									</div>
								</div>
							</div></div>

							<div class="form-group">
								<div class="input-checkbox">
									
									<input type="checkbox" id="regist">
									<label  class="control-label col-sm-3 font-weak" for="regist">Change Password?</label>
									
									<div class="caption">
										
								          <div class="form-group">
									         <div class="col-sm-8">
										            <input type="password" id="new-password" name="new-password" placeholder="Enter New Password Here " class="form-control">
										      </div>
										  </div>
								</div>
							</div></div>

	</div>
	<div class="modal-footer">
		<button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Save changes</button>
        </div>
	</div>
	</form>
</div>
</div>
</div>

	<!-- jQuery Plugins -->
	<script src="<?php echo FRONT_JS;?>jquery.min.js"></script>
	<script src="<?php echo FRONT_JS;?>bootstrap.min.js"></script>
	<script src="<?php echo FRONT_JS;?>slick.min.js"></script>
	<script src="<?php echo FRONT_JS;?>nouislider.min.js"></script>
	<script src="<?php echo FRONT_JS;?>jquery.zoom.min.js"></script>
	<script src="<?php echo FRONT_JS;?>main.js"></script>


<script type="text/javascript">
//  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	$('#newslatter').click(function(e){
		$('#notify').html("");
//		$('#notify').removeClass('hidden');
		e.preventDefault();
		var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		var email = $('#entered_email').val();
		if (email.match(mailFormat)) {
			$('#notify').html('You will get Notification of our latest Products.');
			$('#notify').removeClass('hidden');
			$('#entered_email').val('');

		}else{
			$('#notify').html('You need to enter valid email.');
			$('#notify').removeClass('hidden');
			
		}

	//var email_address =	$('#entered_email').val()
	});


  /*  setTimeout(function(){
 		$('.alert').slideUp('slow');
 		$('alert').addClass('hidden');
    }, 5000);
*/

	function addToWishlist(product_id){
		$.post('inc/api.php',{product_id:product_id, act:"<?php echo substr(md5('add-to-wishlist'), 3,15); ?>"},function(res){
			alert(res);

	});
	}

	function deleteFromWishlist(product_id){
	
		$.post('inc/api2.php',{product_id:product_id, act:"<?php echo substr(md5('delete-from-wishlist'), 3,15); ?>"},function(res){
			if(res){
				document.location.href = document.location.href;
			}

	});
	}
		
	function addToCart(product_id){

		$.post('inc/api.php',{product_id:product_id, act:"<?php echo substr(md5('add-to-cart'), 3,15); ?>"},function(res){

			if (res == 1) {
				alert('Cart Updated');
				document.location.href = document.location.href;
			}
		});
}
	function deleteCartItem(cart_index){
		$.post('inc/api.php', {cart_index:cart_index, act:"<?php echo substr(md5('delete-from-cart'),3,15); ?>"}, function(res){
			if (res) {
				alert('Cart Updated');
				document.location.href=document.location.href;
			}
		});
	}
	

</script>


</html>
