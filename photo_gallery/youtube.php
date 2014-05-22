 <div class="row">
<?php

require_once '_/components/php/core/init.php';
$name='jinky32';
$db =  DB::getInstance();
$user = new User('jinky32');
$youtube= new Youtube($user, $db);

//var_dump($youtube->youtubeDbVideoSelect()) ;
$playlists = $youtube->youtubeDbVideoSelect();
$image_url = 'https://i1.ytimg.com/vi/p5hgXck7KP0/mqdefault.jpg';

//              reset($images);
// $first_key = key($images);
//print $first_key;

//print_r($images);

print '<h1>Select Your Playlists</h1>
<p>You probably have playlists that don\'t contain relevant videos.  Please select the playlists below that DO contain videos of use</p>';


foreach($playlists as $key => $value) {
              print '<div class="col-sm-6 col-md-4">
              <div class="thumbnail">
      <img src="'.$image_url.'" alt="...">
      <div class="caption">
        <h3>'.$key.'</h3>
        <p>'. $value .'</p>
        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
  </div>';     
          }

          ?>  
  
</div>





<script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
  </body>
</html>