<?php
//based on https://www.youtube.com/watch?v=rWon2iC-cQ0&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
class Input {
	public static function exists ($type='post'){ //checks to see if POST or GET is empty.  This is for form validation
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;

			case 'get':
				return (!empty($_GET)) ? true : false;
				break;
			
			default:
				return false;
				break;
		}
	}

	public static function get($item) {
		if(isset($_POST[$item])){ //if the $_POST array has a somethng with that value then return it
			return $_POST[$item];
		} elseif (isset($_GET[$item])) {
			return $_GET[$item];
		}

		return '';  //if the data above doens't exist we still want to return something even if an empty string.
	}
}


?>