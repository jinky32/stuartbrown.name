<?php namespace Photo\DB;
require "_/components/php/functions.php";
include "_/components/php/header.php";
$conn = connect($config);
  


//   foreach ($sitecategories as $key => $value) {
// //      print "this is key $key and this is value $value";
//       if ( $conn ) {
//           $catquery=query("INSERT IGNORE into categories (cat_id, label) VALUES (:catid, :label)",
//           array(':catid'=>$key, ':label'=>$value),
//           $conn);
//   } else {
//     print "could not connect to the database";
//   }
//     }

// foreach ($sitecategories as $key => $value) {
//       if ( $conn ) {
//         $catquery=query("INSERT INTO categories(cat_id, label)
//           VALUES (:catid, :label)
//           ON DUPLICATE KEY UPDATE label = VALUES(label)",
//         array('catid'=>$key, 'label'=>$value),
//     $conn);
//       } else {
//         print "could not connect to the database";
//       }
//     }

//the above (lines 19++ need to be uncommented. only out because they will restore all values when index.php loads and affects testing)
//the below gets the cat_id from the hard coded categories array and the cat_id from the categories in the database
//if there is a difference between the two the difference (a cat_id) should be used to delete a row from the database

$catarray=array(); //initiate $catarray


foreach ($sitecategories as $key => $value) { //split $sitecateogres and put the key (cat_id) in an array for comparison to db values below
$catarray[]=$key;
}
 if ( $conn ) {
        $catquery2=query2("SELECT cat_id, label FROM categories", //query to db
        $conn);
      } else {
        print "could not connect to the database";
      }
  print_r($catarray); 
  $stuarray=array(); //initiate $stuarray
for ($i=0; $i < sizeof($catquery2); $i++) { //loop through the array  and fill $stuarray with the cat_id
  $stuarray[]=$catquery2[$i]['cat_id'];
}
print_r($stuarray);

$result = array_diff($catarray, $stuarray);  // compare the two arrays and then print the result
print_r($result);

?>
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
  <body id="home">
      <div class="container">
        <div class="content row">
          <div class="main col col-lg-8">
            
            <h1>Hello, world!</h1>
            <?php 
           if ( $row ){
            print_r($row);
           } else {
              print "<h1>No User</h1>";
            }
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