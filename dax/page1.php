    <?php 
  include "_/components/php/header.php";
  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
    <title>Dax</title>
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
  <body>
  <?php
  if(isset($_POST[report_item])){
          //$title=$daxreportitems[ri][$i]['path'];
          print "<h1>ReportItem Id is $_POST[report_item]</h1>";
        } else {
          print "<h1>Hello World!</h1>";
        }

    ?>
<div class="container">
<div class="content row">
 <div class="main col col-lg-2">
 <form method='post' action=''>
 <select class='form-control'  name='report_item' id='report_item'>

  <?php

 for ($i=0; $i <= sizeof($daxreportitems[ri]); $i++) {   
   // print $daxreportitems[ri][$i]['id']. "<br />";  
   // print $daxreportitems[ri][$i]['path']. "<br />"; 
  print "<option value='".$daxreportitems[ri][$i]['id']."'>".$daxreportitems[ri][$i]['path']."</option>";
}
print "</select>
           <input type='submit' class='btn btn-default' name='youtube' id='youtube' value='submit'>
            </form></div>";

  if(isset($_POST[report_item])){
          // foreach ($_POST['videoselect'] as $skey => $yt_embed_url) {
          // }
  //  print_r($_POST);
$report_id=$_POST[report_item];

        }



  ?>

 
        <div class="main col col-lg-10">
  <div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
    <?php 
   $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=editors&page=2&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    
    curl_setopt($ch, CURLOPT_URL,"https://dax-rest.comscore.eu/v1/reportitems.xml?itemid=$report_id&startdate=20140101&enddate=20140107&site=supersite-external&format=json&client=ou&user=sbrown&password=m4nch3st3r");
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user&username={$username}&consumer_key={$comsumer_key}");
    curl_setopt($ch , CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

   $json = curl_exec($ch);
   if(curl_errno($ch))
   {
       // echo 'Curl error: ' . curl_error($ch);
   }
   curl_close($ch);
   $dax = array();

//decode json response
 if($json){
      $dax = json_decode($json,true); 
          }
  else {
      print "<p>Currently, No Service Available.</p>";
        } 

  $columns=array();
  for ($i=0; $i <= sizeof($dax[reportitems]['reportitem'][0][columns][column]); $i++) { 
  $columns[]=$dax[reportitems]['reportitem'][0][columns][column][$i];
  
   print "<th>". $columns[$i]['ctitle']."</th>";
    //print "this is key ". $key . " and this is value" . $value ."<br />";
    }
  ?>
    </tr>
    </thead>
    <tbody>
      <tr>
  <?php
  // print $dax[reportitems]['reportitem'][0][rows][r][$i][c];
   $rows=array();
   for ($i=0; $i <= sizeof($dax[reportitems]['reportitem'][0][rows][r]); $i++) {     
      $rows[]=$dax[reportitems]['reportitem'][0][rows][r][$i][c];
     print "<td>".$rows[$i][0]."</td>";
     print "<td>".$rows[$i][1]."</td>";
     print "<td>".$rows[$i][2]."</td>";
     print "</tr>";
  }
  // print_r($rows);
  ?>

      
    </tbody>
  </table>
  </div>
  </div>
</div>
  </div>
  </body>
</html>