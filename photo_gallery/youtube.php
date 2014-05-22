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

//              reset($images);
// $first_key = key($images);
//print $first_key;

//print_r($images);

print '<h1>Select Your Playlists</h1>
<p>You probably have playlists that don\'t contain relevant videos.  Please select the playlists below that DO contain videos of use</p>';

$i=0;
foreach($playlists as $key => $value) {
              print '<div class="col-sm-6 col-md-4">
              <div class="thumbnail">
      <img src="'.$image_url[$i].'" alt="...">
      <div class="caption">
        <h3>'.$key.'</h3>
        <p>some text</p>
        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
  </div>';
$i++;     
          }

          ?>  
  
</div>





<script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
  </body>
</html>