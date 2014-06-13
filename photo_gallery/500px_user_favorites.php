<?php
print '<h1>'. Input::get('service').' '.Input::get('feature').'</h1>';

if(Input::get('title')){
	 print "<h1>" . Input::get('title')." - " . Input::get('category')."</h1>";
        } else {
          print "<h1>Hello World!</h1>";
        }
        
$image_catid_array = $db->get('categories', array('label', '=', Input::get('category')))->results();
$image_catid = $image_catid_array[0]->cat_id;
$image_title=Input::get('title');
              
        // if ( $conn ) {
        //   $image_category_query=query2("SELECT cat_id FROM categories WHERE label = '$category'", 
        //   $conn);
        //   $image_catid=$image_category_query[0][cat_id];
        // }

      // print_r($image_category_query);
      // print $image_catid;

        // $arraykey=array_keys($photoname); 
        // // put the keys of $photoname (from 500pxapi.php) into $arraykey.  This will be used below to try and match $title (of image) to its array key.


        // foreach ($arraykey as $key => $value) { //break apart $arraykey to use the key
        //   if($photoname[$key]==$title){ // playlist_combined if the value at position $photoname[key] is the same as current $title.  If it is we know the key of the array in $obj->photos that we want
        //     $photoarray=$obj->photos[$key]; // the playlist_combined has returned true.  Now grab the whole array for that photo and put it in $photarray.
        //   } 
        // }
//MIGHT WANT TO ADD SOME MORE INFORMATION ON THE PHOTO - FOR EXAMPLE THE PHOTOGRAPHER, LINK BACK TO 500PX ETC ETC. ALL THIS IS IN $PHOTOARRAY()?
    ?>
<div class="container">
      <div class="jumbotron">
      <?php //print the selected image into the bootstrap jumbotron. str_replace to get larger iage
      $images = $fivehundredpx->fhpxDbImageSelect('user_favorites',$fivehundredpx->fhpxDbUserSelect(Input::get(user)));
		foreach ($images as $key => $value) { 
			if ($key ==Input::get('title')) {
				$url = $value[image_url];
			}
		}
          print '<img src=\''.str_replace('/3.', '/4.', $url).'\' class=\'img-responsive img-rounded img-centred\');>';
      ?>
      </div>
      <div class="content row">
        <div class="main col col-lg-12">
          <div class="forms col-lg-6">

      <?php
      //print_r($youtube->youtubeDbPlaylistSelect()->getYoutubeDbPlaylist());
      $playlists=$db->get('playlists', array(array('user_id','selected'), array('=','='), array($youtube->getUser()->id, TRUE)))->results();           
        for ($i=0; $i < sizeof($playlists); $i++) { 
          $selectedPlaylistArray[$playlists[$i]->playlist_title]=$playlists[$i]->playlist_id;
        }
        //print_r($selectedPlaylistArray);
      // print_r($youtube->youtubeSelectedDbPlaylistSelect());
      //var_dump($fivehundredpx);
