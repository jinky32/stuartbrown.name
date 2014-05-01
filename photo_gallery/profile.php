<?php 
  
  include "_/components/php/header.php";


  switch (Input::get('service')) {
   	case '500px':
   		include "_/components/php/500px.php";
	   	
   		
   		break;
   	
   	default:
   		# code...
   		break;
   }


?>
    