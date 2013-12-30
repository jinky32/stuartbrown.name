
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>
    <?php 
    $comsumer_key = 'I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb';
    $username = 'jinky32';
    $count = 14;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user&username={$username}&consumer_key={$comsumer_key}");
    curl_setopt($ch , CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

   $json = curl_exec($ch);
   if(curl_errno($ch))
   {
       // echo 'Curl error: ' . curl_error($ch);
   }
   curl_close($ch);
   $obj = array();
  ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
          <a class="navbar-brand" href="index.html">Modern Business</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="about.html">About</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="portfolio-1-col.html">1 Column Portfolio</a></li>
                <li><a href="portfolio-2-col.html">2 Column Portfolio</a></li>
                <li><a href="portfolio-3-col.html">3 Column Portfolio</a></li>
                <li><a href="portfolio-4-col.html">4 Column Portfolio</a></li>
                <li><a href="portfolio-item.html">Single Portfolio Item</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="blog-home-1.html">Blog Home 1</a></li>
                <li><a href="blog-home-2.html">Blog Home 2</a></li>
                <li><a href="blog-post.html">Blog Post</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="full-width.html">Full Width Page</a></li>
                <li><a href="sidebar.html">Sidebar Page</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="404.html">404</a></li>
                <li><a href="pricing.html">Pricing Table</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
    
   
    <?php if($json){
            $obj = json_decode($json); 
                    }
          else {
            print "<p>Currently, No Service Available.</p>";
                } ?>

     <?php /*          
          $i = 0;      
          foreach ($obj->photos as $photo){
            $i++;
            print "<div class='stuart'>
                      <p>Number " . $i . " Here is information about " .  $photo->name .  " It has been viewed ". $photo->times_viewed ." times. " . $photo->votes_count . $photo->favorites_count . $photo->image_url . "</p><br/>
                  </div>";
                }
    */?>

    
<div class="container">
<div id="myCarousel" class="carousel slide">
  <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php           
          $i = 0;      
          $len = count($obj);
          foreach ($obj->photos as $photo){
            
            if ($i==0) {
              print '<li data-target="#myCarousel" data-slide-to="' . $i . '" class="active"</li>';
            } else {
              print '<li data-target="#myCarousel" data-slide-to="' . $i . '"</li>';
            }
            $i++;
          }
      ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <?php           
          $i = 0;      
          $len = count($obj);
          foreach ($obj->photos as $photo){
            
            if ($i==0) {

      print '<div class="item active">
                <div class="fill" style="background-image:url(\''.str_replace('/2.', '/4.', $photo->image_url).'\');">
                </div>
              <div class="carousel-caption">
                <h1>'.$photo->name.'</h1>
              </div>
              </div>';

    } else {
              print '<div class="item">
                <div class="fill" style="background-image:url(\''.str_replace('/2.', '/4.', $photo->image_url).'\');">
                </div>
              <div class="carousel-caption">
                <h1>'.$photo->name.'</h1>
              </div>
              </div>';
            }
            $i++;
          }
      ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="icon-next"></span>
    </a>
</div>
</div<!-- /.container -->













    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>





