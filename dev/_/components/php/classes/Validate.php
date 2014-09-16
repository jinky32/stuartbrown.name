<?php
//based on https://www.youtube.com/watch?v=rWon2iC-cQ0&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc

class Validate {
	private $_passed = false,
			$_errors=array(),
			$_db=null;

	public function __construct(){
		$this->_db = DB::getInstance();  //set db to getInstance e.g. connect to db
	}
public function check($source, $items=array()){
	foreach($items as $item => $rules){  //loop through the rules we've defined in register.php e.g. username, passwors
		foreach($rules as $rule => $rule_value){ //then loop through the specific rules for each of these
			$value = trim($source[$item]); //set $value
			$item = escape($item);
			//echo $value;
			if($rule==='required' && empty($value)){  //if the rule if required andit is empty we have a proble,
					$this->addError("{$item} is required");  //set the error
				} else if (!empty($value)) {
					switch($rule) { //check against each of the rules set in register.php
						case 'min' :
							if(strlen($value) < $rule_value) { //check that string length is less thatnthe rule defined
								$this->addError("{$item} must be a minimum of {$rule_value} characters"); //set the error
							}
						break;

						case 'max' : //make sure it's not more than max chars
							if(strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters"); 
							}
						break;

						case 'matches' : //make sure passwords match
							if($value != $source[$rule_value]) {
								$this->addError("{$rule_value} must match {$item}");
							}
						break;

						case 'unique' : //use the get method from db wrapper from the constructor above 
							$check = $this->_db->get($rule_value, array($item, '=', $value)); //get from a particular table.  See minute 34 of https://www.youtube.com/watch?v=rWon2iC-cQ0
							if($check->count()){ //find out how many results are retunred.  If there is a postitive number then give an error
								$this->addError("{$item} already exists");
							}
						break;
					}
				}
			}
		}
		if(empty($this->_errors)){  //if there are no errors set $_passed to true (set default to false above)
				$this->_passed = true;
			}
			return $this;
}



	private function addError($error){ //adds an error to the error array
		$this->_errors[]=$error;
	}

	public function errors(){ //returns a list of errors that we have
		return $this->_errors;
	}

	public function passed() {  //return $_passed (set above to false)
		return $this->_passed;
	}
}


?>