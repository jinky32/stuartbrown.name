<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>
    <?php 



// for($i=0; $i<sizeof($sitecategories); $i++){
// print $sitecategories[$i];
// };


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


 if($json){
            $obj = json_decode($json); 
                    }
          else {
            print "<p>Currently, No Service Available.</p>";
                } 


$sitecategories = array(
    0 => "Uncategorized", 10 => "Abstract", 11 => "Animals", 5 => "Black and White", 1 => "Celebrities", 9 => "City and Architecture",
    15 => "Commercial", 16 => "Concert", 20 => "Family", 14 => "Fashion", 2 => "Film", 24 => "Fine Art", 23 => "Food",
    3 => "Journalism", 8 => "Landscapes", 12 => "Macro", 18 => "Nature", 4 => "Nude", 7 => "People", 19 => "Performing Arts",
    17 => "Sport", 6 => "Still Life", 21 => "Street", 26 => "Transportation", 13 => "Travel", 22 => "Underwater",
    27 => "Urban Exploration", 25 => "Wedding"
    );
// $valuecat = array_values($sitecategories);
// print_r($sitecategories) ;

foreach ($sitecategories as $keycat => $valuecat) {
  print "<p>this is keycat $keycat and this is valuecat $valuecat</p>";
  //$keycat=array($keycat);
 // print_r($keycat);
}

$categories=array();
foreach ($obj->photos as $photo){
    $categories[]=$photo->category;
}
$categories=array_unique($categories);

 //print_r($keycat);

//from stuart c
$catkeys = array();
foreach($categories as $key => $value){ 
	$catkeys[$value] = "";
}

$intersect = array_intersect_key($sitecategories, $catkeys);

//end from stuart c

print_r($sitecategories);
print_r($catkeys);
print_r($intersect);


// basically, takes your last bit of displaying the values you are interseted in
// S.A.Crouch: (14:07)
// and instead creates an array
// S.A.Crouch: (14:07)
// where the value is the key
// S.A.Crouch: (14:08)
// that key is given an empty value
// S.A.Crouch: (14:08)
// so now you have to key / value arrarys
// S.A.Crouch: (14:08)
// where the key is always a number
// S.A.Crouch: (14:08)
// so you should be able to do an array intersect on the keys
// S.A.Crouch: (14:29)
// You were close with your code
// S.A.Crouch: (14:30)
// but you were trying to use array_intersect
// S.A.Crouch: (14:30)
// which compares values
// S.A.Crouch: (14:30)
// and what you needed to compare was keys :)
// S.A.Crouch: (14:30)
// which meant creating a new array with the old value as the new key (And the new value as anything you wanted)



foreach($categories as $key => $value){
  $value=array($value);
 //print_r($value);
    foreach($value as $k => $v){
      //print "<p>this is key $key and this is value $v</p><br />";

      
    }





  //$value[]=$value;
  //print gettype($value);
  //$intersection = array_intersect($value, $keycat);

  //print "<p>this is key $key and this is value $value</p><br />";
  //print_r($intersection);

//I THINK THAT IN THE FOREACH ABOVE I NEED TO CAST $VALUE AS AN ARRAY AND THEN FOREACH THOUGH TO GET REAL VALUE AND THEN 
 // MATCH THAT AGAINS THE VALUE OF $KEYCAT
  
//if (in_array($value, $intersection)) {
    // both arrays contain $value
}
//   print "<p>this is key - $key and this is value - $value</p><br />";
//   if($value=$keycat){
//     print "<h1>value is $value and keycat id $keycat</h1>";
//   } else {
//     print "<h1>NOPE!</h1>";
//   }
//}


//print implode(', ', $categories); // will show a string 9, 1, 2

//print_r($categories);


                ?>




  </body>
</html>