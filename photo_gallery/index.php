<?php
require_once '_/components/php/core/init.php';

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') .'</p>';
}

$user= new User();
//echo $user->data()->username;  //this will get the username using the data method of the User class

if($user->isLoggedIn()){
?>
<p>Hello <a href="#"><?php echo escape($user->data()->username);?></a>!</p>
<ul>
	<li><a href="logout.php">Logout</a></li>
	<li><a href="update.php">update details</a></li>
	<li><a href="changepassword.php">Change password</a></li>
</ul>
<?php

//permission stuff taken from https://www.youtube.com/watch?v=_Y-3YfVxIas
if($user->hasPermission('moderator')){
	echo '<p> you are an moderator</p>';
}

} else {
	echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a></p>';
}

// $user = DB::getInstance()->get('users', array('username', '=', 'stuart'));
// $user = DB::getInstance()->update('users', 7, array(
// 	'username'=> 'tom2',
// 	'password'=> 'nsword',
// 	'name'    => 'bah23'

// 	))




// if(!$user->count()){
// 	echo 'No user';
// } else {
// 	echo $user->first()->username;
// }



?>

