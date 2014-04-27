<?php
//DB class built from https://www.youtube.com/watch?v=3_alwb6Twiw&index=9&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc and is a singelton pattern
class DB {
	private static $_instance=null; //this will store the instance of the database
	//below private properties not accessible outside of this class
	private $_pdo, //stores instantiated object
			$_query, //last query executed
			$_error=false, //whether there has been an error
			$_results, //stores results - primarily set in query method $this->_results = $this->_query->fetchAll
			$_count=0; //count of results
			
	private function __construct(){ //connect to database
		try { //uses the Config class in config.php to get values
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
		} catch (PDOExeption $e) {
			die($e->getMessage());
		}
		
	}
	
	public static function getInstance(){ //checks if object is instantiated and we have connected to db (via __construct)
		if(!isset(self::$_instance)){  //if DB class is not instantiated them do so
			self::$_instance = new DB(); //runs constructor and sets $_pdo
		}
		return self::$_instance;  //return 
	}

	public function query($sql, $params=array()){ //first arg is the query string and the second is an array of bound params
		$this->_error=false;  //reset to false incase a previous query had returned false
		if($this->_query = $this->_pdo->prepare($sql)){  //check if the query has been prepared properly.  $_pdo has been set in the contstructor
			$x=1; //set a counter
			if(count($params)){  //check if there were any params passed and loop through them
				foreach ($params as $param) {
					$this->_query->bindValue($x, $param); //update $_query to include bound values for the prepared statement, according tothe counter
					$x++;
				}
			}
			//regardless of whehter there are any parameters we still want to execute the query
			if($this->_query->execute()){ //if this is true then we have successfully queried and can get some results
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ); //set the value of $_results to the results of the query returned as an object
				$this->_count = $this->_query->rowCount();  //set the $_count
			} else {
				$this->_error = true;
			}
		}

		return $this;  // return the object we are working with
	}


	//to allow you to easily set update, delete etc and from which table
	public function action($action, $table, $where=array()){
		if(count($where)===3) { //check if value is 3 cos we need a field an opertor and a value (e.g. 'username', '=', 'alex')
			$operators = array('=', '>', '<', '>=', '<='); //define the list of operators
			//set the variables for the sql query. taken from the $where array
			$field = $where[0]; //for example 'username'
			$operator = $where[1]; //for example '='
			$value= $where[2]; //for example 'alex'

			if(in_array($operator, $operators)) { //check if the operator (from $where[1] is present in the $operators array) before contructing the query
				$sql= "{$action} FROM {$table} WHERE {$field} {$operator} ? "; //construct the query. first two vars from method params, last two split out of the $where array.  The ? allows us to bind the value
				if(!$this->query($sql, array($value))->error()){ // send $sql to the query method in this class along with the $value array
					return $this;  //return the object we are in

				}
			}
		}
		return false;
	}
	//makes it easy to select.  Hooks into action method above
	public function get($table, $where){
		return $this->action('SELECT *', $table, $where);  // 'SELECT *' here is passed to the $action param in action menthod above
	}
	//makes it easy to delete.  Hooks into action method above
	public function delete($table, $where){
		return $this->action('DELETE', $table, $where);
	}






//the insert and update methods are created from https://www.youtube.com/watch?v=FCnZsU19jyo&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc

// THE EMPTY $DUPLICATEKEY PARAM IS ADDED BECAUSE OF THE NEEDS OF THE fhpxInsert METHOD IN THE FIVEHUNDREDPX CLASS.
// AS PER THE COMMENTS THERE $DUPLICATEKEY MAY NEED TO BE AN ARRAY IN ORDER TO ALLOW DIFFERENT USERS TO ENTER THE SAME IMAGE_NAME
	public function insert($table, $fields=array(), $duplicateKey=''){ //set the table to insert into and the values to insert
		
		$keys=array_keys($fields); //store the keys from the key=>value array passed in $fields
		$values=''; //keeps track of ?s to go int he query
		$x=1;
		//because we are binding values for stored proceedures we need as many ?s as there are vaues to go int the db
		foreach ($fields as $field) {
			$values .= '?';
			if($x < count($fields)) { //if $x is less than the number of item in $fields array.  Really we want to know if we are at the end, of we are not....
				$values .=', '; //.... then we add a comma to $values so that query is valid
			}
			$x++;
		}
		if($duplicateKey){
			$sql = "INSERT INTO {$table} (`" .implode('`,`', $keys) ."`) VALUES ({$values}) ON DUPLICATE KEY UPDATE '$duplicateKey' = VALUES('$duplicateKey')";
		} else {
			$sql= "INSERT INTO {$table} (`" .implode('`,`', $keys) ."`) VALUES ({$values})";
		}
		//explode $keys and use to build sql query
		//$sql= "INSERT INTO {$table} (`" .implode('`,`', $keys) ."`) VALUES ({$values})";
		//print "INSERT INTO {$table} (`" .implode('`,`', $keys) ."`) VALUES ({$values}) ON DUPLICATE KEY UPDATE '$duplicateKey' = VALUES('$duplicateKey')";
		//$sql = "INSERT INTO {$table} (`" .implode('`,`', $keys) ."`) VALUES ({$values}) ON DUPLICATE KEY UPDATE {$duplicateKey} = VALUES({$duplicateKey})";
		
		if(!$this->query($sql, $fields)->error()) {
			return true;
		}

	return false;
	}
	
	public function update($table, $id, $fields){ // this requires an $id too to identfy which row to update
		$set=''; // set as empty string
		$x=1;
		foreach ($fields as $name => $value) {
			$set .="{$name} = ?";  //we want to bind the values
			if($x < count($fields)){ //if we are not at the end add a comma so we can add more 
				$set .=', ';
			}
			$x++;
		}

//the below will only work with an ID at the moment, may need to update int he future to update other columsn
		$sql ="UPDATE {$table} SET {$set} WHERE id={$id}";
		if(!$this->query($sql, $fields)->error()){ //pass the query and bindings to the query
			return true;
		} else {
			return false;
		}
	}
	
	public function results() {
		return $this->_results; //primarily set in query method $this->_results = $this->query
	}

	public function first() {
		return $this->_results[0]; 
	}

	public function error(){
		return $this->_error;
	}

	public function count(){
		return $this->_count; //default is 0 otherwise set in query method $this->_count = $this->_query->rowCount();
	}
			
}	

?>