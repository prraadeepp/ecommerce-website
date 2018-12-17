<?php 
class Wishlist extends Database
{
	
public	function __construct()
	{
		Database:: __construct();
		$this->table('wishlist');
	}

public	function addWishlist($data,$is_die = false){

		try{
			return $this->insert($data, $is_die);

		}catch(exception $e){
			die($e->getMessage());
		}
	}

	public function getWishlist($id,$is_die = false){

		try{
		$this->where(' customer_id = '.$id);
		return	$this-> getData($is_die);

		}catch(exception $e){
			die($e->getMessage());
		}
	}

	public function updateWishlist($data,$id,$is_die = false){

		try{
	       $this->where(" customer_id = ".$id);
		return $this->update($data, $is_die);
		}catch(exception $e){
			die($e->getMessage());
		}
	}

}
 ?>