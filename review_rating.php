<?php 

include 'config/config.php';
 include 'config/function.php';
 include 'class/database.php';
 include 'class/product.php';
 include 'class/review_rating.php';
 //debugger($_REQUEST, true);
 $p_id =  (int)$_GET['p_id'];
 $rating = new Product();

 $review = new ReviewRating();
/*$r_data=$review->getReviewByProductId($p_id);
 $rat = 0;
  		$count = 0;
  		foreach($r_data as $key => $ratings){
  			$rat+=$ratings->rating;
  			$count+=1;
  		}
  		$rate = $rat/$count;
  		//debugger($rate,true);
  		$p_data = array();
  		$p_data['rating'] = $rate;
  		$Rate =	$rating->updateProduct($p_data,$p_id);
  		debugger($Rate,true);*/
 //debugger($r_data,true);
  if(isset($_POST) && !empty($_POST)){

  	$data = array();
  	$data['name'] = addSlash($_POST['name']);
  	$data['email'] = addSlash($_POST['email']);
  	$data['review'] = addSlash($_POST['review']);
  	$data['rating'] = (int)($_POST['rating']);
  	
  	$data['product_id'] = $p_id;
  	$review_id = $review->addReview($data);
  	if($review_id){

  		$r_data=$review->getReviewByProductId($p_id);
  		$rat = 0;
  		$count = 0;
  		foreach($r_data as $key => $ratings){
  			$rat+=$ratings->rating;
  			$count+=1;
  		}
  		$rate = $rat/$count;
  		//debugger($rate,true);
  		$p_data = array();
  		$p_data['rating'] = $rate;
  		$Rate=$rating->updateProduct($p_data,$p_id);
  		

  		setFlash('success','Thank you for your review and rating.');
  		//$_SESSION['review_id'] = $review_id
  		$_SESSION['review'] = $p_id;
  		@header('location:detail.php?id='.$_GET['p_id']);
  		exit;
  	}else{
  		setFlash('error','Problem while adding your review.');
  		@header('locaton:detail.php');
  		exit;
  	}



  }else{
  	setFlash('error','Unauthorized access.');
  	@header('location:detail.php');
  	exit;
  }

 ?>