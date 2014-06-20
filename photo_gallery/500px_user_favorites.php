<?php

if($user->isLoggedIn()){
  
  if($youtube->getUser()->username == Input::get('user')){
    $loggedin = TRUE;
   
  }
 }
 if($loggedin) {
  //print_r($fivehundredpx->fhpxEndpoint('user_favorites')->fhpxApiConnect()->fhpxApiPhotoSelect());
$intersect = array_intersect($fivehundredpx->fhpDbCategorySelect(), 
                  $fivehundredpx->fhpxPhotoCompare()->fhpxNav());
}
 // if($loggedin){
 //    $fivehundredpx->fhpxInsert();
 // }
$fivehundredpx->getViewerId(Input::get(user));
include "_/components/php/500nav.php";
  print Input::get(user);
      // print 'HELLO';  
      if(Input::get('youtube_comment')){
            foreach (Input::get('playlist') as $vid => $comment) {
             // print 'this is vid '.$vid . 'and this is comment ' . $comment;
              $db->update('vidpicjoin', 'vid', $vid, array('video_comment'=> $comment));
            }
          }


            if(Input::get('youtube_comment_delete')){
            foreach (Input::get('playlist') as $vid => $comment) {
              $db->delete('vidpicjoin', array(array('vid','video_comment'), array('=','='), array($vid, $comment)));
            }
          }
print '<h1>'. Input::get('service').' '.Input::get('feature').'</h1>';

if(Input::get('title')){
   print "<h1>" . Input::get('title')." - " . Input::get('category')."</h1>";
        } else {
          print "<h1>Hello World!</h1>";
        }
        
$image_catid_array = $db->get('categories', array('label', '=', Input::get('category')))->results();
$image_catid = $image_catid_array[0]->cat_id;
$image_title=Input::get('title');
              
       
    ?>
<div class="container">
      <div class="jumbotron">
      <?php //print the selected image into the bootstrap jumbotron. str_replace to get larger iage
      $images = $fivehundredpx->fhpxDbImageSelect('user_favorites',$fivehundredpx->getUser()->id);
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
                        'video_comment'=>"Add your comment here",
                        'video_embed'=>"http://www.youtube.com/embed/".$vid        
                        )
                      );
            }

  }
        if($videos=$db->get('vidpicjoin', array(array('user_id','photo_title','video_comment'), array('=','=','<>'), array($youtube->getUser()->id, $image_title, '')))->results()){

            for ($i=0; $i < sizeof($videos); $i++) { 
              $video_embed[$videos[$i]->vid] = $videos[$i]->video_embed;
            }
            $i=0;
            foreach ($video_embed as $key => $value) {
                print "<div class='content row'>
                  <div class='videos_and_comments col col-lg-12'>
                     <div class='videos col-lg-6'>
                       <iframe width='420' height='315' src='$value' frameborder='0' allowfullscreen></iframe>
                     </div>
                     <div class='videos col-lg-6'>
                      <form method='post' action=''>
                        <textarea class='form-control' name='playlist[$key]' id='$key' rows='14'>";
                        print $videos[$i]->video_comment;
                        print "</textarea>
                        <input type='submit' class='btn btn-default' name='youtube_comment' id='youtube_comment' value='submit'>
                        <input type='submit' class='btn btn-default' name='youtube_comment_delete' id='youtube_comment_delete' value='Remove Video'>
                      </form>
                    </div>
                   </div>
                 </div> ";
                 $i++;
          }

        }
              


          // if(Input::get('youtube_comment')){
          //   foreach (Input::get('playlist') as $vid => $comment) {
          //    // print 'this is vid '.$vid . 'and this is comment ' . $comment;
          //     $db->update('vidpicjoin', 'vid', $vid, array('video_comment'=> $comment));
          //   }
          // }


          //   if(Input::get('youtube_comment_delete')){
          //   foreach (Input::get('playlist') as $vid => $comment) {
          //     $db->delete('vidpicjoin', array(array('vid','video_comment'), array('=','='), array($vid, $comment)));
          //   }
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