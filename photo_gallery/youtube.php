 <div class="row">
<?php

require_once '_/components/php/core/init.php';
//$name='jinky32';
// $db =  DB::getInstance();
//$user2 = new User('jinky32');
//var_dump($user);
// $youtube= new Youtube($db, $user);
if($user->isLoggedIn()){
  
  if($youtube->getUser()->username == Input::get('user')){
    $loggedin = TRUE;
   
  }
 }

if($loggedin){
   print 'youre logged in'. $youtube->getUser()->username;
}
$youtube->youtubePlaylistCompare();
$playlists = $youtube->youtubeDbPlaylistSelect()->getYoutubeDbPlaylist();
$image_url = $youtube->youtubeDbPlaylistImageSelect();
//print_r($playlists);
//print_r($youtube->youtubeApiConnect()->getYoutubeApiPlaylist());


?>

<div class="container">
<h1>Select Your Playlists</h1>
<p>You probably have playlists that don't contain relevant videos.  Please select the playlists below that DO contain videos of use</p>


<?php
print '<form method="post" action="">';
$i=0;
foreach($playlists as $key => $value) {
              print '<div class="col-sm-6 col-md-4">
              <div class="thumbnail'?><?php if($loggedin && isset($_POST['playlist'][$value])) print ' checked';?>
              
               <?php if($loggedin) print '"><label> <input type="checkbox" id="'.$value.'" 
        value="'.$value.'" 
        name="playlist['.$value.']"
        title="Select this Playlist"'?> <?php if($loggedin && isset($_POST['playlist'][$value])) print 'checked="checked"';?><?php print ' />   <a href="'. str_replace("gdata.youtube.com/feeds/api/playlists/", "www.youtube.com/playlist?list=", $value).'"><h4>'.$key.'</h4></a>  </label>
      <img src="'.$image_url[$i].'" alt="..." class="img-responsive img-rounded img-centred">
      <div class="caption">
        <a href="'. str_replace("gdata.youtube.com/feeds/api/playlists/", "www.youtube.com/playlist?list=", $value).'"><h4>'.$key.'</h4></a> 
        <!--<p>some text</p>
        <a href="#" class="btn btn-default" role="button">Synchronise Playlist</a></p>-->
      </div>
    </div>
  </div>';
$i++;     
          }
          if($loggedin){
            print '<input type="submit" class="btn btn-default" name="youtube_playlists" id="youtube_playlists" value="Import or Synchronise selected playlists">';
          print '<input type="submit" class="btn btn-default" name="delete_youtube_playlists" id="delete_youtube_playlists" value="Remove This Playlist">';
          }
          
 ?>  
     

</form>

<?php


if(Input::get('youtube_playlists')){
  print_r(Input::get('playlist'));
 // $youtube->youtubePlaylistVideosCompare(Input::get('playlist'));
//$youtube->youtubePlaylistCompare(Input::get('playlist'));
$youtube->youtubePlaylistVideosCompare(Input::get('playlist'));
    //$youtube->youtubePlaylistSync(Input::get('playlist'));
    //print '<br /> here <br />';
    //print_r($youtube->youtubeDbVideoSelect(Input::get('playlist')));
//$youtube->videoDiff(Input::get('playlist'));

  //print $youtube->addQuotes(Input::get('playlist'));
  //$youtube->youtubeGetUserSelectedPlaylist(Input::get('playlist'));
}
if(Input::get('delete_youtube_playlists')){
  print_r(Input::get('playlist'));
  }

?>
</div>      



           
</div>

<script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
  </body>
</html>