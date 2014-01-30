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

  <div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
    <?php 

  
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
        <td></td>
      </tr>
    </tbody>
  </table>
  </div>
</html>