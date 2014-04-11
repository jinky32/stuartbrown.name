<?php
//taken from https://www.youtube.com/watch?v=CmqcUJOjJzo&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc

require_once '_/components/php/core/init.php';

//create a new instance of User and call the logout method

$user = new User();
$user->logout();

Redirect::to('index.php');

?>