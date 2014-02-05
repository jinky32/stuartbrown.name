<?php namespace Photo\DB;


require "_/components/php/functions.php";
              $conn = connect($config);
              include "_/components/php/500pxapi.php";
include "_/components/php/youtubeapi.php";
?>
<div class="content row">
	<div class="col-lg-12">
		<header class="clearfix">
			<section id="branding">
				<a href="index.php"><img src="images/misc/ralogo_monogram.png" alt="Logo for Roux Conference"></a>
			</section><!-- branding -->
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
            
              foreach ($photoarray_database_combined as $key => $value) {
                    if($id==$value){
                      $menu_item=urlencode($key);
                      //PERHAPS TRY URLENCODING WHEN INSERTING INTO DB AND THEN URLDECODE ON THE WAY OUT HERE.
                      print "<li><a tabindex='-1' href='page2.php?category=$label&title=$menu_item'>$key</a></li>";
                    }
                    
                    }
                    print "</ul></li>";
                  } 

   
            ?>

        </div><!-- /.navbar-collapse -->
      </nav>
			

		</header><!-- header -->
	</div><!-- column -->
</div><!-- content -->










