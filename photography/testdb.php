<?php namespace Photo\DB;

require '_/components/php/config.php';
//$config=array(
//	'DB_USERNAME'=>'stuartbrown',
//	'DB_PASSWORD'=>'m4nch3st3r'
//	);


	$sitecategories = array(
	    0 => "Uncategorized", 10 => "Abstract", 11 => "Animals", 5 => "Black and White", 1 => "Celebrities", 9 => "City and Architecture",
	    15 => "Commercial", 16 => "Concert", 20 => "Family", 14 => "Fashion", 2 => "Film", 24 => "Fine Art", 23 => "Food",
	    3 => "Journalism", 8 => "Landscapes", 12 => "Macro", 18 => "Nature", 4 => "Nude", 7 => "People", 19 => "Performing Arts",
	    17 => "Sport", 6 => "Still Life", 21 => "Street", 26 => "Transportation", 13 => "Travel", 22 => "Underwater",
	    27 => "Urban Exploration", 25 => "Wedding"
	    );
	
	foreach ($sitecategories as $key => $value) {
		//print "this is key $key and this is value $value";
	}
	
	
	require "_/components/php/functions.php";
	$conn = connect($config);
	
//	    if ( $conn ) {
//
//	  $catquery=query("INSERT into categories (cat_id, label) VALUES (:catid, :label)",
//	        array('catid'=>1, 'label'=>'stuartbrown'),
//	        $conn);
//	} else {
//	  print "could not connect to the database";
//	}

	foreach ($sitecategories as $key => $value) {
//	    print "this is key $key and this is value $value";
	    if ( $conn ) {
	  //$id = isset($_GET['id']) ? (int)$_GET['id'] : 25;
	  // $row = query("SELECT * FROM categories WHERE id = :id",
	  //         array('id' => $id),
	  //         $conn);
	  $catquery=query("INSERT into categories (cat_id, label) VALUES (:catid, :label)",
	        array(':catid'=>$key, ':label'=>$value),
	        $conn);
	} else {
	  print "could not connect to the database";
	}
	  }
?>