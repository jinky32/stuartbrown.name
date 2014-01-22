// <?php namespace Photo\DB;
// require "_/components/php/functions.php";
// include "_/components/php/header.php";
// $conn = connect($config);
  




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

// //the above (lines 19++ need to be uncommented. only out because they will restore all values when index.php loads and affects testing)
// //the below gets the cat_id from the hard coded categories array and the cat_id from the categories in the database
// //if there is a difference between the two the difference (a cat_id) should be used to delete a row from the database

// $catarray_harcoded=array(); //initiate $catarray_harcoded


// foreach ($sitecategories as $key => $value) { //split $sitecateogres and put the key (cat_id) in an array for comparison to db values below
// $catarray_harcoded[]=$key;
// }
//  if ( $conn ) {
//         $categories_databasevcd=query2("SELECT cat_id, label FROM categories", //query to db
//         $conn);
//       } else {
//         print "could not connect to the database";
//       }
//   print_r($catarray_harcoded); 
//   $catarray_database=array(); //initiate $catarray_database
// for ($i=0; $i < sizeof($categories_databasevcd); $i++) { //loop through the array  and fill $catarray_database with the cat_id
//   $catarray_database[]=$categories_databasevcd[$i]['cat_id'];
// }
// print_r($catarray_database);

// $result = array_diff($catarray_database, $catarray_harcoded);  // compare the two arrays and then print the result.  Values of $catarray_harcoded are the master since hard coded.
// //if the are removed from there they should be removed fro mDB
// print_r($result);

// if($result){ // if there is a difference between the cat_id in the db and those in the hard coded array then use that cat_id in a 
//   //delete statement
//   foreach ($result as $key => $value) { //break apart array to get cat_id value
//     $deleteitem=delete("DELETE FROM categories where cat_id=$value",$conn);
//   }
  
// }

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