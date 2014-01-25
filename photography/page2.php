<?php namespace Photo\DB;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 STuart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Bree+Serif|Merriweather:400,300,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="_/css/bootstrap.css" rel="stylesheet">
    <link href="_/css/mystyles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

  </head>
  <body id="page2">
    <?php 
             // require "_/components/php/functions.php";
              include "_/components/php/header.php";
              // include "_/components/php/youtubeapi.php";
              //$conn = connect($config);



// $catarray_harcoded=array(); //initiate $catarray_harcoded
// foreach ($sitecategories as $key => $value) { //split $sitecateogres and put the key (cat_id) in an array for comparison to db values below
// $catarray_harcoded[]=$key; //put the cat_id into an array for comparison to values from the database later.  If in the db but not in the hardcoded we delete from db
// }
 
// //query to db and put in results in $categories_database. may be used later to create primary nav.  Also used to craetea test. if empty we need to insert into db 
// if ( $conn ) {
//       $categories_database=query2("SELECT cat_id, label FROM categories", 
//       $conn);
// } else {
//       print "could not connect to the database";
// }
//   //print_r($catarray_harcoded); 

// //if (empty($categories_database)){  //if the database is empty insert the values from 500pxapi.php

// //get the $sitecategories array from the 500pxapi file which is included in the header.php file and put into the database
//   foreach ($sitecategories as $key => $value) {
//     if ( $conn ) { //break the array apart and pass value for insert to the query() function in functions.php
//       $catquery=query("INSERT INTO categories(cat_id, label) 
//         VALUES (:catid, :label)
//         ON DUPLICATE KEY UPDATE label = VALUES(label)",
//       array('catid'=>$key, 'label'=>$value), //bind the values
//       $conn);
//     } else {
//       print "could not connect to the database";
//     }
//   }
// //} 

// //the above (lines 48++ need to be uncommented. only out because they will restore all values when index.php loads and affects testing)
// //the below gets the cat_id from the hard coded categories array and the cat_id from the categories in the database
// //if there is a difference between the two the difference (a cat_id) should be used to delete a row from the database



// if (!empty($categories_database)){

//   $catarray_database=array(); //initiate $catarray_database
  
//   for ($i=0; $i < sizeof($categories_database); $i++) { //loop through the array  and fill $catarray_database with the cat_id
//     $catarray_database[]=$categories_database[$i]['cat_id'];
//   }
//   //print_r($catarray_database);

//   $result = array_diff($catarray_database, $catarray_harcoded);  // compare the two arrays and then print the result.  Values of $catarray_harcoded are the master since hard coded.
//   //if the are removed from there they should be removed fro mDB
//   //print_r($result);

//   if($result){ // if there is a difference between the cat_id in the db and those in the hard coded array then use that cat_id in a 
//     //delete statement
//     foreach ($result as $key => $value) { //break apart array to get cat_id value
//       $deleteitem=delete("DELETE FROM categories where cat_id=$value",$conn);
//     }
    
//   }

// }

              
              if(isset($_GET['title'])){
                $title=$_GET['title'];
                print "<h1>$title</h1>";
              } else {
                print "<h1>Hello World!</h1>";
              }
              

              $arraykey=array_keys($photoname); 
              // put the keys of $photoname (from 500pxapi.php) into $arraykey.  This will be used below to try and match $title (of image) to its array key.


              foreach ($arraykey as $key => $value) { //break apart $arraykey to use the key
               if($photoname[$key]==$title){ // playlist_combined if the value at position $photoname[key] is the same as current $title.  If it is we know the key of the array in $obj->photos that we want
                $photoarray=$obj->photos[$key]; // the playlist_combined has returned true.  Now grab the whole array for that photo and put it in $photarray.
                
                                            } 
              }
//MIGHT WANT TO ADD SOME MORE INFORMATION ON THE PHOTO - FOR EXAMPLE THE PHOTOGRAPHER, LINK BACK TO 500PX ETC ETC. ALL THIS IS IN $PHOTOARRAY()?
    ?>
    
      <div class="container">
        <div class="jumbotron">
          <?php //print the selected image into the bootstrap jumbotron. str_replace to get larger iage
             print '<img src=\''.str_replace('/3.', '/4.', $photoarray->image_url).'\' class=\'img-responsive img-rounded img-centred\');>';
          ?>
        </div>
        <div class="content row">
          <div class="main col col-lg-12">
            <div class="forms col-lg-6">
            
              
                <?php
