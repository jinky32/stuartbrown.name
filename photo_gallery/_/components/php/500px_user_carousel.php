  <a href="profile.php?user=<?php echo escape($user->data()->username);?>&service=500px&view=cards" class="btn btn-default btn-warning btn-sm"><span class="glyphicon glyphicon-camera"></span> Switch to Cards view</a>

<!-- NAVBAR
================================================== -->

 <!--  <body screen_capture_injected="true">
    <div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Project name</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div> -->

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
   <!--    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
      </ol> -->
      <div class="carousel-inner">  
       <?php
            $images = $fivehundredpx->fhpxDbImageSelect('user',$fivehundredpx->fhpxDbUserSelect(Input::get(user)));

             reset($images);
$first_key = key($images);
//print $first_key;
// print '<img src=\''.str_replace('/3.', '/4.', $url).'\' class=\'img-responsive img-rounded img-centred\');>';

foreach($images as $key => $value) {
    if ($key === $first_key){
            print '<div class="item active">
                    <img src ="'. str_replace('/3.', '/5.', $value[image_url]) .'" width="100%" alt="" class ="img-responsive img-centred" >
                     <div class="carousel-caption"> 
                      <h1>'.$key.'</h1><br />
                      <p>By</p><h3>'.$value[username].'</h3>
                      <p>'. $value[description] .'</p>
                      <p><a class="btn btn-lg btn-primary" href="http://www.500px.com'.$value[url].'" role="button">View original on 500px</a></p>
                    </div>
                  </div>'; 
          } else {
              print '<div class="item">
                      <img src ="'. str_replace('/3.', '/5.', $value[image_url]) .'" " width="100%" alt="" class ="img-responsive img-centred">
                      <div class="carousel-caption"> 
                         <h1>'.$key.'</h1><br />
                      <p>By</p><h3>'.$value[username].'</h3>
                        <p>'. $value[description] .'</p>
                        <p><a class="btn btn-lg btn-primary" href="http://www.500px.com'.$value[url].'" role="button">View original on 500px</a></p>
                      </div>
                    </div>';  
                }     
          }

          ?>  
         </div>    
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
