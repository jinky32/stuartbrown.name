
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
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=editors&page=2&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    
    curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user_favorites&username=jinky32&sort=rating&image_size=3&include_store=store_download&include_states=voted&consumer_key=I9CDYnaxrFxLTEvYxTmsDKZQlgStyLNQkmtOKGKb");
    // curl_setopt($ch, CURLOPT_URL,"https://api.500px.com/v1/photos?feature=user&username={$username}&consumer_key={$comsumer_key}");
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

<!-- OAuth oauth_consumer_key="xHkW9aeTnoYk4k1lUYicCjbKY9VXjYOWxE3OsBt8",
oauth_signature_method="HMAC-SHA1",oauth_timestamp="1389213008",
oauth_nonce="-164979325",oauth_version="1.0",
oauth_token="kdH4hOFmLjdXjhciQOe0qxFXHqBKYQRVP7trrkI4",
oauth_signature="HCZG8uuAXdy6KW10eCb5DKdUYjA%3D"
Host:
api.500px.com -->
    
   
    <?php if($json){
            $obj = json_decode($json); 
                    }
          else {
            print "<p>Currently, No Service Available.</p>";
                } 

print_r($obj);
                ?>



     <?php /*          
          $i = 0;      
          foreach ($obj->photos as $photo){
            $i++;
            print "<div class='stuart'>
                      <p>Number " . $i . " Here is information about " .  $photo->name .  " It has been viewed ". $photo->times_viewed ." times. " . $photo->votes_count . $photo->favorites_count . $photo->image_url . "</p><br/>
                  </div>";
                }
    */?>

    












    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>





