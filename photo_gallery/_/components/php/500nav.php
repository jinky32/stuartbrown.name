		<header class="clearfix">
			<section id="branding">
				<a href="index.php"><img src="http://www.open.ac.uk/oudigital/headerandfooter/assets/img/ou-logo.png" alt="Logo for Roux Conference"></a>
			</section><!-- branding -->
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
 



// print '<h2>Beginning of 500px play</h2>';
// print 'HERE IT IS!!!!!' . Fivehundredpx::fhpxEndpoint(user);

$fivehundredpx = new Fivehundredpx;
Fivehundredpx::fhpxUser();
//print '<p>fhpxUser was called above but i don\'t think it prints anything</p><br />';


//$fivehundredpx->apiString();
// $obj = $fivehundredpx->apiConnect($fivehundredpx->apiString());
// print '<h3>Connect fhpxApiArray</h3>';
// $obj = Fivehundredpx::fhpxApiConnect(Fivehundredpx::fhpxEndpoint(user_favourites));
// Fivehundredpx::fhpxApiArray($obj);
$obj = $fivehundredpx->fhpxApiConnect($fivehundredpx->fhpxEndpoint(user_favourites));
$fivehundredpx->fhpxApiArray($obj);
// print '<h3>Print-r fhpxApiArray</h3>';
// print_r(Fivehundredpx::fhpxApiArray($obj));
// print '<br />'.sizeof(Fivehundredpx::fhpxApiArray($obj)).'<br />';
// // print '<h3>Print-r fhpxDbImageSelect</h3>';
// //print_r(Fivehundredpx::fhpxDbImageSelect('user_favorites'));
// print_r($fivehundredpx->fhpxDbImageSelect('user_favorites',$fivehundredpx->fhpxDbUserSelect(jinky32)));
//print '<h3>PInsert values to DB</h3>';
//$fivehundredpx->fhpxInsert('user_favorites', 'photo_title');
//$fivehundredpx->fhpxInsert('user_favorites');
// print '<h3>This is the endpoint User</h3>';
// print 'HERE IT IS!!!!!' . $fivehundredpx->fhpxEndpoint(user);
// print '<h3>This is the endpoint User-favourites</h3>';
// print 'HERE IT IS!!!!!' . $fivehundredpx->fhpxEndpoint(user_favourites);
//print '<h3>This is all the usernames</h3>';
//print 'HERE IT THE USER!!!!!' . $fivehundredpx->fhpxDbUserSelect(jinky32);
//print '<h1>This is the array</h1>';
//print_r($fivehundredpx->fhpxNav('user_favorites',$fivehundredpx->fhpxDbUserSelect(jinky32),Fivehundredpx::fhpxApiConnect(Fivehundredpx::fhpxEndpoint(user_favourites))));

//print 'non unique <br />';
$navigationImagesArray = $fivehundredpx->fhpxNav('user_favorites',$fivehundredpx->fhpxDbUserSelect(jinky32),Fivehundredpx::fhpxApiConnect(Fivehundredpx::fhpxEndpoint(user_favourites)));
//print_r($navigationImagesArray);
// $navRaw = $fivehundredpx->fhpDbCategorySelect();
//  for ($i=0; $i < sizeof($navRaw); $i++) { 
//       $nav[$navRaw[$i]->label]=$navRaw[$i]->cat_id;
//     }
// print '<br />';
// print 'unique <br />';
$navigationImagesArrayUnique = array_unique($navigationImagesArray);
 print_r($navigationImagesArray);
// print '<br />';
$navigationCategoriesArray = $fivehundredpx->fhpDbCategorySelect();
//print_r($navigationCategoriesArray);



            foreach ($navigationImagesArrayUnique as $label => $id) {
            //print "<p>this is $id</p><br />";        
             print "<li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>$label <b class='caret'></b>
                    </a><ul class='dropdown-menu'>";
      
            
              foreach ($navigationCategoriesArray as $key => $value) {
                    if($id==$value){
                      $menu_item=urlencode($key);
                      //PERHAPS TRY URLENCODING WHEN INSERTING INTO DB AND THEN URLDECODE ON THE WAY OUT HERE.
                      print "<li><a tabindex='-1' href='page2.php?category=$label&title=$menu_item'>$key</a></li>";
                    }
                    
                    }
                    print "</ul></li>";
                 } 

   
            ?>

        </div><!-- /.navbar-collapse -->
      </nav>
		</header><!-- header -->