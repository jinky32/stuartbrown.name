<?php
print '<h1>'.Input::get('service').'</h1>';
if(Input::get('title')){
	 print "<h1>" . Input::get('title')." - " . Input::get('category')."</h1>";
        } else {
          print "<h1>Hello World!</h1>";
        }

switch (Input::get('view')) {
  case 'cards':
    //print '<h1>'. Input::get('service').' '.Input::get('feature').'</h1>';
    include "_/components/php/500px_user_cards.php";
    break;
  
  default:
    include "_/components/php/500px_user_carousel.php";
    //print '<h2>this should appear on the 500px page but not user favorites</h2>';
    break;
} 

     
        
?>
<!-- 	<div class="container">
      <div class="jumbotron">
      </div>
      <div class="content row">
        <div class="main col col-lg-12">
          <div class="forms col-lg-6">


          </div>end of main
          
          <div class="sidebar col col-lg-4">
            
            
          </div> <!-- end of sidebar -->
        <!-- </div>end content -->
      <!-- </div> <!-- end of container --> -->
 

    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
  </body>
</html>