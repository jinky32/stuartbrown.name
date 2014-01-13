<?php
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

//create as array of the 500px categories and category ID.  Only ID is returned in the API array so the label needs to be matched later
$sitecategories = array(
    0 => "Uncategorized", 10 => "Abstract", 11 => "Animals", 5 => "Black and White", 1 => "Celebrities", 9 => "City and Architecture",
    15 => "Commercial", 16 => "Concert", 20 => "Family", 14 => "Fashion", 2 => "Film", 24 => "Fine Art", 23 => "Food",
    3 => "Journalism", 8 => "Landscapes", 12 => "Macro", 18 => "Nature", 4 => "Nude", 7 => "People", 19 => "Performing Arts",
    17 => "Sport", 6 => "Still Life", 21 => "Street", 26 => "Transportation", 13 => "Travel", 22 => "Underwater",
    27 => "Urban Exploration", 25 => "Wedding"
    );
//end of 500pc categories array



$nonunique=array(); //initiate $nonunique array.  This will hold the full list of category IDs from the 500px API.  $categories below will be used to get only unique IDs in order to create the primary navigation.

$photoname=array(); // intitiate $photoname array.  Holds the names of the photographs from the API array

$categories=array(); // intitiate $categories array.  This will be filtered to contain only unique values to drive the primary navigation labels.

foreach ($obj->photos as $photo){ //loop through photos and set values of arrays
    $categories[]=$photo->category;
    $nonunique[]=$photo->category;
    $photoname[]=$photo->name;
 
    }
    $combined=array_combine($photoname, $nonunique); 



$categories=array_unique($categories); //make categories contian only unique category ID from API in order to create primary nav labels

$catkeys = array(); //initiate $catkeys array
foreach($categories as $key => $value){ //loop through $categories
  $catkeys[$value] = ""; // assign $value (e.g. 9, 12 , 24 etc) as the key and give each an empty value.
}

$intersect = array_intersect_key($sitecategories, $catkeys); //create an array of the items in $sitecategories and $catkeys that 
//are the same.  This is what will go into the primary nav


?>