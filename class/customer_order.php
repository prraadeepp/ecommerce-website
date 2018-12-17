


<?php 

/**
 * 
 */
class Customer_order extends Database
{
	
   public function __construct()
	{
		Database::__construct();
		$this->table('customer_order');
	}
	
   public function addCustomerOrder($data, $is_die = false){
         	try{
         		return $this->insert($data, $is_die);
         	}catch(Exception $e){
         		die($e->getMessage());
         	}
         }	
   public function getAllOrderByCInfoId($c_i_d, $is_die = false){
       try{
          $this->where(" c_info_id = ".$c_i_d);
         $this->orderBy(' id DESC ');
         return $this-> getData($is_die);

      }catch(Exception $e){
         die($e->getMessage());
      }
   }

   public function getOrder($order_id, $is_die = false){

    try {
      $this->where(" id = ".$order_id);
      return getData($is_die);
    } catch (Exception $e) {
      return false;
    }
   }

   public function getCustomerOrder($lid, $is_die = false){
    try {
        $this->fields('customer_order.*');
        $this->join(' LEFT JOIN customer_info ON customer_order.c_info_id = customer_info.id LEFT JOIN customer_login on customer_info.login_id = customer_login.id ');
        $this->where(" customer_login.id = ".$lid);
      $this->groupBy(' customer_order.id');
      $this->orderBy(' customer_order.id DESC');
     return $this->getData($is_die);

    } catch (Exception $e) {
      die($e->getMessage());
    }
   }

   public function deleteCustomerOrderById($id, $is_die = false){

    try {
      $this->where(" id = ".$id);
      return $this->delete($is_die);
    } catch (Exception $e) {
      return false;
    }
   }

   public function deleteCustomerOrderByCId($cid, $is_die = false){

    try {
      $this->where(" c_info_id = ".$cid);
      return $this->delete($is_die);
    } catch (Exception $e) {
      return false;
    }
   }

   public function updateOrder($data, $id, $is_die = false){

    try {
      $this->where(' id = '.$id);
      return $this->update($data,$is_die);
    } catch (Exception $e) {
      return false;
    }
   }

}

 ?>