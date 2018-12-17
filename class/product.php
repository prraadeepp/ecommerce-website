
<?php 

 class Product extends Database{

         public function __construct(){
         	Database:: __construct();
         	$this-> table('product');

         	 }

         public function addProduct($data, $is_die = false){
         	try{
         		return $this->insert($data, $is_die);
         	}catch(Exception $e){
         		die($e->getMessage());
         	}
         }

         public function getAllProducts($is_die = false){

      try{
         $this->where();
         $this->orderBy(' id DESC ');
         return $this-> getData($is_die);

      }catch(Exception $e){
         die($e->getMessage());
      }
   }
   public function getProductById($id,$is_die = false){
      
         try{
            $this->where(" id = ".$id);
            return $this->getData($is_die);
      }catch(Exception $e){
         die($e->getMessage());
         }
   }
   public function getProductByCatIdonly($cid, $is_die = false){
       try{
            $this->where(" cat_id = ".$cid);
            return $this->getData($is_die);
      }catch(Exception $e){
         die($e->getMessage());
         }
   }

   public function getProductByCatId($cat_id, $p_id, $is_die = false){
      try{

            $this->where(" product.cat_id = ".$cat_id." AND ( product.id != ".$p_id." )");
            return $this->getData($is_die);
      }catch(Exception $e){
         die($e->getMessage());
         }
   }

   public function deleteProduct($id, $is_die=false){
      try{
            $this->where(" id = ".$id);
            return $this->delete($is_die);
      }catch(Exception $e){
         die($e->getMessage());
         }
   }
   public function updateProduct($data,$id,$is_die=false){
      try{
            $this->where('id = '.$id);
            return $this->update($data, $is_die);
         }catch(Exception $e){
            die($e->getMessage());
         }
   }
 


public function getSearchedDataByArray($args = array(), $is_die = false){
      try {
         $this->fields('product.*,categories.title as category_title');
         $this->join(" LEFT JOIN categories ON product.cat_id = categories.id");

         $where = " product.status IN (1, 2)";
         
         if(isset($args['keyword']) && $args['keyword'] != ""){
            $keyword = $args['keyword'];
            $where .= " AND ( product.title LIKE '%".$keyword."%' OR product.summary LIKE ('%".$keyword."%') OR product.description LIKE ('%".$keyword."%'))";
         }

         if(isset($args['cat_id']) && $args['cat_id'] != "" && $args['cat_id'] != 0){
            $cat_id = $args['cat_id'];
            $where .= " AND ( cat_id = ".$cat_id." OR child_cat_id = ".$cat_id.") ";
         }

         if(isset($args['min_price']) && $args['min_price'] != "" && $args['min_price'] != 0){
            $min_price = $args['min_price'];
            $where .= " AND (product.price >= ".$min_price.")";
         }

         if(isset($args['max_price']) && $args['max_price'] != "" && $args['max_price'] != 0){
            $max_price = $args['max_price'];
            $where .= " AND (product.price <= ".$max_price.")";
         }

         $this->where($where);
         $this->groupBy(' product.id');
         $this->orderBy(' product.id DESC');
         $this->limit(0,20);
         return $this->getData($is_die);

      } catch (Exception $e) {
         return false;
      }
   }

  function getProductByCategory($cat_id = null, $child_id = null, $is_die = null){

   try{
         $this->fields('product.*, categories.title as category_title');
         $this->join(' LEFT JOIN categories ON product.cat_id = categories.id');

         $where = " product.status IN (1,2)";

         if ($cat_id != null || $cat_id != 0) {
            $where .= " AND (cat_id = ".$cat_id." ) ";
         }

         if ($child_id != null || $child_id != 0) {
            $where .= " AND (child_cat_id = ".$child_id." ) ";
         }

          $this->where($where);
          $this->groupBy(' product.id');
          $this->orderBy(' product.id DESC');
          $this->limit(0,20);
          return $this->getData($is_die);


   }catch(Exception $e){
      die($e->getMessage());
   }

  }

   public function getLatestProduct($is_die = false){
      try {
         $this->fields('product.*, categories.title as category_title');
         $this->join(" LEFT JOIN categories ON product.cat_id = categories.id");

         $where = " product.status IN (1, 2)";
         $this->where($where);
         $this->groupBy(' product.id');
         $this->orderBy(' product.id DESC');
         $this->limit(0,24);
         return $this->getData($is_die);
      } catch (Exception $e) {
         return false;
      }
   }

 public function getProductByIdForDetail($product_id, $is_die = false){
 try {
         $this->fields('product.*, product_images.image, categories.title as category_title');
         $this->join(" LEFT JOIN product_images ON product.id = product_images.product_id LEFT JOIN categories ON product.cat_id = categories.id");
      
         $where = " product.status IN (1, 2) AND product.id = ".$product_id;
         $this->where($where);
         $this->groupBy(' product.id');
         return $this->getData($is_die);
         
      } catch (Exception $e) {
         return false;
      }

 }

}



 
?>