<?php 

/**
 * 
 */
class ReviewRating extends Database
{
	
	function __construct()
	{
		Database::__construct();
		$this->table('review_rating');
	}

	 public function addReview($data, $is_die = false){
         	try{
         		return $this->insert($data, $is_die);
         	}catch(Exception $e){
         		die($e->getMessage());
         	}
         }

     public function getReviewByProductId($id,$is_die = null){
     	try{
     		 
     		 $this->where(" product_id = ".$id);
     		 $this->orderBy(' id DESC ');
     		return $this->getData($is_die);
     	}catch(Exception $e){
     		die($e->getMessage());
     	}
     }    	
}

 ?>