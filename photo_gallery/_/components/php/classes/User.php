<?php
//taken from https://www.youtube.com/watch?v=AtivJV-kx5c&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=18
//checking signed in status taken from https://www.youtube.com/watch?v=_Hm53TOM30c
//require_once "_/components/php/connect.php";
class User {
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

	//use get instance method of db
	
	public function __construct($user = null){//define if we want to pass in a user value or not.
		$this->_db =DB::getInstance(); //connect to the database
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		if(!$user) { //this way we can grab any user's details or the curretly logged in user using the same method (just put the user id as a param e.g. User(6))
			if(Session::exists($this->_sessionName)) {
				$user=Session::get($this->_sessionName);

				//now check if that user actually exists or not 
				if($this->find($user)) {
					$this->_isLoggedIn = true;
				} else {
					//process logout
				}
			}
		} else {
			$this->find($user);
			$this->_isLoggedIn = true;
		}
	}

	//update method created from https://www.youtube.com/watch?v=KL4oviBqnQk
	//will call update method of db class.  Including the $id param in the method allows us to update any user record not just the current one (for example if there waws an admin interface)
	//the first if statement is therefore setting the id based on whether or not the param was provided and if a user is logged in
	public function update($fields = array(), $id=null){
		if(!$id && $this->isLoggedIn()){
			$id=$this->data()->id;
		}

		if(!$this->_db->update('users', 'id', $id, $fields)){
			throw new Exception('There was an error updating'); 
		}
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
			//$data=$this->_db->get('users', array(array($field), array('='), array($user)));

			if($data->count()){
				$this->_data = $data->first(); //now $_data contains all of the user's data (first record retrned)
				return true;
			}
		}
		return false;
	}
	//the $remember variable was added to the login method during the video at https://www.youtube.com/watch?v=d8DRVp2kdCc
	public function login($username=null, $password=null, $remember=false){
		//check if user exists
		

// check if a username and password hasnt been defined and if a user exists or not. 
		if(!$username && !$password && $this->exists()){
			//log user in
			Session::put($this->_sessionName, $this->data()->id);

		} else {
			$user=$this->find($username);


			// print_r($this->_data);
			if($user){
				if($this->data()->password === Hash::make($password, $this->data()->salt)){
				Session::put($this->_sessionName, $this->data()->id);

				//added from video https://www.youtube.com/watch?v=d8DRVp2kdCc
				if($remember){ //generate a has, check that it doesn't already exist in the db, and then insert this has in to the db
					//generate a unique hash
					$hash= Hash::unique();
					//check if it is stored in the db or not.  value grabbed from cookie and checked in db and then get user id
					$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data->id));
					//if no hash in database then insert a record into the db
					if(!$hashCheck->count()){
						$this->_db->insert('users_session', array(
							'user_id' => $this->data()->id,
							'hash' => $hash //set the has in the database
							));
					} else {
						$hash = $hashCheck->first()->hash;  //otherwise hash is waht is already int he db
					}

					Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
				}

				return true;
			 }
		}
	}
		
		return false;
	}

	//below method is taken from  https://www.youtube.com/watch?v=_Y-3YfVxIas
	public function hasPermission($key){
		$group = $this->_db->get('groups', array('id', '=', $this->data()->group));
		//check if the user is in a group.  then extract permissions

		
		if($group->count()){
			$permissions = json_decode($group->first()->permissions, true);

			if($permissions[$key]== true) {
				return true;
			}
		}
		return false;

	}


	//below method taken from https://www.youtube.com/watch?v=d8DRVp2kdCc
	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}

	//below method taken from https://www.youtube.com/watch?v=CmqcUJOjJzo&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
	public function logout(){
		//regenerate the has every time a user logs in via https://www.youtube.com/watch?v=d8DRVp2kdCc
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

		Session::delete($this->_sessionName);
		//delete cookie taken from https://www.youtube.com/watch?v=d8DRVp2kdCc 26:49
		Cookie::delete($this->_cookieName);
	}

	public function data(){
		return $this->_data;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
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