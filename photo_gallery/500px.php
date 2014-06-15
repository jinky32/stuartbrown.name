<?php
//include "_/components/php/500nav.php";

//THESE SWITCH STATEMENTS SHOULD GO INTO THE INPUT CLASS AS A METHOD AND BE REMOVED FROM THESE FILES 

// if(Input::get('service') && !Input::get('feature')) {
// 	  	print '<h1>'.Input::get('service').'</h1>';
// 	} 


switch (Input::get('feature')) {
	case 'user_favorites':
		//print '<h1>'. Input::get('service').' '.Input::get('feature').'</h1>';
		include "500px_user_favorites.php";
		break;
	
	default:
		include "500px_user.php";
		//print '<h2>this should appear on the 500px page but not user favorites</h2>';
		break;
} 

//print 'hie' . $data->username;

?>

