<?php namespace Photo\DB;
//require "_/components/php/500pxhardcoded.php";



    $comsumer_key = 'I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb';
    $username = 'jinky32';
    $count = 14;



//start of api call to pull in all report items

    $ch2 = curl_init();
    // curl_setopt($ch2, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=editors&page=2&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    
    curl_setopt($ch2, CURLOPT_URL,"https://dax-rest.comscore.eu/v1/reportitemlist.xml?client=ou&user=sbrown&password=m4nch3st3r&format=json");
    // curl_setopt($ch2, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user&username={$username}&consumer_key={$comsumer_key}");
    curl_setopt($ch2 , CURLOPT_HEADER, 0);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); 

   $json2 = curl_exec($ch2);
   if(curl_errno($ch2))
   {
       // echo 'Curl error: ' . curl_error($ch2);
   }
   curl_close($ch2);
   $daxreportitems = array();

//decode json2 response
 if($json2){
      $daxreportitems = json_decode($json2,true); 
          }
  else {
      print "<p>Currently, No Service Available.</p>";
        } 

//    $rows=array();
//    for ($i=0; $i <= sizeof($daxreportitems[ri]); $i++) {   
//    print $daxreportitems[ri][$i]['id']. "<br />";  
//    print $daxreportitems[ri][$i]['path']. "<br />"; 
//    //    $rows[$daxreportitems[$i]['id']]=$daxreportitems[$i]['path'];
//    // print "rows";
//    // print_r($rows);
//   }
// print_r($daxreportitems);
//end of array call to pull in all report items








//start of api call to pull in a particular report

//     $ch = curl_init();
//     // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=editors&page=2&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    
//     curl_setopt($ch, CURLOPT_URL,"https://dax-rest.comscore.eu/v1/reportitems.xml?itemid=130&startdate=20140101&enddate=20140107&site=supersite-external&format=json&client=ou&user=sbrown&password=m4nch3st3r");
//     // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user&username={$username}&consumer_key={$comsumer_key}");
//     curl_setopt($ch , CURLOPT_HEADER, 0);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

//    $json = curl_exec($ch);
//    if(curl_errno($ch))
//    {
//        // echo 'Curl error: ' . curl_error($ch);
//    }
//    curl_close($ch);
//    $dax = array();

// //decode json response
//  if($json){
//       $dax = json_decode($json,true); 
//           }
//   else {
//       print "<p>Currently, No Service Available.</p>";
//         } 

//end of array call to pull in a particular report


// $columns=array();
// for ($i=0; $i <= sizeof($dax[reportitems]['reportitem'][0][columns][column]); $i++) { 
//   $columns[]=$dax[reportitems]['reportitem'][0][columns][column][$i];

//  print $columns[$i]['ctitle']."<br />";
//     //print "this is key ". $key . " and this is value" . $value ."<br />";

  
// }






?>

