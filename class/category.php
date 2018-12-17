<?php 

 class Category extends Database{

 	public function __construct(){
 		Database::__construct();
 		$this->table('categories');
 	}
 	public function getAllParentCats($is_die= false){
 		try{
 			$this->where(" is_parent = 1 AND parent_id = 0");
 			$this->orderBy(' title ASC ');
 			return $this-> getData($is_die);

 		}catch(Exception $e){
 			die($e->getMessage());
 		}
 	}

 	public function addCategory($data, $is_die=false){
 		try{
 			
 			return $this-> insert($data, $is_die);

 		}catch(Exception $e){
 			die($e->getMessage());
 		}
 	}

 	public function updateCategory($data, $cat_id, $is_die=false){
 		try{
 			$this->where(' id= '.$cat_id);
 			return $this-> update($data, $is_die);

 		}catch(Exception $e){
 			die($e->getMessage());
 		}
 	}

 	public function getAllCategory($is_die = false){

 		try{
 			$this->where();
 			$this->orderBy(' id DESC ');
 			return $this-> getData($is_die);

 		}catch(Exception $e){
 			die($e->getMessage());
 		}
 	}

 	public function getCategoryById($id, $is_die =false){
 		try{
 			$this->where(' id= '.$id);
 	        return $this-> getData($is_die);

 		}catch(Exception $e){
 			die($e->getMessage());
 		}
 	}

 	public function deleteCategory($id, $is_die = false){
 			try{
 			$this->where(' id= '.$id);
 	        return $this-> delete($is_die);

 		}catch(Exception $e){
 			die($e->getMessage());
 		}	
 			
 	}
 	public function getChildByParentId($id, $is_die = false){
 		 try{
 		 	$this-> where(' is_parent = 0 AND parent_id = '.$id);
 		 	return $this-> getData($is_die);
 		 }catch(Exception $e){
 		 	die ($e->getMessage());
 		 }


 	}
 }

 ?>