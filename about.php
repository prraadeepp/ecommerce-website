<?php 

include 'inc/top_header.php';
include 'inc/header.php';
include 'class/pages.php';
	$about_page = new Pages();
	$title = "'About Us'";
	$about = $about_page->getPageByTitle($title);
	//debugger($about);
	foreach ($about as $abt) {
		$about_image = $abt->image;
		$about_title  = $abt->title;
 	}
 ?>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">About Us</li>
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
				<img  src="<?php echo UPLOAD_URL.'pages/'.$about_image;?>" alt="<?php echo $about_title;?>">
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