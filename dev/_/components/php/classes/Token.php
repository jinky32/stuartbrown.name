<?php
//class created from https://www.youtube.com/watch?v=3yrpRfdtYc4
class Token {
	public static function generate(){
		return Session::put(Config::get('session/token_name'), md5(uniqid()));  // uses the Session class in session.php
	}

	public static function check($token){ //check if a token exists and whehter it is same as another
		$tokenName=Config::get('session/token_name'); //get the token name

		if(Session::exists($tokenName) && $token === Session::get($tokenName)){ // if the token exists and its the same as the current one
			Session::delete($tokenName);
			return true;
		}

		return false;
	}
}

?>