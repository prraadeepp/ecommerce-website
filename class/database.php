<?php 

abstract class Database{
	protected $conn= null;
	private $stmt= null;
	private $table= null;
	private $where= null;
	private $fields= null;
	private $sql = null;
	private $order_by = null;
	private $join = null;
	private $group_by = null;
	private $limit = null;

	public function __construct(){
		try{
			$this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';',DB_USER,DB_PWD);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->stmt=$this->conn->prepare('SET NAMES utf8');
			$this->stmt->execute();
		} catch(PDOException $e){
			die($e->getMessage());
		}catch(Exception $e){
			die($e->getMessage());
		}
	}


	protected final function table($_table){
	   $this->table=$_table;
	}

	protected final function fields($_fields=null){
		if ($_fields== null) {
			$this->fields='*';
		}else{
			if(is_string($_fields)){
				$this->fields=$_fields;
			}else if (is_array($_fields)) {
				$this->fields = implode(',',$_fields);
			}
		}
	}
	protected final function where($_where= null){
		$this->where= null;
		if($_where!=null){
			$this->where= $_where;
		}
	}
	protected final function orderBy($_order_by= null){
		$this->order_by= null;
		if($_order_by!=null){
			$this->order_by = $_order_by;
		}
	}

	protected final function groupBy($_group_by = null){
		$this->group_by = null;
		if($_group_by != null){
			$this->group_by = $_group_by;
		}
	}

	protected final function join($_join = null){
		$this->join = null;
		if($_join != null){
			$this->join = $_join;
		}
	}

	protected final function limit($start = 0, $count = 100){
		$this->limit = $start.", ".$count;
	}

	protected final function getData($is_die=false){
		try{
			$this->sql="SELECT ";
			if (!isset($this->fields) || empty($this->fields)) {
				$this->fields();
			}
			$this->sql.=$this->fields;
			$this->sql.=" FROM ";
			if (!isset($this->table) || empty($this->table)) {
				throw new exception('Table not Set.');
			}

			$this->sql .= $this->table;
			
				if(isset($this->join) && !empty($this->join)){
				$this->sql .= " ".$this->join;
			}

			
			if (isset($this->where) || !empty($this->where)) {
				$this->sql.=" WHERE ".$this->where;
			}

			if(isset($this->group_by) && !empty($this->group_by)){
				$this->sql .= " GROUP BY ".$this->group_by;
			}	

			if (isset($this->order_by) || !empty($this->order_by)) {
				$this->sql.=" ORDER BY ".$this->order_by;
			}

			if(isset($this->limit) && !empty($this->limit)){
				$this->sql .= " LIMIT ".$this->limit;
			}	


			if ($is_die) {
			echo $this->sql;
			exit();

			}
			$this->stmt=$this->conn->prepare($this->sql);
			$this->stmt->execute();
			$data=array();
			$data=$this->stmt->fetchAll(PDO::FETCH_OBJ);
			return $data;
			}catch(PDOException $e){
				die($e->getMessage());
			}catch(Exception $e){
				die($e->getMessage());
			}
		}
	protected final function update($data, $is_die=false){
		try{
			$this->sql="UPDATE ";
			if (!isset($this->table) || $this->table== null) {
				throw new Exception ('Table not Set.');
			}
			$this->sql .= $this->table." SET ";
			if (is_string($data)) {
				$this->sql=$data;
			}else{
				$temp = array();
				foreach ($data as $key => $value) {
					$str=$key." = :".$key;
					$temp[]=$str;
				}
			$this->sql .= implode(', ', $temp);	
			}
			if (isset($this->where) && ($this->where != "")) {
				$this->sql .= " WHERE ".$this->where;
			}
			$this->stmt=$this->conn->prepare($this->sql);
			if(is_array($data)){
				foreach($data as $key => $value){
					if(is_null($value)){
						$param = PDO::PARAM_NULL;
					} else if(is_bool($value)){
						$param = PDO::PARAM_BOOL;
					} else if(is_int($value)){
						$param = PDO::PARAM_INT;
					} else if(is_string($value) || is_float($value)){
						$param = PDO::PARAM_STR;
					} else {
						$param = false;
					}

					if($param){
						$this->stmt->bindValue(":".$key, $value, $param);
					}
				}
			}

			if($is_die){
				debugger($data);
				debugger($this->sql, true);
			}

			return $this->stmt->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	protected final function insert($data, $is_die=false){
		try{
			$this->sql= "INSERT INTO ";
			if (!isset($this->table) || $this->table== null) {
				throw new Exception ('Table not Set.');
			}
			$this->sql.=$this->table." SET ";
			if (is_string($data)) {
				$this->sql=$data;
			}else{
				$temp = array();
				foreach ($data as $key => $value) {
					$str=$key." = :".$key;
					$temp[]=$str;
				}
			$this->sql .= implode(', ', $temp);	
			//debugger($this->sql, true);
			}
			
			$this->stmt= $this->conn->prepare($this->sql);
			if(is_array($data)){
				foreach($data as $key => $value){
					if(is_null($value)){
						$param = PDO::PARAM_NULL;
					} else if(is_bool($value)){
						$param = PDO::PARAM_BOOL;
					} else if(is_int($value)){
						$param = PDO::PARAM_INT;
					} else if(is_string($value) || is_float($value)){
						$param = PDO::PARAM_STR;
					} else {
						$param = false;
					}

					if($param){
						$this->stmt->bindValue(":".$key, $value, $param);
					}
				}
			}

			if($is_die){
				debugger($data);
				debugger($this->sql, true);
			}

			 $this->stmt->execute();
			 //print_r($this->conn);
			 //exit;
		return $this->conn->lastInsertId();
		}catch(PDOException $e){
			die($e->getMessage());
		}catch(Exception $e){
			die($e->getMessage());
		}
	}
	protected final function delete($is_die= false){
	try{	$this->sql = "DELETE FROM ";
		if (!isset($this->table) || $this->table== null) {
				throw new Exception ('Table not Set.');
			}
			$this->sql.=$this->table;
			if (isset($this->where) && ($this->where!="")) {
				$this->sql.=" WHERE ".$this->where;
			}
			if($is_die){
				debugger($this->sql, true);
			}
			$this->stmt=$this->conn->prepare($this->sql);
			return $this->stmt->execute();
	}catch(PDOException $e){
			die($e->getMessage());
		}catch(Exception $e){
			die($e->getMessage());
		}
    }


}







	 ?>	
