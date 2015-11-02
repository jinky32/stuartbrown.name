<?php
/**
 * Created by PhpStorm.
 * User: stuartbrown
 * Date: 13/10/2015
 * Time: 10:31
 */
require_once __DIR__ . '/vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/classes/Coverage.php';

use GuzzleHttp\Client;

//todo create an object that takes three params.  the postcode from the facebook event object, device speed and device name from a select.  The getters from this can be used to construct the guzzle api call
$postcode = 'bn85na';
$deviceSpeed = 'volte';
$deviceName = 'One';

$client = new GuzzleHttp\Client(['base_uri' => 'http://www.three.co.uk/maintenance/coveragecheckerlte']);

$response = $client->request('GET', '?postcode='.$postcode.'&device_speed='.$deviceSpeed.'&device_name='.$deviceName);

//$response = $client->request('GET', '?', ['query' => ['postcode' => 'bn8+5na']]);

//$response = $client->request('GET', ['query' => ['?postcode' => 'n8+5na']


//$array = json_decode($response->getBody()->getContents(), true);


$coverage = new Coverage($response);
?>

<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<!--[if IE 10]><html class="ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Foundation | HTML Templates</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700"/>
    <link rel="icon" href="bower_components/foundation/img/icons/favicon.ico" type="image/x-icon">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/img/icons/apple-touch-icon-144x144-precomposed.png">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/img/icons/apple-touch-icon-114x114-precomposed.png">

    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/img/icons/apple-touch-icon-72x72-precomposed.png">

    <link rel="apple-touch-icon-precomposed" href="assets/img/icons/apple-touch-icon-precomposed.png">
    <meta name="description" content="Offical website for the ZURB Foundation responsive front-end framework."/>
    <meta name="author" content="ZURB, inc. ZURB network also includes zurb.com"/>
    <meta name="copyright" content="ZURB, inc. Copyright (c) 2015"/>
    <link type="text/css" rel="stylesheet" href="bower_components/foundation/css/foundation.css"/>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
    <script src="bower_components/foundation/js/vendor/modernizr.js"></script>
</head>
<body>
<div class="row">
    <div class="large-3 columns">
        <h1><?php print $coverage->getPostcode();?></h1>
    </div>
    <div class="large-9 columns">
        <ul class="right button-group">
            <li><a href="#" class="button">Link 1</a></li>
            <li><a href="#" class="button">Link 2</a></li>
            <li><a href="#" class="button">Link 3</a></li>
            <li><a href="#" class="button">Link 4</a></li>
        </ul>
    </div>
</div>





<div class="row">
    <div class="large-12 columns">
        <div id="slider">
            <img src="http://placehold.it/1000x400&text=[ img 1 ]"/>
        </div>

        <hr/>
    </div>
</div>



<div class="row">
    <div class="large-4 columns">
        <img src="http://placehold.it/400x300&text=[img]"/>
        <h4><?php print $coverage->getThreegHeadline();?></h4>
        <p><?php print $coverage->getThreegBodytext(); ?></p>
    </div>

    <div class="large-4 columns">
        <img src="http://placehold.it/400x300&text=[img]"/>
        <h4><?php print $coverage->getFourgHeadline();?></h4>
        <p><?php print $coverage->getFourgBodytext(); ?></p>
    </div>

    <div class="large-4 columns">
        <img src="http://placehold.it/400x300&text=[img]"/>
        <h4>This is a content section.</h4>
        <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
    </div>

</div>


<div class="row">
    <div class="large-12 columns">

        <div class="panel">
            <h4>Get in touch!</h4>

            <div class="row">
                <div class="large-9 columns">
                    <p>We'd love to hear from you, you attractive person you.</p>
                </div>
                <div class="large-3 columns">
                    <a href="#" class="radius button right">Contact Us</a>
                </div>
            </div>
        </div>

    </div>
</div>



<footer class="row">
    <div class="large-12 columns">
        <hr/>
        <div class="row">
            <div class="large-6 columns">
                <p>© Copyright no one at all. Go to town.</p>
            </div>
            <div class="large-6 columns">
                <ul class="inline-list right">
                    <li><a href="#">Link 1</a></li>
                    <li><a href="#">Link 2</a></li>
                    <li><a href="#">Link 3</a></li>
                    <li><a href="#">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!--paste template here-->





//todo create a constructor in Coverage class that takes a Guzzle response ($response above) and populates all of the properties in Coverage
</body>
</html>