<?php 
  require_once '_/components/php/core/init.php';
  include "_/components/php/header.php";

//taken from https://www.youtube.com/watch?v=BiTG6AqNWEs

//check if we don't have a username suplied.  This will print any name passed via URL. the else statement checks that the user actually exists
if(!$username = Input::get('user')){
	Redirect::to('index.php');
} else { //check whether the user exisrs.  Uses the user class 
	$user = new User($username);
	if(!$user->exists()) {
		Redirect::to(404);
	} else { //now we know it does exist set $data to User->data() which returns a users data
		$data = $user->data();
		// print 'hie' . $data->username;
	}}


  switch (Input::get('service')) {
   	case '500px':
   		include "_/components/php/500px.php";
	   	
   		
   		break;
   	
   	default:
   		# code...
   		break;
   }


?>
    