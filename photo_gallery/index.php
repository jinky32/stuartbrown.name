<?php
require_once '_/components/php/core/init.php';

// $user = DB::getInstance()->get('users', array('username', '=', 'stuart'));
$user = DB::getInstance()->update('users', 7, array(
	'username'=> 'tom2',
	'password'=> 'nsword',
	'name'    => 'bah23'

	))




// if(!$user->count()){
// 	echo 'No user';
// } else {
// 	echo $user->first()->username;
// }



?>

