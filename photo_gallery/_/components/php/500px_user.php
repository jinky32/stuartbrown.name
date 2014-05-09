<?php
print '<h1>'.Input::get('service').'</h1>';
if(Input::get('title')){
	 print "<h1>" . Input::get('title')." - " . Input::get('category')."</h1>";
        } else {
          print "<h1>Hello World!</h1>";
        }


?>
	<div class="container">
      <div class="jumbotron">
      <?php //print the selected image into the bootstrap jumbotron. str_replace to get larger iage
      $images = $fivehundredpx->fhpxDbImageSelect('user',$fivehundredpx->fhpxDbUserSelect(Input::get(user)));
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


          </div><!-- end of main -->
          
          <div class="sidebar col col-lg-4">
            
            
          </div> <!-- end of sidebar -->
        </div><!-- end content -->
      </div> <!-- end of container -->
      <?php
        include "_/components/php/500px_user_carousel.php";
      ?>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
  </body>
</html>