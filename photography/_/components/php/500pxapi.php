<?php namespace Photo\DB;
require "_/components/php/500pxhardcoded.php";

    $comsumer_key = 'I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb';
    $username = 'jinky32';
    $count = 14;

    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=editors&page=2&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    
    curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user_favorites&username=jinky32&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user&username={$username}&consumer_key={$comsumer_key}");
    curl_setopt($ch , CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

   $json = curl_exec($ch);
   if(curl_errno($ch))
   {
       // echo 'Curl error: ' . curl_error($ch);
   }
   curl_close($ch);
   $obj = array();

//decode json response
 if($json){
      $obj = json_decode($json); 
          }
  else {
      print "<p>Currently, No Service Available.</p>";
        } 


$nonunique=array(); //initiate $nonunique array.  This will hold the full list of category IDs from the 500px API.  $categories below will be used to get only unique IDs in order to create the primary navigation.

$photoname=array(); // intitiate $photoname array.  Holds the names of the photographs from the API array

$categories=array(); // intitiate $categories array.  This will be filtered to contain only unique values to drive the primary navigation labels.

foreach ($obj->photos as $photos_500px){ //loop through photos and set values of arrays
    $categories[]=$photos_500px->category;
    $nonunique[]=$photos_500px->category;
    $photoname[]=$photos_500px->name;
 
    }
    $combined=array_combine($photoname, $nonunique); 


//break apart the $combined array and insert the values into the database.  The db then contains all the items 
//from 500px that i have favourited.
    foreach ($combined as $key => $value) {
    if ( $conn ) { //break the array apart and pass value for insert to the query() function in functions.php
      $combinedquery=query("INSERT INTO images(photo_title, cat_id) 
        VALUES (:photo_title, :cat_id)
        ON DUPLICATE KEY UPDATE photo_title = VALUES(photo_title)",
      array('photo_title'=>$key, 'cat_id'=>$value), //bind the values
      $conn);
    } else {
      print "could not connect to the database";
    }
  }

//check if there are values in the images table of the dtabase.  this will be used below to test against API values
if ( $conn ) {
      $photos_database=query2("SELECT cat_id, photo_title FROM images", 
      $conn);
} else {
      print "could not connect to the database";
}

//below is the same script as used in 500pxhardcoded.php.  It checks the values from 500px api with the values in the database
//values from 500px api are the master so if there is a difference then the db is updated with api data


if (!empty($photos_database)){  //if there are values in the images table

  $photoarray_database=array(); //initiate $photoarray_database
  
  for ($i=0; $i < sizeof($photos_database); $i++) { //loop through the array  and fill $photoarray_database with the cat_id
    $photoarray_database[]=$photos_database[$i]['cat_id'];
    $photoarray_database_label[]=$photos_database[$i]['photo_title'];
  }
  //print_r($photoarray_database);
  // print_r($photoarray_database_label);


  $photoarray_database_combined=array_combine($photoarray_database_label, $photoarray_database); // combine the values into a new array.  This is used to compare with the images returned from the 500px api with the images from the database.
  // print_r($photoarray_database_combined);
  // print_r($categories);

  $photodiff = array_diff($photoarray_database_combined, $combined);  // compare the two arrays and then print the result.  Values of $combined are the master since they come from api.

  // print_r($photodiff);
  //if there are differences between the two arrays then remove from database.  Additions are delat with thorugh the initial insert which deals with ON DUPLICATE KEY 
  if($photodiff){ // if there is a difference use that cat_id in a delete statement
    foreach ($photodiff as $key => $value) { //break apart array to get cat_id value
      $photodelete=delete("DELETE FROM images where cat_id=$value",$conn);
    }
    
  }

}


//then select from the table and use the results to get a unique array_unique() as below.

$photoarray_database=array_unique($photoarray_database); //make photoarray_database contian only unique category ID from API in order to create primary nav labels

$catkeys = array(); //initiate $catkeys array
foreach($photoarray_database as $key => $value){ //loop through $photoarray_database
  $catkeys[$value] = ""; // assign $value (e.g. 9, 12 , 24 etc) as the key and give each an empty value.
}

$intersect = array_intersect_key($catarray_database_combined, $catkeys); //create an array of the items in $catarray_database_combined (from 500pxhardcoded.php) and $catkeys that 
//are the same.  This is what will go into the primary nav

?>