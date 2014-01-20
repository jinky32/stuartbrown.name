<?php namespace Photo\DB;

require '_/components/php/config.php';
require "_/components/php/functions.php";
	$conn = connect($config);
	
	$sitecategories = array(
	    0 => "Uncategorized",11 => "Animals", 5 => "Black and White", 
	    15 => "Commercial", 16 => "Concert",  14 => "Fashion", 2 => "Film", 24 => "Fine Art", 23 => "Food",
	    3 => "Journalism", 8 => "Landscapes", 18 => "Nature", 4 => "Nude", 7 => "People", 19 => "Performing Arts",
	    25 => "Wedding", 100 => "teeeest", 105 => "stuartbrown"
	    );
	  $i=0;
	
	foreach ($sitecategories as $key => $value) {
		  if ( $conn ) {
		    $catquery=query("INSERT INTO categories(cat_id, label)
			    VALUES (:catid, :label)
			    ON DUPLICATE KEY UPDATE label = VALUES(label)",
		    array('catid'=>$key, 'label'=>$value),
		$conn);
		  } else {
		    print "could not connect to the database";
		  }
		}
		
//		$cat_id2=catid;
//				$label2=label;
//				 if ( $conn ) {
//				    $catquery2=query("select :label2, :cat_id2 from categories",
//				    array('cat_id2'=>$cat_id2, 'label2'=>$label2),
//				$conn);
//				  } 
//				print_r($results); 
	//var_dump(array_diff_key($sitecategories, $results));			

//	foreach ($sitecategories as $key => $value) {
//	  if ( $conn ) {
//	    $catquery=query("INSERT INTO categories(cat_id, label)
//		    VALUES (:catid, :label)
//		    ON DUPLICATE KEY UPDATE label = VALUES(label)",
//	    array('catid'=>$key, 'label'=>$value),
//	$conn);
//	  } else {
//	    print "could not connect to the database";
//	  }
//	}

//	INSERT INTO categories(catid, label)
//	    VALUES (:cat_id, :label)
//	    ON DUPLICATE KEY UPDATE label = VALUES(label);
// 20 => "Family",  INSERT IGNORE
//    $categories=`categories`;

//	$label="macro";
//	if ($conn) {
//	$newsitecategories=query("SELECT cat_id, label FROM categories WHERE label=:label",
//	array('label' => $label),
//	$conn);
//	print_r($newsitecategories);
//	} else {
//		print "Doesn't work";
//	}
//	
//	if ( $conn ) {
//		
//		$row = query("SELECT * FROM users WHERE id = :id",
//					  array('id' => $id),
//					  $conn)[0];
//	}
?>