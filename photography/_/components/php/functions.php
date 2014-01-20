<?php namespace Photo\DB;
require 'config.php';
// $config = array(
// 	'username' => 'stuartbrown',
// 	'password' => 'm4nch3st3r'
// );


function connect($config)
{
	try {
		$conn = new \PDO('mysql:host=mysql.stuartbrown.name;dbname=photography_website',
						$config['DB_USERNAME'],
		 				$config['DB_PASSWORD']);
		// $conn = new \PDO('mysql:host=mysql.stuartbrown.name;dbname=photography_website',
		// 				$config['username'],
		// 				$config['password']);


		$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}

function query($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);

	//$results = $stmt->fetchAll();

	return $results ? $results : false;
}

function query2($query, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute();

	$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

	return $results ? $results : false;
}


function get($tableName, $conn)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName");

		return ( $result->rowCount() > 0 )
			? $result
			: false;
	} catch(Exception $e) {
		return false;
	}

}

?>









