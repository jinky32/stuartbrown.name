<?php
$comsumer_key = 'I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb';
    $username = 'jinky32';
    $count = 14;

    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=editors&page=2&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    
    curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user_favorites&username=jinky32&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user&username={$username}&consumer_key={$comsumer_key}");
    curl_setopt($ch , CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

   $json = curl_exec($ch);
   if(curl_errno($ch))
   {
       // echo 'Curl error: ' . curl_error($ch);
   }
   curl_close($ch);
   $obj = array();


 if($json){
            $obj = json_decode($json); 
                    }
          else {
            print "<p>Currently, No Service Available.</p>";
                } 


$sitecategories = array(
    0 => "Uncategorized", 10 => "Abstract", 11 => "Animals", 5 => "Black and White", 1 => "Celebrities", 9 => "City and Architecture",
    15 => "Commercial", 16 => "Concert", 20 => "Family", 14 => "Fashion", 2 => "Film", 24 => "Fine Art", 23 => "Food",
    3 => "Journalism", 8 => "Landscapes", 12 => "Macro", 18 => "Nature", 4 => "Nude", 7 => "People", 19 => "Performing Arts",
    17 => "Sport", 6 => "Still Life", 21 => "Street", 26 => "Transportation", 13 => "Travel", 22 => "Underwater",
    27 => "Urban Exploration", 25 => "Wedding"
    );


// foreach ($sitecategories as $keycat => $valuecat) {
//   print "<p>this is keycat $keycat and this is valuecat $valuecat</p>";
 
// }

$nonunique=array();
$photoname=array();
$categories=array();
foreach ($obj->photos as $photo){
    $categories[]=$photo->category;
    $nonunique[]=$photo->category;
    $photoname[]=$photo->name;
    $combined=array_combine($categories, $photoname); 

    }
    
    //print_r($uniquecombined);
    //print_r($combined);
    print_r($nonunique);
    print_r($photoname);

$categories=array_unique($categories);


  //print_r($photoname);


//from stuart c
$catkeys = array();
foreach($categories as $key => $value){ 
  $catkeys[$value] = "";
}

$intersect = array_intersect_key($sitecategories, $catkeys);

//end from stuart 
/*
I want to get $photoname and split to key value. use the key. if this key has the same value sa as $id (below frmo $intersect then it goes in that subnav)
*/

?>
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
            foreach ($intersect as $id => $label) {
              // print "<li><a href='page1.php'>$label</a></li>";
             print "<li class='dropdown'>
                    <a href='page1.php' class='dropdown-toggle $id' data-toggle='dropdown'>$label <b class='caret'></b>
                    </a>
                    </li>";
                  }

        
   
            ?>
            <!-- <li class="active"><a href="index.php">Home</a></li>
            <li><a href="page1.php">Page 1</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="artists.php">All artists</a></li>
              <li class="divider"></li>
                <li><a tabindex="-1" href="artists.php#Barot_Bellingham">Barot Bellingham</a></li>
                <li><a tabindex="-1" href="artists.php#Gerard_Donahue">Gerard Donahue</a></li>
                <li><a tabindex="-1" href="artists.php#Jonathan_Ferrar">Jonathan Ferrar</a></li>
                <li><a tabindex="-1" href="artists.php#Lorenzo_Garcia">Lorenzo Garcia</a></li>
                <li><a tabindex="-1" href="artists.php#Hillary_Goldwynn">Hillary Goldwynn</a></li>
                <li><a tabindex="-1" href="artists.php#Hassum_Harrod">Hassum Harrod</a></li>
                <li><a tabindex="-1" href="artists.php#Jennifer_Jerome">Jennifer Jerome</a></li>
                <li><a tabindex="-1" href="artists.php#LaVonne_LaRue">LaVonne LaRue</a></li>
                <li><a tabindex="-1" href="artists.php#Riley_Rewington">Riley Rewington</a></li>
                <li><a tabindex="-1" href="artists.php#Constance_Smith">Constance Smith</a></li>
                <li><a tabindex="-1" href="artists.php#Xhou_Ta">Xhou Ta</a></li>
                <li><a tabindex="-1" href="artists.php#Richard_Tweed">Richard Tweed</a></li>
              </ul>
            </li>
            <li><a href="page2.php">Page 2</a></li>
            <li><a href="page3.php">Page 3</a></li> -->
          </ul>
          
          <!-- <ul class="nav navbar-nav navbar-right"> -->
            <!-- <li><a href="#">Link</a></li> -->
            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li class="divider"></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li> -->
          <!-- </ul> -->
        </div><!-- /.navbar-collapse -->
      </nav>