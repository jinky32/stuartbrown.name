<?php
//this class makes it easier to reach and work with the values set in the 
//global array in init.php
class Config {
	public static function get($path=null){ // a path eg mysql/host (relating to the items int he global array in init.php) must be set
		if ($path){
			$config = $GLOBALS['config']; //set the global array to $config for ease of use
			$path = explode('/', $path); //breaks the $path string apart at '/' and returns an array of items 
			foreach ($path as $bit) { //loop through the new $path array
				if(isset($config[$bit])){  //check the global array in init.php to see if there is such a thing
					$config = $config{$bit}; //set $config to the value in the global array in init.php
				}
			}
			
			return $config;  //return that value set in the foreach
		}
		
		return false;  // this is the else from the above if
	}

}



?>