//beginning of youtube integration

        print "<form method='post' action=''>
              <select multiple='multiple' class='form-control'  
               name='playlistselect' id='playlistselect' required='required' style='height: 169px;''>";

        foreach($selectedPlaylistArray as $key => $value){ // break the array apart to be used in select list 
          //$key=str_replace("http://gdata.youtube.com/feeds/api/users/jinky32/playlists/","",$key); //I only want the ID
          print "<option value='".$value."'>".$key."</option>";
        }

        print "</select>
           <input type='submit' class='btn btn-default' name='youtube' id='youtube' value='submit'>
            </form></div>";
   
        print "<div class='forms col-lg-6'><form method='post' action=''>
                <select name='videoselect[]' multiple='multiple' id='input' class='form-control' required='required' style='height: 169px;'>";
        

        if(Input::get('youtube')){
          $playlists = array(Input::get('playlistselect'));
          foreach ($youtube->youtubeDbVideoSelect($playlists) as $title => $vid) {
            print "<option value='$vid'>$title</option>";
          }
        } else {
          //print "<option value='#'>Choose a video</option>";
        }
                  
        print "</select>
              <input type='submit' class='btn btn-default' name='youtubevideo' id='youtubevideo' value='submit'>
                </form></div>";

          $i=0;
          $embed_array=array();
          if(Input::get('youtubevideo')){
            foreach (Input::get('videoselect') as $key => $vid) {
            
            $db->insert('vidpicjoin', array(
                        'user_id'=>$youtube->getUser()->id,
                        'photo_title'=>$image_title,
                        'video_url'=>'https://www.youtube.com/watch?v='.$vid,
                        'cat_id'=>$image_catid,
                        'pid'=>$value,
                        'vid'=>$vid,
                        'video_embed'=>"http://www.youtube.com/embed/".$vid        
                        )
                      );
            }

          //   $videos=$db->get('vidpicjoin', array(array('user_id','photo_title'), array('=','='), array($youtube->getUser()->id, $image_title)))->results();  
          //  // print_r($videos);
          //   for ($i=0; $i < sizeof($videos); $i++) { 
          //     $video_embed[$videos[$i]->vid] = $videos[$i]->video_embed;
          //   }
          //   $i=0;
          //   foreach ($video_embed as $key => $value) {
              
          //       //$shortvalue=str_replace("http://www.youtube.com/embed/", "", $value);
          //       print "<div class='content row'>
          //         <div class='videos_and_comments col col-lg-12'>
          //            <div class='videos col-lg-6'>
          //              <iframe width='420' height='315' src='$value' frameborder='0' allowfullscreen></iframe>
          //            </div>
          //            <div class='videos col-lg-6'>
          //             <form method='post' action=''>
          //               <textarea class='form-control' name='$key' id='$key' rows='14'>";
          //               //print_r($videos[$i]);
          //               print $videos[$i]->video_comment;
          //               // $insertvalue= "https://www.youtube.com/watch?v=".$shortvalue;
          //               // $result=query2("SELECT video_comment FROM vidpicjoin WHERE cat_id=$image_catid AND photo_title='$title' AND video_url='$insertvalue'", 
          //               // $conn);
          //               //   if ($result) {
          //               //       // print_r($result);
          //               //     print $result[0][video_comment];
          //               //   }

          //               print "</textarea>
          //               <input type='submit' class='btn btn-default' name='youtube_comment' id='youtube_comment' value='submit'>
          //             </form>
          //           </div>
          //          </div>
          //        </div> ";
          //        $i++;
          // }
  }
              $videos=$db->get('vidpicjoin', array(array('user_id','photo_title','video_comment'), array('=','=','<>'), array($youtube->getUser()->id, $image_title, '')))->results();  
           // print_r($videos);
            for ($i=0; $i < sizeof($videos); $i++) { 
              $video_embed[$videos[$i]->vid] = $videos[$i]->video_embed;
            }
            $i=0;
            foreach ($video_embed as $key => $value) {
              
                //$shortvalue=str_replace("http://www.youtube.com/embed/", "", $value);
                print "<div class='content row'>
                  <div class='videos_and_comments col col-lg-12'>
                     <div class='videos col-lg-6'>
                       <iframe width='420' height='315' src='$value' frameborder='0' allowfullscreen></iframe>
                     </div>
                     <div class='videos col-lg-6'>
                      <form method='post' action=''>
                        <textarea class='form-control' name='playlist[$key]' id='$key' rows='14'>";
                        //print_r($videos[$i]);
                        print $videos[$i]->video_comment;
                        // $insertvalue= "https://www.youtube.com/watch?v=".$shortvalue;
                        // $result=query2("SELECT video_comment FROM vidpicjoin WHERE cat_id=$image_catid AND photo_title='$title' AND video_url='$insertvalue'", 
                        // $conn);
                        //   if ($result) {
                        //       // print_r($result);
                        //     print $result[0][video_comment];
                        //   }

                        print "</textarea>
                        <input type='submit' class='btn btn-default' name='youtube_comment' id='youtube_comment' value='submit'>
                        <input type='submit' class='btn btn-default' name='youtube_comment_delete' id='youtube_comment_delete' value='Remove Video'>
                      </form>
                    </div>
                   </div>
                 </div> ";
                 $i++;
          }
          if(Input::get('youtube_comment')){
            foreach (Input::get('playlist') as $vid => $comment) {
              print 'this is vid '.$vid . 'and this is comment ' . $comment;
              $db->update('vidpicjoin', 'vid', $vid, array('video_comment'=> $comment));
              //$this->_db->update('playlists', 'playlist_id', $video_urls["url"], array('selected'=> TRUE));
              // $db->insert('vidpicjoin', array(
              //           'video_comment'=>$comment,
              //           'vid'=>$vid      
              //           )
              //         );
            }
            //print_r(Input::get('playlist'));
          }
          // $youtube_video_database_embed=array();
          // $i=0;
          // if($youtube_video_database) {
          //   foreach ($youtube_video_database as $key => $value) {
          //     foreach ($value as $key => $value) {
          //       $shortvalue=str_replace("http://www.youtube.com/embed/", "", $value);
          //       print "<div class='content row'>
          //         <div class='videos_and_comments col col-lg-12'>
          //            <div class='videos col-lg-6'>
          //              <iframe width='420' height='315' src='$value' frameborder='0' allowfullscreen></iframe>
          //            </div>
          //            <div class='videos col-lg-6'>
          //             <form method='post' action=''>
          //               <textarea class='form-control' name='$shortvalue' id='$shortvalue' rows='14'>";
          //               $insertvalue= "https://www.youtube.com/watch?v=".$shortvalue;
          //               $result=query2("SELECT video_comment FROM vidpicjoin WHERE cat_id=$image_catid AND photo_title='$title' AND video_url='$insertvalue'", 
          //               $conn);
          //                 if ($result) {
          //                     // print_r($result);
          //                   print $result[0][video_comment];
          //                 }

          //               print "</textarea>
          //               <input type='submit' class='btn btn-default' name='submit' id='youtube_comment' value='submit'>
          //             </form>
          //           </div>
          //          </div>
          //        </div> ";

                 // print_r($_POST);
                 // print sizeof($_POST);
                 // print $_POST[0];
              //     if (isset($_POST[$shortvalue]) ) {
                   
                    
              //       //print $insertvalue;
              //       $title=urlencode($title);
              //       $commentinsertquery=query("UPDATE vidpicjoin SET video_comment = :comment WHERE cat_id=$image_catid AND photo_title='$title' AND video_url='$insertvalue'",
              //       array('comment'=>$_POST[$shortvalue]), //bind the values
              //       $conn);

             
              // }
    
            
            
          //   }
        
          // }


          // } else {
          //     print "could not connect to the database";
          // }
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