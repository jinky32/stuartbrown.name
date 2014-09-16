<?php

require "_/components/php/config.php";

try {
	$handler = new PDO('mysql:host=mysql.stuartbrown.name;dbname=photo_gallery_oop',
						$config['DB_USERNAME'],
		 				$config['DB_PASSWORD']);

	$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

	echo $e->getMessage();
	die();

}

?>