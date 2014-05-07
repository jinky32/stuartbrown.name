<?php
  require_once '_/components/php/core/init.php';
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 STuart</title>
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
<div class="content row">
  <div class="col-lg-12">
<!--   <?php
  //require_once '_/components/php/core/init.php';
  ?> -->

  </div><!-- column -->
</div><!-- content -->
  <header class="clearfix">
    <section id="branding">
     
    <?php
require_once '_/components/php/core/init.php';

if(Session::exists('home')){
  echo '<p>' . Session::flash('home') .'</p>';
}

$user= new User();
$fivehundredpx = new Fivehundredpx;
//echo $user->data()->username;  //this will get the username using the data method of the User class
print '<a href="index.php"><img src="'.str_replace('/1.', '/3.', $user->data()->userpic_url).'" ></a>';
print $user->data()->id . '<br />';
// print $data->id . '<br />';
// print Fivehundredpx::$userid . '<br />';
if($user->isLoggedIn()){
?>

<a href="profile.php?user=<?php echo escape($user->data()->username);?>" class="btn btn-default btn-success btn-lg"><span class="glyphicon glyphicon-user"></span> <?php echo escape($user->data()->username);?></a>
<a href="update.php" class="btn btn-default btn-info btn-sm"><span class="glyphicon glyphicon-pencil"></span> Update details</a>
<a href="changepassword.php" class="btn btn-default btn-info btn-sm"><span class="glyphicon glyphicon-pencil"></span> Change password</a>
<a href="logout.php" class="btn btn-default btn-danger btn-sm"><span class="glyphicon glyphicon-off"></span> Logout</a>
<div class="btn-group">
<a href="profile.php?user=<?php echo escape($user->data()->username);?>&service=500px" class="btn btn-default btn-warning btn-sm"><span class="glyphicon glyphicon-camera"></span> 500px</a>
  <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="profile.php?user=<?php echo Input::get(user);?>&service=500px&feature=user_favorites">User Favourites</a>
    </li>
  </ul>
</div>
<a href="profile.php?user=<?php echo escape($user->data()->username);?>&service=youtube" class="btn btn-default btn-warning btn-sm"><span class="glyphicon glyphicon-film"></span> YouTube</a>


<?php
} else {?>
<a href="login.php" class="btn btn-default btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> Login</a>  <a href="register.php" class="btn btn-default btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Register</a>

<?php

}
?>



    </section><!-- branding -->
   </header><!-- header -->