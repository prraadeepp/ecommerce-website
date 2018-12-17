<?php 

/**
* 
*/
class ProductImages extends Database
{
	
	 public function __construct()
	{
		Database :: __construct();
		$this-> table('product_images');
	}
	public function addProductImages($data, $is_die = false){

		try{
			return $this-> insert($data, $is_die);
		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function deleteProductImages($id,$is_die= false){
		try{
            $this->where(" product_id = ".$id);
            return $this->delete($is_die);
      }catch(Exception $e){
         die($e->getMessage());
         }
	}

	
}

 ?>