//beginning of youtube integration


                  $playlist_combined=array_combine($playlist_id, $playlist_title); 
                  print "playist playlist_combined";

                  print "<form method='post' action=''>
                        <select multiple='multiple' class='form-control'  
                         name='playlistselect' id='playlistselect' required='required' style='height: 169px;''>";
                  foreach($playlist_combined as $key => $value){ // break the array apart to be used in select list 
                    $key=str_replace("http://gdata.youtube.com/feeds/api/users/jinky32/playlists/","",$key); //I only want the ID
                    print "<option value='$key'>$value</option>";
                  }

                  print "</select>
                     <input type='submit' class='btn btn-default' name='youtube' id='youtube' value='submit'>
                      </form></div>";
     
                if (isset($_POST['playlistselect'])){ //when the form is submitted use the value (which will be the ID of a playlist) to create a new request to YouTube API
                  $playlist_selected=$_POST["playlistselect"];
                  $chosen_playlist="https://gdata.youtube.com/feeds/api/playlists/".$_POST["playlistselect"]; //set URI to be used
                  //print $chosen_playlist;
                  $specific_playlist=simplexml_load_file($chosen_playlist); // load the URI ($chosen_playlist above) and parse


                  $videos=array(); //initiate $videos array - this will house all videos in the returned array
                  $video_titles=array(); //initiate $video_titles array - this will contain all the titles of the videos
                  $video_url=array(); //initiate $video_url which will hold the urls of the videos
                  $i=0;
                  
                  foreach ($specific_playlist->entry as $playlist_videos) {
                    $videos[]=$playlist_videos;
                    $video_titles[]=$videos[$i]->title;
                    $video_url[]=$videos[$i]->link->attributes()->href;
                    $i++;
                  }

                  $youtube_second_api_call=array();
                  $i=0;
                  foreach ($video_url as $ytkey => $youtube_id) {
                    $youtube_second_api_call[$i]=str_replace("&feature=youtube_gdata", "", $youtube_id);
                    $i++;
                    //$youtube_second_api_call=str_replace("&feature=youtube_gdata", "", $youtube_second_api_call);
                  }

                  $youtube_combined=array_combine($youtube_second_api_call, $video_titles);

                  if($youtube_combined){
                    if ( $conn ) {
                  foreach ($youtube_combined as $youtube_combined_key => $youtube_combined_value) {
                  $combinedquery=query("INSERT INTO videos(video_label, video_url) 
                  VALUES (:video_label, :video_url)
                  ON DUPLICATE KEY UPDATE video_label = VALUES(video_label)",
                  array('video_label'=>$youtube_combined_value, 'video_url'=>$youtube_combined_key), //bind the values
                  $conn);
                  }
                }
                } else {
                  //print "<option value='#'>Choose a video</option>";
                }

                } 

           

                  
                  //print_r($playlist_combined);
                  print "<div class='forms col-lg-6'><form method='post' action=''>
                          <select name='videoselect[]' multiple='multiple' id='input' class='form-control' required='required' style='height: 169px;'>";
                             
                if($youtube_combined){
                  foreach ($youtube_combined as $youtube_combined_key => $youtube_combined_value) {
                  print "<option value='$youtube_combined_key'>$youtube_combined_value</option>";
                  }
                } else {
                  //print "<option value='#'>Choose a video</option>";
                }
                  
                  print "</select>
                        <input type='submit' class='btn btn-default' name='youtube2' id='youtube2' value='submit'>
                          </form></div>";
                        $i=0;
                        $embed_array=array();
     //IS IT BETTER TO USE SOME FORM OF !EMPTY SO THAT THE VALUES PERSIST IN THE BOX AFTER THEY ARE SELECTED?
                        if(isset($_POST['videoselect'])){
                            foreach ($_POST['videoselect'] as $skey => $yt_embed_url) {
                                $embed_value=str_replace("https://www.youtube.com/watch?v=", "", $yt_embed_url);
                               // print "this is key $embkey and this is yt_embed_url $embed_value<br />";
                          

                              
                              print "<div class='content row'>
                          <div class='videos_and_comments col col-lg-12'>
                             <div class='videos col-lg-6'>
                               <iframe width='420' height='315' src='http://www.youtube.com/embed/".$embed_value."' frameborder='0' allowfullscreen></iframe>
                             </div>
                             <div class='videos col-lg-6'>
                              <textarea class='form-control' id='$embed_value' rows='15'></textarea>
                             </div>
                           </div>
                         </div> ";
                         $i++;
                            }
                        }


            ?>

           
          </div><!-- end of main -->
          
          <div class="sidebar col col-lg-4">
            
            
          </div> <!-- end of sidebar -->
        </div><!-- end content -->
        

      </div> <!-- end of container -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
  </body>
</html>