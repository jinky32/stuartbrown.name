<?php 
       // require "_/components/php/functions.php";
        include "_/components/php/header.php";
        // include "_/components/php/youtubeapi.php";
        //$conn = connect($config);

        
        // if(isset($_GET['title'])){
        //   $title=$_GET['title'];
        //   $category=$_GET['category'];
        //   print "<h1>$title - $category</h1>";
        // } else {
        //   print "<h1>Hello World!</h1>";
        // }
              
  

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

        print "<form method='post' action=''>
              <select multiple='multiple' class='form-control'  
               name='playlistselect' id='playlistselect' required='required' style='height: 169px;''>";

        foreach($playlists_database_combined as $key => $value){ // break the array apart to be used in select list 
          $key=str_replace("http://gdata.youtube.com/feeds/api/users/jinky32/playlists/","",$key); //I only want the ID
          print "<option value='".$key."'>".$value."</option>";
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
                $combinedquery=query("INSERT INTO videos(video_label, video_url, pid) 
                VALUES (:video_label, :video_url, :pid)
                ON DUPLICATE KEY UPDATE video_label = VALUES(video_label)",
                array('video_label'=>$youtube_combined_value, 'video_url'=>$youtube_combined_key, 'pid'=>$chosen_playlist), //bind the values
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
          //print "this is key $key and this is yt_embed_url $yt_embed_url";
            $embed_value=str_replace("https://www.youtube.com/watch?v=", "", $yt_embed_url);
            $embed_value="http://www.youtube.com/embed/".$embed_value;
            //print $embed_value;
           // print "this is key $embkey and this is yt_embed_url $embed_value<br />";

            if ( $conn ) {
                $combinedquery=query("INSERT INTO vidpicjoin(video_url, cat_id, photo_title, pid) 
                VALUES (:video_url, :cat_id, :photo_title, :pid)
                ON DUPLICATE KEY UPDATE photo_title = VALUES(photo_title)",
                array('video_url'=>$yt_embed_url, 'cat_id'=>$image_catid, 'photo_title'=>$title, 'pid'=>$chosen_playlist), //bind the values
                $conn);

                $insert_embed_query=query("UPDATE videos SET video_embed = :video_embed
                WHERE video_url='$yt_embed_url'",
                array('video_embed'=>$embed_value), //bind the values
                $conn);
            }

            $i++;
          }
        }
//print gettype($combinedquery);
      
        if(isset($_GET['title'])){
        if ( $conn ) {
                  $title=urlencode($title);
                  $youtube_video_database=query2("SELECT video_embed FROM videos, vidpicjoin WHERE vidpicjoin.cat_id=$image_catid
                                                  AND vidpicjoin.photo_title='$title' AND vidpicjoin.video_url=videos.video_url", 
                                                  $conn
                                                );




                    // print "youtube_video_database";
                    // print_r($youtube_video_database);

          $youtube_video_database_embed=array();
          $i=0;
          if($youtube_video_database) {
            foreach ($youtube_video_database as $key => $value) {
              foreach ($value as $key => $value) {
                $shortvalue=str_replace("http://www.youtube.com/embed/", "", $value);
                print "<div class='content row'>
                  <div class='videos_and_comments col col-lg-12'>
                     <div class='videos col-lg-6'>
                       <iframe width='420' height='315' src='$value' frameborder='0' allowfullscreen></iframe>
                     </div>
                     <div class='videos col-lg-6'>
                      <form method='post' action=''>
                        <textarea class='form-control' name='$shortvalue' id='$shortvalue' rows='14'>";
                        $insertvalue= "https://www.youtube.com/watch?v=".$shortvalue;
                        $result=query2("SELECT video_comment FROM vidpicjoin WHERE cat_id=$image_catid AND photo_title='$title' AND video_url='$insertvalue'", 
                        $conn);
                          if ($result) {
                              // print_r($result);
                            print $result[0][video_comment];
                          }

                        print "</textarea>
                        <input type='submit' class='btn btn-default' name='submit' id='youtube_comment' value='submit'>
                      </form>
                    </div>
                   </div>
                 </div> ";

                 // print_r($_POST);
                 // print sizeof($_POST);
                 // print $_POST[0];
                  if (isset($_POST[$shortvalue]) ) {
                   
                    
                    //print $insertvalue;
                    $title=urlencode($title);
                    $commentinsertquery=query("UPDATE vidpicjoin SET video_comment = :comment WHERE cat_id=$image_catid AND photo_title='$title' AND video_url='$insertvalue'",
                    array('comment'=>$_POST[$shortvalue]), //bind the values
                    $conn);

             
              }
    
              }
            
            }
        
          }


          } else {
              print "could not connect to the database";
          }
        }

              
//here is a comment for testing github
        //here is another git 
        


      // if ( $conn ) {
      //       $youtube_video_database=query2("SELECT cat_id, photo_title FROM images", 
      //       $conn);
      // } else {
      //       print "could not connect to the database";
      // }

      //print "<h2>this is embedvalue $embed_value</h2>";
       // if(isset($_POST[$embed_value])){
       //  print "<h2>HELLO</h2>"; 
       //    print "<h2>here is ". $_POST['embed_value']. "</h2>";
       //    print "<h2>".$_POST['$embed_value']."</h2>";
       
       // $insert_youtbe_comment=query("UPDATE vidpicjoin SET video_comment= :video_comment
       //            WHERE video_url='$yt_embed_url' AND photo_title='$title'",
       //            array('video_comment'=>$_POST['youtube_comment']), //bind the values
       //            $conn);
      // }

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