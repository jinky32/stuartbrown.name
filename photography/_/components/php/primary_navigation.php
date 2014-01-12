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

//decode json response
 if($json){
      $obj = json_decode($json); 
          }
  else {
      print "<p>Currently, No Service Available.</p>";
        } 

//create as array of the 500px categories and category ID.  Only ID is returned in the API array so the label needs to be matched later
$sitecategories = array(
    0 => "Uncategorized", 10 => "Abstract", 11 => "Animals", 5 => "Black and White", 1 => "Celebrities", 9 => "City and Architecture",
    15 => "Commercial", 16 => "Concert", 20 => "Family", 14 => "Fashion", 2 => "Film", 24 => "Fine Art", 23 => "Food",
    3 => "Journalism", 8 => "Landscapes", 12 => "Macro", 18 => "Nature", 4 => "Nude", 7 => "People", 19 => "Performing Arts",
    17 => "Sport", 6 => "Still Life", 21 => "Street", 26 => "Transportation", 13 => "Travel", 22 => "Underwater",
    27 => "Urban Exploration", 25 => "Wedding"
    );
//end of 500pc categories array



$nonunique=array(); //initiate $nonunique array.  This will hold the full list of category IDs from the 500px API.  $categories below will be used to get only unique IDs in order to create the primary navigation.

$photoname=array(); // intitiate $photoname array.  Holds the names of the photographs from the API array

$categories=array(); // intitiate $categories array.  This will be filtered to contain only unique values to drive the primary navigation labels.

foreach ($obj->photos as $photo){ //loop through photos and set values of arrays
    $categories[]=$photo->category;
    $nonunique[]=$photo->category;
    $photoname[]=$photo->name;
    //$combined=array_combine($photoname, $categories); 
    //print_r($combined); shows that $combined contains only unique IDs and therofre not a full list of images returned by API
    //Array ( [9] => the queen [24] => Island Bridge [12] => Solitude [10] => Dangception - waiting for the kick [8] ) etc
    //I WANT TO GET THE FULL LIST OF PHOTOS AND THEIR IDS???
    
    //However if I comment out the array_combine line above and print_r($categories) all categories are returned (i.e. non-unique)
    //so something about the array_combine is only returning unique IDs.
    }
    $combined=array_combine($photoname, $nonunique); 
    //print_r($combined);
//     Array
// (
//     [Staircase I] => 9
//     [the queen] => 9
//     [Island Bridge] => 24
//     [Untitled] => 12
//     [Dangception - waiting for the kick] => 10
//     [Bird Tree] => 8
//     [fly with us] => 12
//     [Tea with lemon] => 23
//     [Point of View] => 13
//     [Bobbio double face] => 8
//     [The Never Ending Bridge] => 26
//     [Gotcha!] => 11
//     [I need an umbrella] => 12
//     [beauty of nature] => 12
//     [Rusty Life] => 8
//     [Just in time] => 12
//     [Umbrella Rainbow] => 21
//     [Lemon Pansy...] => 12
//     [Melanargia lachesis (hembra)] => 18
//     [Solitude] => 12
// )
    
    
    //print_r($photoname); Shows that the array contains the correct number of pictures.  sizeof $photoname and sizeof $categories are the same
    //Array ( [0] => Staircase I [1] => the queen [2] => Island Bridge [3] => Untitled [4] => Dangception - waiting for the kick [5] => Bird Tree [6])
    //print sizeof($categories);
    //print sizeof($photoname);


$categories=array_unique($categories); //make categories contian only unique category ID from API in order to create primary nav labels
//print_r($categories);
//print_r($nonunique);
$catkeys = array(); //initiate $catkeys array
foreach($categories as $key => $value){ //loop through $categories
  $catkeys[$value] = ""; // assign $value (e.g. 9, 12 , 24 etc) as the key and give each an empty value.
}

$intersect = array_intersect_key($sitecategories, $catkeys); //create an array of the items in $sitecategories and $catkeys that 
//are the same.  This is what will go into the primary nav


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
             // print "<p>this is $id</p><br />";
             print "<li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>$label <b class='caret'></b>
                    </a><ul class='dropdown-menu'>";
            
              foreach ($combined as $key => $value) {
                    if($id==$value){
                      print "<li><a tabindex='-1' href='page2.php?title=$key'>$key</a></li>";
                    }
                    
                    }
                    print "</ul></li>";
                  } 

   
            ?>
            <!-- START OF TUTORIAL NAV -->
           <!--   <li class="active"><a href="index.php">Home</a></li>
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
            <li><a href="page3.php">Page 3</a></li> 
          </ul> -->
          <!-- END OF TUTORIAL NAV -->


          
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