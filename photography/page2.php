<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Bree+Serif|Merriweather:400,300,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="_/css/bootstrap.css" rel="stylesheet">
    <link href="_/css/mystyles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body id="page2">
    <?php
              include "_/components/php/header.php";
              include "_/components/php/youtubeapi.php";
              if(isset($_GET['title'])){
                $title=$_GET['title'];
                print "<h1>$title</h1>";
              } else {
                print "<h1>Hello World!</h1>";
              }
              //print_r($obj->photos[1]);
              //print_r($photoname);

              $arraykey=array_keys($photoname); // put the keys of $photoname into $arraykey.  This will be
              //used below to try and match $title (of image) to its array key.


foreach ($arraykey as $key => $value) { //break apart $arraykey to use the key
 if($photoname[$key]==$title){ // test if the value at position $photoname[key] is the same as current $title.  If it is we know the key of the array in $obj->photos that we want
  $photoarray=$obj->photos[$key]; // the test has returned true.  Now grab the whole array for that photo and put it in $photarray.
  
 } 
}
//print $photoarray->image_url; //print out the URL of the image.
//print_r($obj->photos[$key]);

            ?>
    
      <div class="container">
        <div class="jumbotron">
          <?php 
            //print "<img src=". str_replace('/3.', '/4.', $photoarray->image_url)">";
             print '<img src=\''.str_replace('/3.', '/4.', $photoarray->image_url).'\' class=\'img-responsive img-rounded img-centred\');>';
          ?>
        </div>
        <div class="content row">
          <div class="main col col-lg-8">
            <?php
              $test=array_combine($playlist_id, $playlist_title);

              print_r($test);
            ?>
            
          </div><!-- end of main -->
          
          <div class="sidebar col col-lg-4">
            
            
          </div> <!-- end of sidebar -->
        </div><!-- end content -->
        

      </div> <!-- end of container -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
  </body>
</html>