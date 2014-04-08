<?php
//based on video at https://www.youtube.com/watch?v=VEzJHww-QwM

class Redirect {
	public static function to($location = null) {
		if($location){
			if(is_numeric($location)){
				switch($location){
					case 404:
					header('HTTP/1.0 404 Not Found');
					include '_/components/php/includes/errors/404.php';
					exit();
					break;
				}
				
			}
			header('Location: '. $location);
			exit();
		}
	}
}

?>