<?php 

class LoginRegister extends Database{

	function __construct()
	{
		Database:: __construct();
		$this->table('customer_login');
	}

	public function addCustomer($data, $is_die = false){
         	try{
         		return $this->insert($data, $is_die);
         	}catch(Exception $e){
         		die($e->getMessage());
         	}
         }

	    public function getCustomerInfo($email, $is_die = false){
 
      try{
            $this->where(" email = '".$email."'");
            return $this->getData($is_die);
      }catch(Exception $e){
         die($e->getMessage());
         }
   
	    }

        public function getLoginInfoByPass($pass, $is_die = false){
 
      try{
            $this->where(" password = '".$pass."'");
            return $this->getData($is_die);
      }catch(Exception $e){
         die($e->getMessage());
         }
   
       }

       public function getLoginInfoById($id, $is_die = false){
 
      try{
            $this->where(" id = ".$id);
            return $this->getData($is_die);
      }catch(Exception $e){
         die($e->getMessage());
         }
   
       }

       public function getAllLoginInfo($is_die = false){
       try{
         $this->orderBy(' id DESC ');
         return $this-> getData($is_die);

      }catch(Exception $e){
         die($e->getMessage());
      }
   }

         public function updateAccount($data, $id, $is_die = false){

            try {
               $this->where(" id = ".$id);
               return $this-> update($data, $is_die);
            } catch (Exception $e) {
               die($e->getMessage());
            }
         }


}
 ?>