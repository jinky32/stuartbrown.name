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
	}
}
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
print '<h2>Beginning of 500px play</h2>';
print 'HERE IT IS!!!!!' . Fivehundredpx::fhpxEndpoint(user);

$fivehundredpx = new Fivehundredpx;
Fivehundredpx::fhpxUser();
//print '<p>fhpxUser was called above but i don\'t think it prints anything</p><br />';
						// print '<h1>This is the full API array</h1>';
						// $obj = $fivehundredpx->fhpxApiConnect($fivehundredpx->fhpxEndpoint(user_favourites));
						// print 'HERE IT IS!!!!!' . print_r($fivehundredpx->newfhpxApiArray($obj));

//$fivehundredpx->apiString();
// $obj = $fivehundredpx->apiConnect($fivehundredpx->apiString());
print '<h3>Connect fhpxApiArray</h3>';
$obj = Fivehundredpx::fhpxApiConnect(Fivehundredpx::fhpxEndpoint(user_favourites));
print_r(Fivehundredpx::fhpxApiArray($obj));
// $obj = $fivehundredpx->fhpxApiConnect($fivehundredpx->fhpxEndpoint(user_favourites));
// $fivehundredpx->fhpxApiArray($obj);
// print '<h3>Print-r fhpxApiArray</h3>';
// print_r(Fivehundredpx::fhpxApiArray($obj));

// print_r(Fivehundredpx::fhpxDbImageSelect('user_favorites'));
						// print '<h3>Print-r fhpxDbImageSelect</h3>';
						// print_r($fivehundredpx->fhpxDbImageSelect('user_favorites',$fivehundredpx->fhpxDbUserSelect(jinky32)));
						// // // print '<h3>PInsert values to DB</h3>';
//$fivehundredpx->fhpxInsert('user_favorites', 'photo_title');

// print '<h3>This is the endpoint User</h3>';
// print 'HERE IT IS!!!!!' . $fivehundredpx->fhpxEndpoint(user);
// print '<h3>This is the endpoint User-favourites</h3>';
// print 'HERE IT IS!!!!!' . $fivehundredpx->fhpxEndpoint(user_favourites);
print '<h3>This is all the usernames</h3>';
print 'HERE IT THE USER!!!!!' . $fivehundredpx->fhpxDbUserSelect(jinky32);
// print '<h1>This is the array</h1>';
// print_r($fivehundredpx->fhpxNav('user_favorites',$fivehundredpx->fhpxDbUserSelect(jinky32),Fivehundredpx::fhpxApiConnect(Fivehundredpx::fhpxEndpoint(user_favourites))));
//print_r($fivehundredpx->fhpxInsert('user_favorites'));
//$fivehundredpx->fhpxApiDbSync('user_favorites', $fivehundredpx->fhpxDbUserSelect(jinky32),$fivehundredpx->fhpxApiConnect($fivehundredpx->fhpxEndpoint(user_favourites)));
// print '<h1>Difference</h1>';
// print_r($fivehundredpx->fhpApiDbSync('user_favorites', $fivehundredpx->fhpxDbUserSelect(jinky32),$fivehundredpx->fhpxApiConnect($fivehundredpx->fhpxEndpoint(user_favourites))));

print '<h1>nav items</h1>';
//print_r($fivehundredpx->fhpApiDbSync('user_favorites', $fivehundredpx->fhpxDbUserSelect(jinky32),$fivehundredpx->fhpxApiConnect($fivehundredpx->fhpxEndpoint(user_favourites))));


print_r($fivehundredpx->fhpxNav('user_favorites',$fivehundredpx->fhpxDbUserSelect(jinky32),Fivehundredpx::fhpxApiConnect(Fivehundredpx::fhpxEndpoint(user_favourites))));


if(this)  {
	print '';
}


 //print 'HERE IS USER'. print_r(Fivehundredpx::fhpxUser()->user);
//  print '<h3>Print-r Test</h3>';
// print_r(Fivehundredpx::test($obj));
//  print '<h3>Print-r Photoname</h3>';
// print_r($fivehundredpx->photoname);






//$fivehundredpx->api;



echo '<p>Your 500px is: ' . $data->fivehundredpx .'</p>'; 
echo '<p>Your 500px consumer key is: ' . $data->fivehundredpxconsumerkey .'</p>'; 
echo '<p>THis is from the class: ' . Fivehundredpx::$consumer_key .'</p>';
//echo '<p>THis is from the class: ' . Fivehundredpx::fhpxUser()->$consumer_key .'</p>';
//echo '<p>THis is from the class: ' . self::consumer_key .'</p>'; 

?>
