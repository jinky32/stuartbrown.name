 <div class="row">
<?php

require_once '_/components/php/core/init.php';
$name='jinky32';
$db =  DB::getInstance();
//$user = new User('jinky32');
$youtube= new Youtube($db);
$youtube->create('User','jinky32');

//var_dump($youtube->youtubeDbVideoSelect()) ;
$playlists = $youtube->youtubeDbPlaylistSelect();
$image_url = $youtube->youtubeDbPlaylistImageSelect();


?>

<div class="container">
<h1>Select Your Playlists</h1>
<p>You probably have playlists that don't contain relevant videos.  Please select the playlists below that DO contain videos of use</p>
<form method="post" action="">

<?php
$i=0;
foreach($playlists as $key => $value) {
              print '<div class="col-sm-6 col-md-4">
              <div class="thumbnail'?><?php if(isset($_POST['playlist'][$youtube->getUser()->data()->id.' - '.$value])) print ' checked';?>
              
               <?php print '"><label> <input type="checkbox" id="'.$youtube->getUser()->data()->id.' - '.$value.'" 
        value="'.$youtube->getUser()->data()->id.' - '.$value.'" 
        name="playlist['.$youtube->getUser()->data()->id.' - '.$value.']"
        title="Select this Playlist"'?> <?php if(isset($_POST['playlist'][$youtube->getUser()->data()->id.' - '.$value])) print 'checked="checked"';?><?php print ' />   Select this Playlist.  You need to submit the form at the bottom of the page. </label>
      <img src="'.$image_url[$i].'" alt="..." class="img-responsive img-rounded img-centred">
      <div class="caption">
         <h4>'.$key.'</h4>
        <p>some text</p>
        <a href="#" class="btn btn-default" role="button">Synchronise Playlist</a></p>
      </div>
    </div>
  </div>';
$i++;     
          }
          print '<input type="submit" class="btn btn-default" name="youtube_playlists" id="youtube_playlists" value="submit">';
 ?>  
     

</form>

<?php


if(Input::get('youtube_playlists')){
  print_r(Input::get('playlist'));
  //$youtube->youtubeGetUserSelectedPlaylist(Input::get('playlist'));
}

?>
</div>      



           
</div>

<script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
  </body>
</html>