      <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="#">Title</a> -->
        </div>
      
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
<?php
if(!Input::get(feature)) {
    $feature = 'user';
} else {
  $feature = Input::get(feature);
}
$fivehundredpx = new Fivehundredpx;
Fivehundredpx::fhpxUser();
//print 'hello '. Fivehundredpx::$username . 'your userid is ' . Fivehundredpx::$userid;
$obj = $fivehundredpx->fhpxApiConnect($fivehundredpx->fhpxEndpoint($feature));
$fivehundredpx->fhpxApiArray($obj);
$navigationImagesArray = $fivehundredpx->fhpApiDbSync($feature,$fivehundredpx->fhpxDbUserSelect(Input::get(user)),
                                                  Fivehundredpx::fhpxApiConnect(Fivehundredpx::fhpxEndpoint($feature)));
$navigationCategoriesArray = $fivehundredpx->fhpDbCategorySelect();
if($fhpxDbNavArray = $fivehundredpx->fhpxNav($feature)){

$intersect = array_intersect($fivehundredpx->fhpDbCategorySelect(), 
                  $fhpxDbNavArray); 



            foreach ($intersect as $label => $id) {
            //print "<p>this is $id</p><br />";        
             print "<li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>$label <b class='caret'></b>
                    </a><ul class='dropdown-menu'>";
      
            
              foreach ($fhpxDbNavArray as $key => $value) {
                    if($id==$value){
                      $menu_item=urlencode($key);
                      //PERHAPS TRY URLENCODING WHEN INSERTING INTO DB AND THEN URLDECODE ON THE WAY OUT HERE.
                      switch ($feature) {
                        case 'user_favorites':
                          print "<li><a tabindex='-1' href='profile.php?user=".Input::get(user)."&service=".Input::get(service)."&feature=".Input::get(feature)."&category=$label&title=$key'>$key</a></li>";
                          break;
                        
                        default:
                          print "<li><a tabindex='-1' href='profile.php?user=".Input::get(user)."&service=".Input::get(service)."&category=$label&title=$key'>$key</a></li>";
                          break;
                      }
                      
                    }
                    
                    }
                    print "</ul></li>";
                 } 
} else {
  print 'you haven\'t favourited anything on 500px yet';
}
   
            ?>

        </div><!-- /.navbar-collapse -->
      </nav>
