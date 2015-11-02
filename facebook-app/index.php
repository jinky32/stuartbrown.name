<?php
session_start();
require_once __DIR__ . '/vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/classes/Coverage.php';
/**
 * Created by PhpStorm.
 * User: stuartbrown
 * Date: 11/10/2015
 * Time: 19:51
 */

$fb = new Facebook\Facebook([
    'app_id' => '117184545303963',
    'app_secret' => 'd192fcab17b94e09333beb89a1612a9e',
    'default_graph_version' => 'v2.5',
]);
date_default_timezone_set('Europe/London');
$time =new DateTime('now');




$helper = $fb->getCanvasHelper();
$permissions = ['email', 'publish_actions', 'user_events']; // optionnal

try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) {

if (isset($_SESSION['facebook_access_token'])) {
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
} else {
    $_SESSION['facebook_access_token'] = (string) $accessToken;

    // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();

    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
}

// validating the access token
try {
    $request = $fb->get('/me');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    if ($e->getCode() == 190) {
        unset($_SESSION['facebook_access_token']);
        $helper = $fb->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl('https://apps.facebook.com/stuartnetworktest/', $permissions);
        echo "<script>window.top.location.href='".$loginUrl."'</script>";
        exit;
    }
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

// posting on user timeline using publish_actins permission

//todo move the below block to the part where a user can enter their message c. line 314++
//try {
//    // message must come from the user-end
//    $data = ['message' => 'testing3...'];
//    $request = $fb->post('/me/feed', $data);
//    $response = $request->getGraphNode()->asArray();
//} catch(Facebook\Exceptions\FacebookResponseException $e) {
//    // When Graph returns an error
//    echo 'Graph returned an error: ' . $e->getMessage();
//    exit;
//} catch(Facebook\Exceptions\FacebookSDKException $e) {
//    // When validation fails or other local issues
//    echo 'Facebook SDK returned an error: ' . $e->getMessage();
//    exit;
//}








//  getting basic info about user
try {
    $profile_request = $fb->get('/me?fields=name,first_name,last_name,email, events');
//        $profile_request = $fb->get('/me');
//        $profile = $profile_request->getGraphNode()->asArray();
    $profile = $profile_request->getGraphNode();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    unset($_SESSION['facebook_access_token']);
    echo "<script>window.top.location.href='https://apps.facebook.com/stuartnetworktest/'</script>";
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<!--[if IE 10]><html class="ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Foundation | HTML Templates</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700"/>
    <link rel="icon" href="bower_components/foundation/img/icons/favicon.ico" type="image/x-icon">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/img/icons/apple-touch-icon-144x144-precomposed.png">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/img/icons/apple-touch-icon-114x114-precomposed.png">

    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/img/icons/apple-touch-icon-72x72-precomposed.png">

    <link rel="apple-touch-icon-precomposed" href="assets/img/icons/apple-touch-icon-precomposed.png">
    <meta name="description" content="Offical website for the ZURB Foundation responsive front-end framework."/>
    <meta name="author" content="ZURB, inc. ZURB network also includes zurb.com"/>
    <meta name="copyright" content="ZURB, inc. Copyright (c) 2015"/>
    <link type="text/css" rel="stylesheet" href="bower_components/foundation/css/foundation.css"/>
    <link type="text/css" rel="stylesheet" href="bower_components/foundation/css/custom.css"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/foundation/js/vendor/modernizr.js"></script>
    <script src="bower_components/foundation/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
        $(document).foundation('tab', 'reflow');
    </script>

    <script type="text/javascript">
        var i =2;
        function addPostcode(){
            if (i<=3) {
                i++;
                var div = document.createElement('div');
                div.innerHTML= 'Postcode : <input type="text" name="postcode_'+i+'" ><input type="button" id="addPostcode()" value="+" /><input type="button" value="-" onclick="removePostcode(this)">';
                document.getElementById('postcodes').appendChild(div);
            }
        }

        function removePostcode(div) {
            document.getElementById('postcodes').removeChild(div.parentNode);
            i--;
        }
    </script>
</head>
<body>

<div class="row">
    <h1>Check Your Coverage!</h1>
    <div class="large-3 columns">

    </div>


<div class="row">
    <div class="large-12 columns">

        <div class="panel">
            <div class="row">
                <div class="large-9 columns">
                    <form method="post">

                        <div class="row">
                            <div class="large-12 columns">
                                <label>What Is your home postcode
                                    <input type="text" name="postcode_1" placeholder="Please enter a postcode" />
                                </label>
                            </div>
                            <div class="large-12 columns" id="postcodes">
                                Add another postcode: <input type="text" name="postcode_2" ><input type="button" id="addPostcode()" onClick="addPostcode()" value="+" /> (limit 4)
                            </div>
                            <label>Please select your device
                                <select name="device">
                                    <option value="iPhone 6 - fourg">iPhone 6</option>
                                    <option value="Samsung Galaxy S5 - volte">Samsung Galaxy S5</option>
                                    <option value="Huawei - 800">Huawei</option>
                                    <option value="Samsung Galaxy S2 - tint">Samsung Galaxy S2</option>
                                </select>
                            </label>
                        </div>


                                <?php if(isset($_POST['submit'])) { $deviceArray = explode(' - ', $_POST['device']);
                                    $postcodeList=array();
                                    $more=TRUE;
                                    $i=1;
                                    while ($more){
                                        if ((isset($_POST['postcode_'.$i])) && ($_POST['child_'.$i] !=="")){
                                            // $postcodeList .=$_POST['postcode_'.$i];
                                            //$postcodeList .= "<br />";
                                            $postcodeList[]= $_POST['postcode_'.$i];
                                        } else {
                                            $more = FALSE;
                                        }
                                        $i++;
                                    }
                                    //print_r($postcodeList);
                                    //todo the below must be wrapped in a loop to iterate through the $postcodeList array
                                    ?>
                                    <div class="small-12 medium-6 columns">
                                        <div class="callout-card alert radius">
                                            <div class="card-label">
                                                <div class="label-text">
                                                    Win!
                                                </div>
                                            </div>
                                            <div class="callout-card-content">
                                                <h3 class="lead"> <?php echo "Using the " .htmlspecialchars($deviceArray[0]) . " the 3G overage in ". htmlspecialchars($postcodeList[0])." is ";?>
                                                </h3>
                                                <p><?php $client = new GuzzleHttp\Client(['base_uri' => 'http://www.three.co.uk/maintenance/coveragecheckerlte']);

                                                    $response = $client->request('GET', '?postcode='.$postcodeList[0].'&device_speed='.$deviceArray[1]);
                                                    $coverage = new Coverage($response);
                                                    print $coverage->getThreegHeadline();

                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ;?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 columns">
                                <input type="submit" name="submit" class="button" value="Check your coverage">
                            </div>
                        </div>






                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!--<div class="large-9 columns">-->
<!--    <ul class="right button-group">-->
<!--        <li><a href="#" class="button">Link 1</a></li>-->
<!--        <li><a href="#" class="button">Link 2</a></li>-->
<!--        <li><a href="#" class="button">Link 3</a></li>-->
<!--        <li><a href="#" class="button">Link 4</a></li>-->
<!--    </ul>-->
<!--</div>-->
</div>



<div class="row">
    <div class="panel">
        <h4>Coverage Where You're Going</h4>

        <div class="row">
            <div class="large-9 columns">
                <p>We'd love to hear from you, you attractive person you.</p>
            </div>
            <div class="large-3 columns">
                <form method="post">
                    <input type="submit" name="fetch_events" class="radius button left" value="Fetch Facebook Events">
                </form>
            </div>

        </div>
    </div>
</div>



<?php

if(isset($_POST['fetch_events'])) {
//var_dump($profile['events']);
    foreach ($profile['events'] as $key => $value) {
        $client = new GuzzleHttp\Client(['base_uri' => 'http://www.three.co.uk/maintenance/coveragecheckerlte']);
        $response = $client->request('GET', '?postcode='.$value['place']['location']['zip'] .'&device_speed='.$deviceArray[1]);
        $coverage = new Coverage($response);
        if($value['start_time']->format('Y-m-d H:i') > $time->format('Y-m-d H:i')){

;?>


<?php //todo print out the months below as Oct etc rather that 10
    print '<div class="small-9 columns small-centered">';
            ?>
        <article class="event">

            <div class="event-date">
                <p class="event-month"><?php print $value['start_time']->format('F')?></p>
                <p class="event-day"><?php print $value['start_time']->format('d')?></p>
            </div>

            <div class="event-desc">
                <h4 class="event-desc-header"><?php print $value['name']?></h4>
                <p class="event-desc-detail"><span class="event-desc-time"></span><?php print $coverage->getThreegHeadline();?></p>
                <form method="post">

                <label>Tell all of the people:
        <textarea placeholder="<?php print 'Its so awesome, I get  ' . $coverage->getThreegHeadline()?> . at  . <?php print $value['name']?>. from those nice people at 3."></textarea>
      </label>







                    </label>
                    <input type="submit" name="post-fb-message" class="radius button left" value="Spread the love!">
                </form>


            <div class="row">

  </div>
<!--                <a href="http://bdconf.com/speakers/brandon-arnold/" class="rsvp button">RSVP &amp; Details</a>-->
            </div>

        </article>

        <hr>


</div>

<?php  }}
    print '</div>';
};

    // Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
    $helper = $fb->getRedirectLoginHelper();
    $loginUrl = $helper->getLoginUrl('https://apps.facebook.com/stuartnetworktest/', $permissions);
    echo "<script>window.top.location.href='".$loginUrl."'</script>";
}

?>




<footer class="row">
    <div class="large-12 columns">

    </div>
</footer>

<!--paste template here-->
</body>
</html>