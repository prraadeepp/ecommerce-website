<?php 
	/**
	* 
	*/
	class Banner extends Database
	{
		
		public function __construct()
		{
		  Database:: __construct();
		  $this->table('banners');	
		}
		public function addBanner($data, $is_die = false){
			try{
				return $this->insert($data, $is_die);
			}catch(Exception $e){
				die($e->getMessage());
			}
		}
		public function getBanner($is_die=null){
			try{
				return $this->getData($is_die);
		}catch(Exception $e){
			die($e->getMessage());
			}

	}
		public function getBannerById($id, $is_die = false){
			try{
				$this->where(" id = ".$id);
				return $this->getData($is_die);
		}catch(Exception $e){
			die($e->getMessage());
			}
		}
		public function deleteBanner($id, $is_die= false){
			try{
				$this->where('id = '.$id);
				return $this->delete($is_die);
		}catch(Exception $e){
			die($e->getMessage());
			}
		}
		public function updateBanner($data, $id, $is_die = false){
			try{
				$this->where('id = '.$id);
				return $this->update($data, $is_die);
			}catch(Exception $e){
				die($e->getMessage());
			}
		}

		public function getBannerForHome($count, $is_die=false ){
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