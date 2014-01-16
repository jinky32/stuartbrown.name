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
          <div class="main col col-lg-8">
            <form method="post" action="">
              <select name="playlistselect" id="input" class="form-control" required="required">
              <?php
               
              //combine the values from $playlist_id and $playlist_title (passed from youtubeapi.php) into an array $playlist_combined
                $playlist_combined=array_combine($playlist_id, $playlist_title); 

                foreach($playlist_combined as $key => $value){ // break the array apart to be used in select list 
                  $key=str_replace("http://gdata.youtube.com/feeds/api/users/jinky32/playlists/","",$key); //I only want the ID
                  print "<option value='$key'>$value</option>";
                }
                print "</select>
                      <input type='submit' class='btn btn-default' name='youtube' id='youtube' value='submit'>
                        </form>";
                  if (isset($_POST['playlistselect'])){ //when the form is submitted use the value (which will be the ID of a playlist) to create a new request to YouTube API
                    $chosen_playlist="https://gdata.youtube.com/feeds/api/playlists/".$_POST["playlistselect"]; //set URI to be used
                    //print $chosen_playlist;
                  } else {
                    print "false";
                  }

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

                  //I THINK I NEED TO CLEAN UP $youtube_second_api_call AS PER THE ABOVE LINE.  MAY NEED TO DO THIS THROUGH FOR ($I++) LOOP THOUGH
                }

                $playlist_combined=array_combine($youtube_second_api_call, $video_titles);
                //print_r($playlist_combined);
                print "<select name='playlistselect' id='input' class='form-control' required='required'>";
                foreach ($playlist_combined as $pckey => $pcvalue) {
                  print "<option value='$pckey'>$pcvalue</option>";
                }
                print "</select>
                      <input type='submit' class='btn btn-default' name='youtube2' id='youtube2' value='submit'>
                        </form>";
            
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