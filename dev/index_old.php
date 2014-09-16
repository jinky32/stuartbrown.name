<?php
require_once "_/components/php/connect.php";
require_once "_/components/php/classes/user.php";


// try {
// 	$handler = new PDO('mysql:host=mysql.stuartbrown.name;dbname=photo_gallery_oop',
// 						'stuartbrown',
// 						'm4nch3st3r');

// 	$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// } catch(PDOException $e) {

// 	echo $e->getMessage();
// 	die();

// }


//class GuestbookEntry{
//	public $name, $message, $posted, $entry;
//	
//	public function __construct(){
//		$this->entry = "$this->name posted $this->message";
//	}
//}

//example using prepared statements

//$name = "Joshua";
//$message = "Test";
//
//$sql = "INSERT INTO guestbook (name, message, posted) VALUES (:name, :message, NOW())";
//$query = $handler->prepare($sql);
//
//$query->execute(array(
//	':name' => $name,
//	':message' => $message
//));

//$User = new User();
//$found_user = $User->find_by_id(1);
////echo $found_user['username'];
//print_r($found_user);

$allusers = User::find_all();
//echo $allusers[0]->username;
//print_r($allusers);
//print sizeof($allusers);
for($i=0;$i<sizeof($allusers);$i++){
	//print $i;
//	print $allusers[$i]->username . <"br />"; 
print "this is all users " . $allusers[$i]->username . "<br />";
}
//need to pu in a loop (which kind?) to go throgh values to print out
//while ($allusers) {
//	print $allusers->username;
//	
//}

$found_user = User::find_by_id(1);
echo $found_user->username;
echo $found_user->first_name;

// $query = $handler->query('SELECT * FROM guestbook');

// //$results = $query->fetchAll(PDO::FETCH_OBJ);

// while($r = $query->fetch(PDO::FETCH_OBJ)) {
// 	print $r->message;
// }

//loop through results
//if(count($results)) {
//	print_r($results);
//} else {
//	echo "there are no results";
//}

// set fetch mode and put into a class
//$query->setFetchMode(PDO::FETCH_CLASS, 'GuestbookEntry');
//
//
//while ($r = $query->fetchAll()) {
//	print_r($r);
	
//}

?>

