<?php 

include 'inc/top_header.php';
include 'inc/header.php';
require_once 'class/pages.php';
$contact_page = new Pages();
	$title = "'Contact Us'";
	$about = $contact_page->getPageByTitle($title);
	//debugger($about);
	foreach ($about as $abt) {
		$contact_image = $abt->image;
		$contact_title  = $abt->title;
 	}
 ?>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">Contact Us</li>
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
				<img  src="<?php echo UPLOAD_URL.'pages/'.$contact_image;?>" alt="<?php echo $contact_title;?>">
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