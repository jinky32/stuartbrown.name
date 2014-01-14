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
              include "_/components/php/header.php";
              include "_/components/php/youtubeapi.php";
              if(isset($_GET['title'])){
                $title=$_GET['title'];
                print "<h1>$title</h1>";
              } else {
                print "<h1>Hello World!</h1>";
              }
              //print_r($obj->photos[1]);
              //print_r($photoname);

              $arraykey=array_keys($photoname); // put the keys of $photoname into $arraykey.  This will be
              //used below to try and match $title (of image) to its array key.


foreach ($arraykey as $key => $value) { //break apart $arraykey to use the key
 if($photoname[$key]==$title){ // test if the value at position $photoname[key] is the same as current $title.  If it is we know the key of the array in $obj->photos that we want
  $photoarray=$obj->photos[$key]; // the test has returned true.  Now grab the whole array for that photo and put it in $photarray.
  
 } 
}
//print $photoarray->image_url; //print out the URL of the image.
//print_r($obj->photos[$key]);

            ?>
    
      <div class="container">
        <div class="jumbotron">
          <?php //print the selected image into the bootstrap jumbotron. str_replace to get larger iage
            //print "<img src=". str_replace('/3.', '/4.', $photoarray->image_url)">";
             print '<img src=\''.str_replace('/3.', '/4.', $photoarray->image_url).'\' class=\'img-responsive img-rounded img-centred\');>';
          ?>
        </div>
        <div class="content row">
          <div class="main col col-lg-8">
            <form method="post" action="">
              <select name="playlistselect" id="input" class="form-control" required="required">
              <?php
               
              //combine the values from $playlist_id and $playlist_title (passed from youtubeapi.php) into an array $test
                $test=array_combine($playlist_id, $playlist_title); //I THINK THE KEY MAY BE WRONG HERE. 
                //WHEN I USE BELOW IT DOESNT BRING BACK VIDEOS IN A PLAYLIST AND LOOKS LIKE 
                //http://gdata.youtube.com/feeds/api/users/jinky32/playlists/PLEtmlR7ubZ2nfQnDVkTGWDNzd4M8towxb
                foreach($test as $key => $value){ // break the array apart to be used in select list 
                  $key=str_replace("http://gdata.youtube.com/feeds/api/users/jinky32/playlists/","",$key); //I only want the ID
                  print "<option value='$key'>$value</option>";
                }
                print "</select>
                      <input type='submit' class='btn btn-default' name='youtube' id='youtube' value='submit'>
                        </form>";
                  if (isset($_POST['playlistselect'])){ //when the form is submitted use the value (which will be the ID of a playlist) to create a new request to YouTube API
                    $chosen_playlist="https://gdata.youtube.com/feeds/api/playlists/".$_POST["playlistselect"]; //set URI to be used
                    print $chosen_playlist;
                  } else {
                    print "false";
                  }

                $specific_playlist=simplexml_load_file($chosen_playlist); // load the URI ($chosen_playlist above) and parse
                $video_title=array(); //initiate $video_title array - this will house all videos in the returned array
                $video_array=array(); //initiate $video_array array - this will contain all the titles of the videos
                //I THINK THERE NEEDS TO BE ANOTHER ARRAY HERE AND IN THE FOREACH BELOW TO GET THE VIDEO ID / URL - DONE NOW through below arrays
                $video_uri=array();
                $video_uri2=array();
                $i=0;
                foreach ($specific_playlist->entry as $playlist_videos) {
                  $video_title[]=$playlist_videos;
                  $video_array[]=$video_title[$i]->title;
                  $video_uri[]=$video_title[$i]->link;
                  $video_uri2[]=$video_uri[$i]->attributes()->href;
                  //print "<p>" . $video_title[$i]->title . "</p><br />";
                  $i++;
                
                  //print $playlist_videos;
                }

                print_r($video_uri2);
                //I THINK I NOW NEED TO SPLIT $VIDEO_URI2 ADN USE EITHER THE KEY OR VALUE AND ARRAY_COMBINE WITH THE TITLE ($VIDEO_TITLE??)

                // $newvidtitle=array();
                // foreach ($video_title as $key => $value) {
                //   print "this is key $key and this is value $value";
                //   //$newvidtitle[]=$vid_titles;
                // }

                // $stuart=array();
                // for($i=0;$i<sizeof($video_title);$i++){
                //   $video_title[$i]=$stuart;

                // }
                

// foreach ($xml->entry as $playlists) {
//   $playlist_title[]=$playlists->title;
//     $playlist_id[]=$playlists->id;
// }
              //print_r($video_title);
             // print_r($specific_playlist);
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