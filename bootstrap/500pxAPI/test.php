<!doctype html>
<html>

    <head>
        <title>Using 500px API with colorbox and php </title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="colorbox/colorbox.css" />
        <script src="jquery.min.js"></script>
        <script src="colorbox/jquery.colorbox.js"></script>
        <script type="text/javascript">
              $(document).ready(function(){
                $('a.gallery').colorbox({rel:'gal'});
              })
        </script>
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

<div class="container">
    <h1> Using 500px API with colorbox and php </h1>
    <hr>
    <?php if($json):  ?>
          <?php 
            $obj = json_decode($json); 
            foreach ($obj->photos as $photo){
                          
                      ?>
                      
                      <div class='stuart'>
                          <p>here is information about <?php echo $photo->name; ?>.  It has been viewed <?php echo $photo->times_viewed; ?> times. </p><br/>
                       </div>
                      
                       }


           ?>

    <?php else: ?>
        <p>Currently, No Service Available.</p>
    <?php endif; ?>

</div>
<div class="copyright">Photos Copyright at my friend &copy; <a href="http://500px.com/yemaw" target="_blank">Yemaw</a></div>

</body>
</html>