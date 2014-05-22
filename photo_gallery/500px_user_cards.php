  <a href="profile.php?user=<?php echo escape($user->data()->username);?>&service=500px" class="btn btn-default btn-warning btn-sm"><span class="glyphicon glyphicon-camera"></span> Switch to Carousel view</a>
  <div class="row">
  <?php
            $images = $fivehundredpx->fhpxDbImageSelect('user',$fivehundredpx->fhpxDbUserSelect(Input::get(user)));

//              reset($images);
// $first_key = key($images);
//print $first_key;

//print_r($images);


foreach($images as $key => $value) {
              print '<div class="col-sm-6 col-md-4">
              <div class="thumbnail">
      <img src="'.$value[image_url].'" alt="...">
      <div class="caption">
        <h3>'.$key.'</h3>
        <p>'. $value[description] .'</p>
        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
  </div>';     
          }

          ?>  
  
</div>


