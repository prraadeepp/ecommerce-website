<?php 

/**
* 
*/
class Ads extends Database
{
	
public	function __construct()
	{
		Database::__construct();
		$this->table('ads');
	}

	public function addAds($data,$is_die=false){

		try{
			return $this->insert($data, $is_die);
		}catch(Exception $e){
			die($e->getMessage());
		}

	}

	public function updateAds($data,$id,$is_die = false){

		try{
			$this->where('id = '.$id);
			return $this->update($data,$is_die);
		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getAllAds($is_die=null){
			try{
				return $this->getData($is_die);
		}catch(Exception $e){
			die($e->getMessage());
			}

	}

	public function getAdsById($id,$is_die=null){

		try {
			$this->where(" id = ".$id);
				return $this->getData($is_die);
		
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public  function deleteAds($id,$is_die=null){
		try {
			$this->where('id = '.$id);
				return $this->delete($is_die);
		
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAdsForHome($count, $is_die=false ){
			try {
				$this->where(' status = 1 ');
				$this->orderBy(' id DESC');
				$this->limit(0, $count);

				return $this->getData($is_die);
			} catch (Exception $e) {
				return false;
			}
		}
	
}



 ?>