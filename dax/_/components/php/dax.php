<?php namespace Photo\DB;
//require "_/components/php/500pxhardcoded.php";



    $comsumer_key = 'I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb';
    $username = 'jinky32';
    $count = 14;

    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=editors&page=2&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    
    curl_setopt($ch, CURLOPT_URL,"https://dax-rest.comscore.eu/v1/reportitems.xml?itemid=38&startdate=20140101&enddate=20140107&site=supersite-external&format=json&client=ou&user=sbrown&password=m4nch3st3r");
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user&username={$username}&consumer_key={$comsumer_key}");
    curl_setopt($ch , CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

   $json = curl_exec($ch);
   if(curl_errno($ch))
   {
       // echo 'Curl error: ' . curl_error($ch);
   }
   curl_close($ch);
   $dax = array();

//decode json response
 if($json){
      $dax = json_decode($json,true); 
          }
  else {
      print "<p>Currently, No Service Available.</p>";
        } 
// print_r($dax);
//var_dump($dax);
// echo $dax[reportitems]['reportitem'];
$i=0;
while (sizeof($dax[reportitems]['reportitem'][0]['column'])>$i) {
  print $dax[reportitems]['reportitem'][0]['column']['ctitle'];
  $i++;
}




// echo $dax->reportitems['reportitem']->0->columns['column']->0->ctitle;
// print_r($dax->reportitems[reportitem]);
// echo $results[0]->address_components[0]->long_name;



// $key=array();
// foreach ($dax[reportitems][reportitem] as $key => $value) {
//   foreach ($value as $key => $value2) {
//     foreach ($value2 as $key3 => $value3) {
//       print "this is key $key3 and this is value $value3<br />";
//     }

      
//       }
//   }
  
// }
//print "<h1>$value[columns]</h1>";

// $nonunique=array(); //initiate $nonunique array.  This will hold the full list of category IDs from the 500px API.  $categories below will be used to get only unique IDs in order to create the primary navigation.

// $photoname=array(); // intitiate $photoname array.  Holds the names of the photographs from the API array

// $categories=array(); // intitiate $categories array.  This will be filtered to contain only unique values to drive the primary navigation labels.

// foreach ($dax->photos as $photos_500px){ //loop through photos and set values of arrays
//     $categories[]=$photos_500px->category;
//     $nonunique[]=$photos_500px->category;
//     $photoname[]=$photos_500px->name;
 
//     }
//     $combined=array_combine($photoname, $nonunique); 

?>