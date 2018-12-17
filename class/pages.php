<?php 

class Pages extends Database{
	public function __construct(){
		Database:: __construct();
		$this->table('pages');
	}
	public function addPages($data, $is_die = null){
		try{
			return $this->insert($data, $is_die);

		}catch(Exception $e){
			die($e->getMessage());
		}
	}
	public function updatePages($data, $id, $is_die=null){
		try{
			$this->where(' id='.$id);
			return $this->update($data, $is_die);

		}catch(Exception $e){
			die($e->getMessage());
		}
	}
	public function getAllPages($is_die = null){
		try{

			return $this->getData($is_die);
		}catch(Exception $e){
			die($e->getMessage());
		}
	}
	public function getPageById($id, $is_die=false){
		try{
				$this->where(" id = ".$id);
				return $this->getData($is_die);
		}catch(Exception $e){
			die($e->getMessage());
			}
	}
	public function getPageByTitle($title, $is_die=false){
		try{
				$this->where(" title = ".$title);
				return $this->getData($is_die);
		}catch(Exception $e){
			die($e->getMessage());
			}
	}
	public function deletePages($id,$is_die=false){

		try{
				$this->where('id = '.$id);
				return $this->delete($is_die);
		}catch(Exception $e){
			die($e->getMessage());
			}
	}



}

















 ?>