<?php
require_once "_/components/php/connect.php";
class User {
	
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;

	public static function find_all() {
		return self::find_by_sql("SELECT * FROM users");
	}

	public static function find_by_id($id=1) {
		global $handler;
		$query = $handler->query("SELECT * FROM users WHERE id={$id}");
//		$query->setFetchMode(PDO::FETCH_CLASS, 'User');
//		while($r=$query->fetch()){
//			//print_r($r);
//			return $r;
//		}
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;

	}
	
	public static function find_by_sql($sql=""){
		global $handler;
		$query = $handler->query($sql);
//		$result = $query->fetchAll(PDO::FETCH_OBJ);
//		return $result;
		$query->setFetchMode(PDO::FETCH_CLASS, 'User');
		while($r=$query->fetch()){
			print_r($r);
			//return $r;

		}
		
	}
	
	public function full_name(){
		return $this->first_name . " " . $this->last_name;
	}

}
	
?>