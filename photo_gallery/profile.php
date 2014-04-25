<?php
require_once '_/components/php/core/init.php';
//taken from https://www.youtube.com/watch?v=BiTG6AqNWEs

//check if we don't have a username suplied.  This will print any name passed via URL. the else statement checks that the user actually exists
if(!$username = Input::get('user')){
	Redirect::to('index.php');
} else { //check whether the user exisrs.  Uses the user class 
	$user = new User($username);
	if(!$user->exists()) {
		Redirect::to(404);
	} else { //now we know it does exist set $data to User->data() which returns a users data
		$data = $user->data();
	}}
?>
<h3><?php echo escape($data->username); ?></h3>
<p>Full Name: <?php echo escape($data->name);?></p>
<p>Joined: <?php echo escape($data->joined);?></p>

<?php 
if(escape($data->youtube)){
	echo '<p>Youtube ID is: ' . $data->youtube .'</p>'; 
} else {
	echo '<p>you havent entered a youtube ID.  You can do so by <a href="update.php">Updating your profile</a></p>';
}
if(escape($data->fivehundredpx)){
	echo '<p>500px is: ' . $data->fivehundredpx .'</p>'; 
} else {
	echo '<p>you havent entered a 500px ID.  You can do so by <a href="update.php">Updating your profile</a></p>';
}

$fivehundredpx = new Fivehundredpx;
$fivehundredpx->fivehundredUser();

//$fivehundredpx->apiString();
$obj = $fivehundredpx->apiConnect($fivehundredpx->apiString());
$fivehundredpx->picArray($obj);
print_r($fivehundredpx->picArray($obj));
$fivehundredpx->fiveinsert();


//$fivehundredpx->api;



echo '<p>Your 500px is: ' . $data->fivehundredpx .'</p>'; 
echo '<p>Your 500px consumer key is: ' . $data->fivehundredpxconsumerkey .'</p>'; 
echo '<p>THis is from the class: ' . Fivehundredpx::$consumer_key .'</p>';
//echo '<p>THis is from the class: ' . self::consumer_key .'</p>'; 

?>
