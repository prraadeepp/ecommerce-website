


<?php 

/**
 * 
 */
class Customer_info extends Database
{
	
   public function __construct()
	{
		Database::__construct();
		$this->table('customer_info');
	}
	
   public function addCustomerInfo($data, $is_die = false){
         	try{
         		return $this->insert($data, $is_die);
         	}catch(Exception $e){
         		die($e->getMessage());
         	}
         }	

   public function getCustomerById($login_id, $is_die = false){

       try{
          $this->where(" login_id = ".$login_id);
         $this->orderBy(' id DESC ');
         return $this-> getData($is_die);

      }catch(Exception $e){
         return false;
      }
   }
   
   public function deleteCustomerInfo($id, $is_die = false){

      try {
         $this->where(" id = ".$id);
         return $this->delete($is_die);
      } catch (Exception $e) {
         return false;
      }
   }

   /*       public function getAllInfo($is_die = false){
       try{
         $this->orderBy(' id DESC ');
         return $this-> getData($is_die);

      }catch(Exception $e){
         die($e->getMessage());
      }
   }*/

/*public function getAllInfo($is_die = false){

   try{
      $this->fields('customer_info.*, customer_order.product_name, customer_order.product_price,  customer_order.product_image, customer_order.quantity, customer_order.total_amount, customer_order.amount_with_vat, customer_order.added_date, customer_login.email as email_address');
      $this->join(' LEFT JOIN customer_order ON customer_info.id = customer_order.c_info_id LEFT JOIN customer_login ON customer_info.login_id = customer_login.id');
      $this->groupBy(' customer_info.id');
         $this->orderBy(' customer_info.id DESC');
         return $this->getData($is_die);
   }catch(Exception $e){
     return false;
   }

}*/

public function getAllInfo($is_die = false){

   try{
         $this->fields('customer_info.*, customer_login.email as email_address, customer_login.first_name, customer_login.last_name');
         $this->join(' LEFT JOIN customer_login ON customer_info.login_id = customer_login.id');
      $this->groupBy(' customer_info.id');
         $this->orderBy(' customer_info.id DESC');
         return $this->getData($is_die);
   }catch(Exception $e){
      return false;
   }
}

}

 ?>