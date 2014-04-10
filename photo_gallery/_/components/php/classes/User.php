<?php
//taken from https://www.youtube.com/watch?v=AtivJV-kx5c&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=18
//require_once "_/components/php/connect.php";
class User {
	private $_db,
			$_data,
			$_sessionName;

	//use get instance method of db
	
	public function __construct($user = null){//define if we want to pass in a user value or not.
		$this->_db =DB::getInstance(); //connect to the database
		$this->_sessionName = Config::get('session/session_name');
	}

	//create a user
	public function create($fields=array()) {
		if (!$this->_db->insert('users', $fields)){ //i.e. using the insert method of the DB class.  If it doesn't work throw error
			throw new Exception('There was a problem creating account');
		}
	}

	public function find($user = null){
		//find user by ID or username.  The below doesn't take account of the fact that we allow users to have numeric usernames. see 
		//9.30seconds of https://www.youtube.com/watch?v=AtivJV-kx5c&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
		if($user){
			$field=(is_numeric($user)) ? 'id' : 'username'; //if the value passed ($user) is numeric then assume it is the user id otherwise assume tht its the username
			//$data represnts what we get back from the db via the DB instance createed n the __construct
			$data=$this->_db->get('users', array($field, '=', $user));

			if($data->count()){
				$this->_data = $data->first(); //now $_data contains all of the user's data (first record retrned)
				return true;
			}
		}
		return false;
	}

	public function login($username=null, $password=null){
		//check if user exists
		$user=$this->find($username);
		// print_r($this->_data);
		if($user){
			if($this->data()->password === Hash::make($password, $this->data()->salt)){
			Session::put($this->_sessionName, $this->data()->id);
			return true;
		 }
		}
		
		return false;
	}

	private function data(){
		return $this->_data;
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