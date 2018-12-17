<?php 

/**
* 
*/
class User extends Database
{
	
	function __construct()
	{
		Database:: __construct();
		$this->table('users');
	}
	public function getUserByUsername($user_name,$is_die=false){
		try{
			$this->where("email='".$user_name."'AND status=1");
			return $this->getData();
		}catch(Exception $e){
			die($e->getMessage());
		}
	}
	public function updateUser($data, $id, $is_die=false){
		try{
			$this->where("id=".$id);
		return $this->update();
		}catch(Exception $e){
			die($e->getMessage());
		}

	}

	
}

 ?>