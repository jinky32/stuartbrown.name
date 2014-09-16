<?php
//class craeted from https://www.youtube.com/watch?v=3yrpRfdtYc4
class Session {

	public static function exists($name){   //does a session exist?
		return (isset($_SESSION[$name])) ? true : false; //if the token is set then true
	}

	public static function put($name, $value){ //
		return $_SESSION[$name] = $value;
	}

	public static function get($name){
		return $_SESSION[$name];
	}

	public static function delete($name){
		if(self::exists($name)){
			unset($_SESSION[$name]);
		}
	}


//this method taken from https://www.youtube.com/watch?v=T_abxlvA1VE

	public static function flash($name, $string=''){
		if(self::exists($name)){ //check if the session exists 
			$session=self::get($name);  //if it does set it and then delete it
			self::delete($name);
			return $session;  //return the session
		} else { //otherwise set the data
			self::put($name, $string);
		}
	}
}



?>