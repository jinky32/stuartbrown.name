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
     <!-- <a href="index.php"><img src="http://www.open.ac.uk/oudigital/headerandfooter/assets/img/ou-logo.png" alt="Logo for Roux Conference"></a> -->
    <?php
require_once '_/components/php/core/init.php';
//start of login code taken from login.php

if(Input::exists()){//check that something has been submitted
    if(Token::check(Input::get('token'))){//validate the token
      //validate the form using hte Validate class
      $validate=new Validate();
      $validation = $validate->check($_POST,array(
        'username'=>array('required'=>true),
        'password'=>array('required'=>true)
      ));

      if($validation->passed()){
        //instantiate new user
        $user = new User();

        //remember a user functioanlity taken from https://www.youtube.com/watch?v=d8DRVp2kdCc
        //set $remember to true or false depending on whether the remember checkbox on login.php was checked
        $remember = (Input::get('remember')==='on') ? true : false;

        //create login var and pass the username form teh form via nput Class to the login method
        $login=$user->login(Input::get('username'), Input::get('password'), $remember);
      
        if($login){
          //user Redirect class to send signedin user somewhere
          Redirect::to('index.php');
        } else {
          echo '<p>sorry login failed</p>';
        }

      } else {
        foreach ($validation->errors() as $error) {
          echo $error, '<br />';
        }
      }
    }
    
  }



//end of login code taken from login.php

if(Session::exists('home')){
  echo '<p>' . Session::flash('home') .'</p>';
}
$db =  DB::getInstance();
$user= new User();
//var_dump($user);
$fivehundredpx = new Fivehundredpx($db, $user);  //THis is the third user object being created.  It is after the header buttons
$youtube= new Youtube($db, $user);
//var_dump($user);
//$fivehundredpx = new Fivehundredpx;
//echo $user->data()->username;  //this will get the username using the data method of the User class
// if($fivehundredpx->getUserImage($fivehundredpx->fhpxDbUserSelect(Input::get(user)))){
// $fivehundredpx->displayImage(Fivehundredpx::$userid);
//print '<h1> this is displayImage Test</h1><img src="'.$fivehundredpx->displayImage($fivehundredpx->fhpxDbUserSelect(Input::get(user))).'" >';
if($userPicURL = $fivehundredpx->getUserImage()){
  //$userPicURL=$fivehundredpx->getUserImage($fivehundredpx->fhpxDbUserSelect(Input::get(user)));
  print '<a href="index.php"><img src=\''.str_replace('/1.', '/3.', $userPicURL).'\' class=\'img-rounded\'></a>';
            //print '<img src=\''.str_replace('/3.', '/4.', $url).'\' class=\'img-responsive img-rounded img-centred\');>';
} else {
//print '<a href="index.php"><img src="http://www.open.ac.uk/oudigital/headerandfooter/assets/img/ou-logo.png" ></a>';
}
// print $user->data()->id . '<br />';
// print $user->data()->username . '<br />';
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

<!-- <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" id="username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" id="password" autocomplete="off">
                    </div>
                
  <div class="form-group"><input type="hidden" name="token" value="<?php // echo Token::generate();?>">
                    <button type="submit" class="btn btn-default">Sign In</button></div>
                         <div class="form-group">
    <label for="remember">
      <input type="checkbox" name="remember" id="remember"> Remember me
    </label>
  </div>
                </form>
                <a href="register.php" class="btn btn-default btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Register</a> -->



<!--
<form action="" method="post">
  <div class="field">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" autocomplete="off">
  </div>
  <div class="field">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" autocomplete="off">
  </div>
  <div class="field">
    <label for="remember">
      <input type="checkbox" name="remember" id="remember"> Remember me
    </label>
  </div>
  <input type="hidden" name="token" value="<?php // echo Token::generate();?>">
  <input type="submit" value="log in">
</form>  -->
<?php 

}
?>
    </section><!-- branding -->
   </header><!-- header -->