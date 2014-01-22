<?php namespace Photo\DB;

            require "_/components/php/functions.php";
              //include "_/components/php/header.php";
              include "_/components/php/youtubeapi.php";
              $conn = connect($config);

       //create as array of the 500px categories and category ID.  Only ID is returned in the API array so the label needs to be matched later
$sitecategories = array(
    0 => "Uncategorized", 10 => "Abstract", 11 => "Animals", 5 => "Black and White", 1 => "Celebrities", 9 => "City and Architecture",
    15 => "Commercial", 16 => "Concert", 20 => "Family", 14 => "Fashion", 2 => "Film", 24 => "Fine Art", 23 => "Food",
    3 => "Journalism", 8 => "Landscapes", 12 => "Macro", 18 => "Nature", 4 => "Nude", 7 => "People", 19 => "Performing Arts",
    17 => "Sport", 6 => "Still Life", 21 => "Street", 26 => "Transportation", 13 => "Travel", 22 => "Underwater",
    27 => "Urban Exploration", 25 => "Wedding"
    );
//end of 500pc categories array



$catarray_harcoded=array(); //initiate $catarray_harcoded
foreach ($sitecategories as $key => $value) { //split $sitecateogres and put the key (cat_id) in an array for comparison to db values below
$catarray_harcoded[]=$key; //put the cat_id into an array for comparison to values from the database later.  If in the db but not in the hardcoded we delete from db
}
 
//query to db and put in results in $categories_database. may be used later to create primary nav.  Also used to craetea test. if empty we need to insert into db 
if ( $conn ) {
      $categories_database=query2("SELECT cat_id, label FROM categories", 
      $conn);
} else {
      print "could not connect to the database";
}
  //print_r($catarray_harcoded); 

//if (empty($categories_database)){  //if the database is empty insert the values from 500pxapi.php

//get the $sitecategories array from the 500pxapi file which is included in the header.php file and put into the database
  foreach ($sitecategories as $key => $value) {
    if ( $conn ) { //break the array apart and pass value for insert to the query() function in functions.php
      $catquery=query("INSERT INTO categories(cat_id, label) 
        VALUES (:catid, :label)
        ON DUPLICATE KEY UPDATE label = VALUES(label)",
      array('catid'=>$key, 'label'=>$value), //bind the values
      $conn);
    } else {
      print "could not connect to the database";
    }
  }
//} 

//the above (lines 48++ need to be uncommented. only out because they will restore all values when index.php loads and affects testing)
//the below gets the cat_id from the hard coded categories array and the cat_id from the categories in the database
//if there is a difference between the two the difference (a cat_id) should be used to delete a row from the database



if (!empty($categories_database)){

  $catarray_database=array(); //initiate $catarray_database
  
  for ($i=0; $i < sizeof($categories_database); $i++) { //loop through the array  and fill $catarray_database with the cat_id
    $catarray_database[]=$categories_database[$i]['cat_id'];
    $catarray_database_label[]=$categories_database[$i]['label'];
  }

  $catarray_database_combined=array_combine($catarray_database, $catarray_database_label); // combine the values into a new array.  This is used to compare with the data from the 500px api (in 500pxapi.php) to check the cateogires the favourited items belong to.  If the cat_ids match then the related label is printed out as the primary navigation
  //print_r($catarray_database);

  $result = array_diff($catarray_database, $catarray_harcoded);  // compare the two arrays and then print the result.  Values of $catarray_harcoded are the master since hard coded.
  //if the are removed from there they should be removed fro mDB
  //print_r($result);

  if($result){ // if there is a difference between the cat_id in the db and those in the hard coded array then use that cat_id in a 
    //delete statement
    foreach ($result as $key => $value) { //break apart array to get cat_id value
      $deleteitem=delete("DELETE FROM categories where cat_id=$value",$conn);
    }
    
  }

}









?>