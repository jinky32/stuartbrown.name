<?php
//taken from https://www.youtube.com/watch?v=G3hkHIoDi6M
//require_once "_/components/php/connect.php";
class User {
	private $_db;

	//use get instance method of db
	
	public function __construct($user = null){//define if we want to pass in a user value or not.
		$this->_db =DB::getInstance(); //connect to the database
	}

	//create a user
	public function create($fields=array()) {
		if (!$this->_db->insert('users', $fields)){ //i.e. using the insert method of the DB class.  If it doesn't work throw error
			throw new Exception('There was a problem creating account');
		}
	}

}



// 	public $id;
// 	public $username;
// 	public $password;
// 	public $first_name;
// 	public $last_name;

// 	public static function find_all() {
// 		return self::find_by_sql("SELECT * FROM users");
// 	}

// 	public static function find_by_id($id=1) {
// 		global $handler;
// 		$query = $handler->query("SELECT * FROM users WHERE id={$id}");
// //		$query->setFetchMode(PDO::FETCH_CLASS, 'User');
// //		while($r=$query->fetch()){
// //			//print_r($r);
// //			return $r;
// //		}
// 		$result = $query->fetch(PDO::FETCH_OBJ);
// 		return $result;

// 	}
	
// 	public static function find_by_sql($sql=""){
// 		global $handler;
// 		$query = $handler->query($sql);
// //		$result = $query->fetchAll(PDO::FETCH_OBJ);
// //		return $result;
// 		$query->setFetchMode(PDO::FETCH_CLASS, 'User');
// 		while($r=$query->fetch()){
// 			print_r($r);
// 			//return $r;

// 		}
		
// 	}
	
// 	public function full_name(){
// 		return $this->first_name . " " . $this->last_name;
// 	}


	
?>